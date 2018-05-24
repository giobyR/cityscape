<?php
    require_once __DIR__."/../configurazione.php";
    require_once DIR_DATABASE."cityscapeDB_manager.php";

//definisco le variabili per la gestione dei dati ricevuti dal form
    $data=array();

//funzione per creare il codice referral 
//da associare a nuovi organizzatori che si registrano
function crea_referral(){
    $pool="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $code="";
    $dim=strlen($pool)-1;
    for($i=0;$i<6;$i++){
        $code.=$pool[mt_rand(0,$dim)];
    }
    return $code;
}
//verifica se il referral è presente nel database
//se non è presente crea un nuovo referral
function verifica_referral(){
    global $cityscapeDB;
    $ref=crea_referral();
    $ref=$cityscapeDB->sqlInjectionFilter($ref);
    $stringaQuery="SELECT * "
                ."FROM utente "
                ."WHERE codiceReferral=\"". $ref."\";";
    $result=$cityscapeDB->lanciaQuery($stringaQuery);
    if(mysqli_num_rows($result) !=0)
        return verifica_referral(); //chiamata ricorsiva che genera un nuovo codice referral
    
        $result->close();
    $cityscapeDB->closeConnection();              
    return $ref;            
}
//verifico se la mail è presente nel database
function verifica_email(&$data){
    global $cityscapeDB;
    $stringaQuery;
    $data["email"]=$cityscapeDB->sqlInjectionFilter($data["email"]);
    $stringaQuery="SELECT * "
                ."FROM utente "
                ."WHERE email=\"".$data["email"]."\";";
    echo $stringaQuery;
    $result=$cityscapeDB->lanciaQuery($stringaQuery);
    $var=mysqli_num_rows($result);
    $cityscapeDB->closeConnection();
    return $var;
}
function registra(&$data){
    global $cityscapeDB;
    $err_msg;

    foreach($data as $key=>$value){
        $value=$cityscapeDB->sqlInjectionFilter($value);
    }
    $stringaQuery="INSERT INTO utente(nome,cognome,email,password,codiceReferral)"
                ." VALUES(\"".$data['nome']."\",\""
                .$data['cognome']."\",\""
                .$data['email']."\",\""
                .$data['password']."\",\""
                .$data['referral']."\");";
    //eseguo query
    $result=$cityscapeDB->lanciaQuery($stringaQuery);
    //dovrei invece mostrare nel form un messaggio di registrazione avvenuta con successo
    if(mysqli_num_rows($result) >0){
        $err_msg="Registrazione avvenuta con successo!";
    }else{
        $err_msg="Impossibile registrarsi,riprovare!";
    }    
    $cityscapeDB->closeConnection();
    return $err_msg;          
}
    //prendo i parametri ricevuti
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $err_msg;
        $data['nome']=$_POST['nome'];
        $data['cognome']=$_POST['cognome'];
        $data['email']=$_POST['email'];
        $data['password']=$_POST['pwd'];
        //genero un referral personale per il nuovo utente che si registra
        $data['referral']=verifica_referral();    
        //verifico se l'utente è già registrato 
        $result=verifica_email($data);
        if($result !=0){
            $err_msg="Utente già registrato!";
            header("Location: ../php/registrazione.php?err_msg=".$err_msg);
            exit;
        }
        //arrivato qui significa che posso registrare il nuovo utente
        $err_msg=registra($data);
        if(strpos($err_msg,"Impossibile registrarsi,riprovare!")){
            header("Location: ../php/registrazione.php?err_msg=".$err_msg);
        }else{
            header("Location: /html/esplora_eventiRecenti.php");
        }
    }
?>