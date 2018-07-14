<?php
    session_start();
    require_once __DIR__."/../configurazione.php";
    require_once DIR_DATABASE."queryEvento.php";
    require_once DIR_AJAX.'rispostaAjax.php';

    //questo file rappresenta la parte PHP della comunicazione Ajax client-server
    //per restituire determinati eventi richiesti
    $tipo_richiesta;
    $limite_risultati;
    $result;
    $risposta=new RispostaAjax();
    
    //serve per verificare che vengano inviate soltanto richiesta GET
    if($_SERVER["REQUEST_METHOD"]!="GET"){
        echo json_encode($risposta);
        return;
    }
    $tipo_richiesta=$_GET['queryType'];
    if(isset($_GET['limiteNumeroEventi'])){
        $limite_risultati=$_GET['limiteNumeroEventi'];
    }
    if(isset($_GET['categoria'])){
        $categoria=$_GET['categoria'];
    }
    if(isset($_GET['idEvento'])){
        $idEvento=$_GET['idEvento'];
    }
    if(isset($_GET['offset'])){
        $offset=$_GET['offset'];
    }
    
    //in base al tipo di richiesta Ajax ricevuta viene lanciata
    //una determinata interazione con il server
    switch($tipo_richiesta){
        case CANCELLA_EVENTO:
            $result=cancellaEvento($idEvento,$_SESSION['userID']);
            break;
        case CERCA_PAROLA_CHIAVE:
            $arrayEventi=cercaParolaChiave($_GET['parolaChiave'],$limite_risultati,$offset,$_GET['tipoRicerca']);
            setRispostaRicerca($arrayEventi);
            return;
            //break;
        case CERCA_LUOGO:
            $arrayEventi=cercaLuogo($_GET['luogo'],$limite_risultati,$offset,$_GET['tipoRicerca']);
            setRispostaRicerca($arrayEventi);
            return;
        case CERCA_DATA:
            $arrayEventi=cercaData($_GET['data'],$limite_risultati,$offset,$_GET['tipoRicerca']);
            setRispostaRicerca($arrayEventi);
            return;                  
        default:
            $result=selezionaQueryEvento($limite_risultati,$offset,$tipo_richiesta);
            break;    
    }
    //verifico che il risultato restituito dal database non sia vuoto
    if(verificaResultVuoto($result)){
        $risposta=setResultVuoto();
        echo json_encode($risposta);
        return;
    }
    //arrivato qui significa che ho una risposta che devo restituire al client
    $msg="OK";
    $risposta=setRisposta($result,$msg);
    echo json_encode($risposta); //invia risposta al client
    return;

    //serve per selezionare una parte delle query da eseguire
    //riguardanti gli eventi presenti nel database 
    function selezionaQueryEvento($limite_risultati,$offset,$tipo_richiesta){
        switch($tipo_richiesta){
            case EVENTI_PIU_RECENTI:
                $result=recuperaEventiPiuRecenti($limite_risultati,$offset);
                break;
            case EVENTI_PIU_INTERESSANTI:
                $result=recuperaEventiPerInteresse($limite_risultati,$offset);
                break;
            case EVENTI_INTERESSE_UTENTE:
                $result=recuperaEventiInteresseUtente($limite_risultati,$_SESSION['userID'],$offset);
                break;
            case EVENTI_PARTECIPAZIONI_UTENTE:
                $result=recuperaEventiPartecipazioneUtente($limite_risultati,$_SESSION['userID'],$offset);
                break;
            case EVENTI_CREATI_UTENTE:
                $result=recuperaEventiCreati($limite_risultati,$_SESSION['userID'],$offset);
                break;
            case EVENTI_CREATI_UTENTE_ADMIN:
                $result=recuperaEventiCreatiAdmin($limite_risultati,$offset);
                break;
            case ACCOUNT_UTENTE:
                $result=recuperaAccountUtente($_SESSION['userID']);
                break;
            case CATEGORIA_BAMBINI:
            case CATEGORIA_CINEMA:
            case CATEGORIA_CONCERTI:
            case CATEGORIA_CULTURA:
            case CATEGORIA_NIGHTLIFE:
            case CATEGORIA_SPORT:
            case CATEGORIA_ALTRO:
                $result=recuperaEventiPerCategoria($_GET['categoria'],$limite_risultati,$offset);
                break;
            default:
                $result=null;
                break;    
        }
    return $result;              
    }
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
    //crea array di eventi con un evento corrispondente a
    //ogni tupla del result set
    function setRisposta($result,$msg){
        $risposta=new RispostaAjax("0",$msg);
        $indice=0;
        $risposta->data=array();
        $row=0;
        $dim=$result->num_rows;
        while($row = $result->fetch_assoc()){
            //usando la classe evento creo un nuovo oggetto evento
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
            $evento->segnalato=$row['segnalato'];
            //salvo ogni evento nel campo dati dell'oggetto RispostaAjax
            $risposta->data[$indice]=json_encode($evento); 
            $indice++;
        }
        return $risposta;
    }
    //serve per restituire un risultato alla ricerca fatta dall'utente
    //msg=OK -> restituisce gli eventi trovati
    //msg=errore -> nesssun evento trovato
    function setRispostaRicerca($arrayEventi){
        $msg="OK";
        //verifico che il risultato restituito dal database non sia vuoto
        if(count($arrayEventi)==0){
            $risposta=setResultVuoto();
            echo json_encode($risposta);
            return;
        }else{
            $risposta=new RispostaAjax("0",$msg);
            $risposta->data=array();
            for($i=0;$i<count($arrayEventi);$i++){
                //salvo ogni evento nel campo dati dell'oggetto RispostaAjax
                $risposta->data[$i]=json_encode($arrayEventi[$i]);
            }
        }
        echo json_encode($risposta);
        return;
    }
?>