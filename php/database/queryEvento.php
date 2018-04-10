<?php
    require_once __DIR__."/../configurazione.php";
    require_once DIR_AJAX.'rispostaAjax.php';
    require_once DIR_DATABASE.'cityscapeDB_manager.php';


    //recupera gli eventi futuri in ordine ascendente
    function recuperaEventiPiuRecenti($limite_risultati){
        global $cityscapeDB;
        $limite_risultati=$cityscapeDB->sqlInjectionFilter($limite_risultati);
        //devo modificare questa query perche sto prendendo eventi passati a oggi e non futuri
        $query="SELECT * FROM evento WHERE dataEvento>=CURRENT_DATE ORDER BY dataEvento ASC LIMIT ".$limite_risultati.";";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;
    }
    //recupera gli eventi in base alla categoria scelta
    function recuperaEventiPerCategoria($categoria,$limite_risultati){
        global $cityscapeDB;
        $query="SELECT * FROM evento WHERE categoria='".$categoria."' "
                ."AND dataEvento>=CURRENT_DATE ASC LIMIT". $limite_risultati.";";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;        
    }
    //recupera eventi raggruppati per interesse utenti in ordine decrescente 
    function recuperaEventiPerInteresse($limite_risultati){
        global $cityscapeDB;
        $query="SELECT E.* FROM evento E INNER JOIN "
                ."(SELECT SU.evento,COUNT(*) AS Interessi FROM statisticheutenti SU "
                ."GROUP BY SU.evento ) AS D ON E.idEvento=D.evento"
                ."GROUP BY E.idEvento ORDER BY D.Interessi DESC LIMIT '".$limite_risultati."';";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;        
    }
    //recupera eventi di interesse a un certo utente
    function recuperaEventiInteresseUtente($limite_risultati,$utente){
        global $cityscapeDB;
        $query="SELECT E.* FROM evento E INNER JOIN statisticheutenti SU ON E.idEvento=SU.evento"
                ." WHERE SU.utente='".$utente."' AND SU.interesse=1;";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;        
    }
    //recupera eventi a cui l'utente partecipa
    function recuperaEventiPartecipazioneUtente($limite_risultati,$utente){
        global $cityscapeDB;
        $query="SELECT E.* FROM evento E INNER JOIN statisticheutenti SU ON E.idEvento=SU.evento"
                ." WHERE SU.utente='".$utente."' AND SU.partecipazione=1;";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result; 
    }    
    //recupera eventi creati da un certo utente
    function recuperaEventiCreati($limite_risultati,$idUtente){
        global $cityscapeDB;
        $query="SELECT * FROM evento WHERE creatore=".$idUtente.";";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result; 
    }
    function recuperaAccountUtente($idUtente){
        global $cityscapeDB;
        $query="SELECT * FROM utente WHERE idUtente='".$idUtente."';";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result; 
    }
    function aggiungiInteresseUtente($idEvento,$utente){
        global $cityscapeDB;
        $idEvento=$cityscapeDB->sqlInjectionFilter($idEvento);
        $utente=$cityscapeDB->sqlInjectionFilter($utente);
        $query="INSERT INTO statisticheutenti VALUES('".$idEvento."','".$utente."',1,0);";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;
    }
    function aggiungiPartecipazioneUtente($idEvento,$utente){
        global $cityscapeDB;
        $idEvento=$cityscapeDB->sqlInjectionFilter($idEvento);
        $utente=$cityscapeDB->sqlInjectionFilter($utente);
        $query="INSERT INTO statisticheutenti VALUES('".$idEvento."','".$utente."',1,1);";
        $result=$cityscapeDB->lanciaQuery($query);
        $cityscapeDB->closeConnection();
        return $result;
    }
    function cancellaEvento($idEvento,$utente){
        global $cityscapeDB;
        $idEvento=$cityscapeDB->sqlInjectionFilter($idEvento);
        $utente=$cityscapeDB->sqlInjectionFilter($utente);
        //cancello l'evento dal database
        $query="DELETE * FROM evento WHERE idEvento='".$idEvento."' AND creatore=".$utente.";";
        $result=$cityscapeDB->lanciaQuery($query);
        //cancello tutte le statistiche collegate a questo evento
        $query="DELETE * FROM statisticheutenti WHERE evento='".$idEvento."';";
        $result2=$cityscapeDB->lanciaQuery($query);
        $result=$result && $result2;
        $cityscapeDB->closeConnection();
        return $result;
    }
?>