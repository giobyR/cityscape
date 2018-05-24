<?php
    session_start();
    require_once __DIR__."/../configurazione.php";
    require_once DIR_DATABASE."queryEvento.php";
    require_once DIR_AJAX.'rispostaAjax.php';

    //questo file rappresenta la parte PHP della comunicazione Ajax client-server
    //usata per la ricezione dinamica di informazioni account utente dal database
    //e per modificare le informazioni presenti nel database
    $tipo_richiesta;
    $result;
    $risposta=new RispostaAjax();
    $utente=new Utente();

    //verifico che le richeiste ricevute siano di tipo POST o GET
    if($_SERVER["REQUEST_METHOD"]!="GET"){
        if($_SERVER["REQUEST_METHOD"]!="POST"){
        $msg=$_SERVER['REQUEST_METHOD'];
        $risposta=new RispostaAjax(1,$msg);
        echo json_encode($risposta);
        return;
        }
    }
    //le richieste GET vengono usate per leggere informazioni 
    //account utente dal database
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $tipo_richiesta=$_GET['queryType'];
        if($tipo_richiesta==ACCOUNT_UTENTE){
            $result=recuperaAccountUtente($_SESSION['userID']);
        }
    }else{
        //se sono arrivato qui significa che ho una richiesta POST
        //e di conseguenza devo salvare i dati modificati dal client

        //prelevo le informazioni sul profilo utente ricevuti lato client 
        $str=stripslashes(htmlspecialchars($_POST['str']));
        //decodifico i dati inviati tramite JSON
        $infoUtente=json_decode($_POST['str'],false);
        //echo "<script>console.log('".$utente."')</script>";
        //creo oggetto utente da inviare al database tramite query
        $utente->idUtente=$infoUtente->idUtente;
        $utente->nome=$infoUtente->nome;
        $utente->cognome=$infoUtente->cognome;
        $utente->email=$infoUtente->email;
        $utente->password=$infoUtente->password;
        $utente->referral=$infoUtente->referral;
        //aggiorno database con i dati inviati 
        $result=aggiornaAccountUtente($utente);
    }
    if(verificaResultVuoto($result)){
        $risposta=setResultVuoto();
        echo json_encode($risposta);
        return;
    }
    //arrivato qui significa che le operazioni precedente sono andate a buon fine 
    //di conseguenza restituisco una risposta positiva al client
    //e le informazioni sull'account utente aggiornate
    $msg="OK";
    $risposta=setRispostaAggiornamentoProfilo($result,$msg);
    echo json_encode($risposta);
    return;

    function verificaResultVuoto($result){
        if(($result===null)||(!$result))
            return true;    
    }

    function setResultVuoto(){
        $msg="problemi nel ricevere dati utente o aggiornare dati nel database";
        $risposta=new RispostaAjax("-1",$msg);
        return $risposta;
    }
    //serve per prendere le informazioni ricevute dal database
    //e creare un nuovo oggetto Evento da restituire al client
    function setRispostaAggiornamentoProfilo($result,$msg){
        $risposta=new RispostaAjax("0",$msg);
        if(isset($_GET['queryType'])){
            while($row=$result->fetch_assoc()){
                $utente=new Utente();
                $utente->idUtente=$row['idUtente'];
                $utente->nome=$row['nome'];
                $utente->cognome=$row['cognome'];
                $utente->email=$row['email'];
                $utente->password=$row['password'];
                $utente->referral=$row['codiceReferral'];
                $risposta->data=json_encode($utente);
            }
        }
        return $risposta;
    }
?>