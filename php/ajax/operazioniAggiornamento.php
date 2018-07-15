<?php
    session_start();
    require_once __DIR__."/../configurazione.php";
    require_once DIR_DATABASE."queryEvento.php";
    require_once DIR_AJAX.'rispostaAjax.php';

    //questo file viene usato per la comunicazione AJAX client-server
    //per operazioni generiche di interazione client e database lato server
    $risposta=new RispostaAjax();

    //verifico di ricevere soltanto richiesta GET
    if($_SERVER["REQUEST_METHOD"]!="GET"){
        echo json_encode($risposta);
        return;
    }
    $tipo_richiesta=$_GET['queryType'];
    if(isset($_GET['idEvento'])){
        $idEvento=$_GET['idEvento'];
    }
    //in base al tipo di richiesta ricevuta svolto una
    //certa operazione lato database
    switch($tipo_richiesta){
        case CANCELLA_EVENTO:
            $result=cancellaEvento($idEvento,$_SESSION['userID']);
            $msg="cancellazione evento andata a buon fine";
            break;
        case AGGIUNGI_PARTECIPAZIONE:
            $result=aggiungiPartecipazioneUtente($idEvento,$_SESSION['userID']);
            $msg="aggiunta nuova partecipazione";
            break;
        case AGGIUNGI_INTERESSE_UTENTE:
            $result=aggiungiInteresseUtente($idEvento,$_SESSION['userID']);
            $msg="salvato interesse utente per evento indicato";
            break;
        case RICEVI_SCONTO_REFERRAL:
            $result=getScontoReferral($_GET['referral'],$idEvento);
            $msg="trovato sconto referral";
            break;
        case SALVA_LUOGO:
            $result=salvaLuogoMaps($_GET['placeID'],$_GET['indirizzo']);
            $msg="luogo salvato";
            break;
        case TOGLI_SEGNALAZIONE:
            $result=togliSegnalazione($idEvento);
            $msg="segnalazione evento tolta con successo";
            break;
        case SEGNALA_EVENTO:
            $result=segnalaEvento($idEvento);
            $msg="evento segnalato con successo";
            break;
    }
    if(verificaResultVuoto($result)){
        $risposta=setResultVuoto();
        echo json_encode($risposta);
        return;
    }
    //questa verifica condizionale serve per distinguere i casi
    //in cui il database restituice un result set e il caso 
    //in cui restituisce un booleano per notificare che 
    //l'operazione sia andata a buon fine oppure no
    if(isset($_GET['referral'])){
        $risposta=setRispostaSconto($result);
    }else if(($_GET['queryType']==TOGLI_SEGNALAZIONE)||($_GET['queryType']==SEGNALA_EVENTO)){
        $risposta=setRispostaConferma($result,$msg);
    }else{    
        $risposta=setRispostaConferma($result,$msg);
    }
    echo json_encode($risposta);
    return;

    function verificaResultVuoto($result){
        if(($result===null)||(!$result))
            return true;
        if($result)
            return false;    
        return ($result->num_rows <=0);    
    }
    function setResultVuoto(){
        $msg="operazione di aggiornamento non andata a buon fine";
        $risposta=new RispostaAjax("-1",$msg);
        return $risposta;
    }
    function setRispostaConferma($result,$msg){
        if(!$result){
            setResultVuoto();
        }
        $risposta=new RispostaAjax('0',$msg);
        return $risposta;
    }
    function setRisposta($result,$msg){
        if(mysql_num_rows($result)==0){
            setResultVuoto();
        }else{
            $risposta=new RispostaAjax("0",$msg);
        }
        return $risposta;
    }
    function setRispostaSconto($result){
        $msg="trovato sconto referral";
        if($result->num_rows <=0){
            setResultVuoto();
        }
        $risposta=new RispostaAjax('0',$msg);
        while($row= $result->fetch_assoc()){
            if($row['sconto']===null){
                $risposta->data=0;
            }
            $risposta->data=$row['sconto'];
        }
        return $risposta;
    }
?>