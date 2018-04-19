<?php
    session_start();
    require_once __DIR__."/../configurazione.php";
    require_once DIR_DATABASE."queryEvento.php";
    require_once DIR_AJAX.'rispostaAjax.php';

    $risposta=new RispostaAjax();

    if($_SERVER["REQUEST_METHOD"]!="GET"){
        echo json_encode($risposta);
        return;
    }
    $tipo_richiesta=$_GET['queryType'];
    if(isset($_GET['idEvento'])){
        $idEvento=$_GET['idEvento'];
    }
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
    }
    if(verificaResultVuoto($result)){
        $risposta=setResultVuoto();
        echo json_encode($risposta);
        return;
    }
    if(isset($_GET['referral'])){
        $risposta=setRispostaSconto($result);
    }else{
        $risposta=setRisposta($result,$msg);
    }
    echo json_encode($risposta);
    return;

    function verificaResultVuoto($result){
        if(($result===null)||(!$result))
            return true;
        return ($result->num_rows <=0);    
    }
    function setResultVuoto(){
        $msg="operazione di aggiornamento non andata a buon fine";
        $risposta=new RispostaAjax("-1",$msg);
        return $risposta;
    }
    function setRisposta($result,$msg){
        if(mysql_num_rows($result)==0){
            setResultVuoto();
        }else{
            $risposta=new RispostaAjax("0",$msg);
        }

    }
    function setRispostaSconto($result){
        $risposta=new RispostaAjax('o',$msg);
        while($row= $result->fetch_assoc()){
            $risposta->data=$row['sconto'];
        }
        return $risposta;
    }
?>