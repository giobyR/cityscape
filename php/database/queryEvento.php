<?php
    require_once __DIR__."/../configurazione.php";
    require_once DIR_AJAX.'rispostaAjax.php';
    require_once DIR_DATABASE.'cityscapeDB_manager.php';

    function recuperaEventiPiuRecenti($limite_risultati){
        global $cityscapeDB;
        $limite_risultati=$cityscapeDB->sqlInjectionFilter($limite_risultati);
        //devo modificare questa query perche sto prendendo eventi passati a oggi e non futuri
        $query="SELECT * FROM evento WHERE dataEvento>=CURRENT_DATE ORDER BY dataEvento ASC LIMIT ".$limite_risultati.";";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;
    }   
?>