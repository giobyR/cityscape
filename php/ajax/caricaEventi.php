<?php
    session_start();
    require_once __DIR__."/../configurazione.php";
    require_once DIR_DATABASE."queryEvento.php";
    require_once DIR_AJAX.'rispostaAjax.php';

    $tipo_richiesta;
    $limite_risultati;
    $result;
    $risposta=new RispostaAjax();

    if($_SERVER["REQUEST_METHOD"]!="GET"){
        echo json_encode($risposta);
        return;
    }
    $tipo_richiesta=$_GET['queryType'];
    $limite_risultati=$_GET['limiteNumeroEventi'];
    
    //0=eventi piu' recenti
    switch($tipo_richiesta){
        case 0:
            $result=recuperaEventiPiuRecenti($limite_risultati);
            break;
        default:
            $result=null;
            break;    
    }
    if(verificaResultVuoto($result)){
        $risposta=setResultVuoto();
        echo json_encode($risposta);
        return;
    }
    $msg="OK";
    $risposta=setRisposta($result,$msg);
    echo json_encode($risposta);
    return;

    function verificaResultVuoto($result){
        if(($result===null)||(!$result))
            return true;
        return ($result->num_rows <=0);    
    }

    function setResultVuoto(){
        $msg="eventi da caricare non presenti";
        $risposta=new RispostaAjax("-1",$msg);
        return $risposta;
    }
    function setRisposta($result,$msg){
        $risposta=new RispostaAjax("0",$msg);
        $indice=0;
        //$row=mysqli_fetch_assoc($result);
        //return $row['titolo'];
        $risposta->data=array();
        $row=0;
        $dim=$result->num_rows;
        while($row = $result->fetch_assoc()){
            $evento= new Evento();
            $evento->idEvento=$row['idEvento'];
            $evento->titolo=$row['titolo'];
            $evento->descrizione=$row['descrizione'];
            $evento->data=$row['dataEvento'];
            $evento->luogo=$row['luogo'];
            $evento->prezzo=$row['prezzo'];
            $evento->maxPartecipanti=$row['maxPartecipanti'];
            $evento->creatore=$row['creatore'];
            $evento->poster=$row['poster'];

            $risposta->data[$indice]=json_encode($evento);
            $indice++;
        }
        return $risposta;
    }
?>