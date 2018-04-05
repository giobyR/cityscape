<?php
    session_start();
    require_once __DIR__."/configurazione.php";
    require_once DIR_DATABASE."cityscapeDB_manager.php";

    global $cityscapeDB;
    $evento=array();
    
    //variabile usata per segnalare gli errori all'utente
    $err_msg;

    function upload_file(&$uploadOK,&$err_msg){
        //variabili usate per il caricamento del file su server
        $target_dir="../images/eventi/";
        $target_file=$target_dir.basename($_FILES["posterEvento"]["name"]);
        $uploadOK=1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if (file_exists($target_file)) {
            $err_msg="Il file è già presente.";
            $uploadOK = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $err_msg="Sono consentiti solo file JPG, JPEG & PNG.";
            $uploadOK = 0;
        }
        if($uploadOK !=0){
            if (move_uploaded_file($_FILES["posterEvento"]["tmp_name"], $target_file)) {
                $err_msg="Il file ". basename( $_FILES["posterEvento"]["name"]). " è stato caricato.";
            } else {
                $err_msg="C'è stato un errore durante il caricamento,riprovare.";
            }
        }    
    }
    function aggiungi_evento(&$evento){
        global $cityscapeDB;
        $timestamp=date('Y-m-d H:i:s');
        $query="INSERT INTO evento(titolo,dataCreazione,dataEvento,maxPartecipanti,descrizione,luogo,poster,gratis,creatore,categoria) "
                ."VALUES(\"".$evento["titoloEvento"]."\",\""
                        .$timestamp."\","
                        ."STR_TO_DATE('".$evento["dataEvento"]."','%d-%m-%Y'),"
                        .(empty($evento["maxPartecipanti"])?'NULL':("\"".$evento["maxPartecipanti"]."\"")).",\""
                        .$evento["descrizioneEvento"]."\",\""
                        .$evento["luogoEvento"]."\",\""
                        .$evento["posterEvento"]."\",\""
                        .$evento["prezzoEvento"]."\",\""
                        .$_SESSION["userID"]."\",\""
                        .$evento["categoriaEvento"]."\");";
        echo $query;
        $result=$cityscapeDB->lanciaQuery($query);      
        return $result;          
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $evento["titoloEvento"]=$cityscapeDB->sqlInjectionFilter($_POST["titoloEvento"]);
        $evento["dataEvento"]=$cityscapeDB->sqlInjectionFilter($_POST["dataEvento"]);
        $evento["luogoEvento"]=$cityscapeDB->sqlInjectionFilter($_POST["luogoEvento"]);
        $evento["descrizioneEvento"]=$cityscapeDB->sqlInjectionFilter($_POST["descrizioneEvento"]);
        $evento["posterEvento"]=$cityscapeDB->sqlInjectionFilter($_FILES["posterEvento"]["name"]);
        $evento["maxPartecipanti"]=$cityscapeDB->sqlInjectionFilter($_POST["maxPartecipanti"]);
        $evento["prezzoEvento"]=$cityscapeDB->sqlInjectionFilter($_POST["prezzoEvento"]);
        $evento["categoriaEvento"]=$cityscapeDB->sqlInjectionFilter($_POST["categoriaEvento"]);

        //salvo informazioni evento nel database
        $stato_DB=aggiungi_evento($evento);
        if($stato_DB!==false){
            $check = getimagesize($_FILES["posterEvento"]["tmp_name"]);
            if($check !== false) {
                $uploadOK = 1;
            } else {
                $err_msg="Il file non è un'immagine.";
                $uploadOK = 0;
            }
            upload_file($uploadOK,$err_msg);
            if($uploadOK==1){
                header('Location: ../php/mieiEventi.php');
            }else{
                header('Location: ../php/formAggiungiEvento.php?err_msg='.$err_msg);
            }
        }
    }   
?>