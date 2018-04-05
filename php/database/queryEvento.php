<?php
    require_once DIR_AJAX.'rispostaAjax.php';
    require_once DIR_DATABASE.'cityscapeDB.php';

    function scegli_richiesta(){
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            $tipo_richiesta=$_GET["tipo_richiesta"];
            switch($tipo_richiesta){

            }
        }
    }
    function recuperaEventiPiuRecenti(&$limite_risultati){
        $query="SELECT * FROM evento WHERE dataEvento>CURRENT_DATE ORDER BY dataEvento ASC LIMIT '".$limite_risultati."';";
        global $cityscapeDB;
        $result=$cityscapeDB->lanciaQuery($query);
        
    }
?>