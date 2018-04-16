<?php
    session_start();
    require_once __DIR__."/../configurazione.php";
    require_once DIR_DATABASE."queryEvento.php";
    require_once DIR_AJAX.'rispostaAjax.php';

    $tipo_richiesta;
    $result;
    $risposta=new RispostaAjax();
    $utente=new Utente();

    if($_SERVER["REQUEST_METHOD"]!="GET"){
        if($_SERVER["REQUEST_METHOD"]!="POST"){
        $msg=$_SERVER['REQUEST_METHOD'];
        $risposta=new RispostaAjax(1,$msg);
        echo json_encode($risposta);
        return;
        }
    }
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $tipo_richiesta=$_GET['queryType'];
        if($tipo_richiesta==ACCOUNT_UTENTE){
            $result=recuperaAccountUtente($_SESSION['userID']);
        }
    }else{
        //prelevo i le informazioni sul profilo utente ricevuti 
        $str=stripslashes(htmlspecialchars($_POST['str']));
        //decodifico i dati inviati tramite JSON
        $infoUtente=json_decode($str,false);
        //creo oggetto utente da inviare al database tramite query
        $utente->idUtente=$infoUtente['idUtente'];
        $utente->nome=$infoUtente['nome'];
        $utente->cognome=$infoUtente['cognome'];
        $utente->email=$infoUtente['email'];
        $utente->password=$infoUtente['password'];
        $utente->referral=$infoUtente['referral'];
        $result=aggiornaAccountUtente($utente);
    }
    if(verificaResultVuoto($result)){
        $risposta=setResultVuoto();
        echo json_encode($risposta);
        return;
    }

    $msg="OK";
    $risposta=setRispostaAggiornamentoProfilo($result,$msg);
    echo json_encode($risposta);
    return;

    function verificaResultVuoto($result){
        if(($result===null)||(!$result))
            return true;
        return ($result->num_rows <=0);    
    }

    function setResultVuoto(){
        $msg="problemi nel ricevere dati utente o aggiornare dati nel database";
        $risposta=new RispostaAjax("-1",$msg);
        return $risposta;
    }
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