<?php
    require_once __DIR__."/../configurazione.php";
    require_once DIR_SESSION."sessionManager.php";
    require_once DIR_DATABASE."cityscapeDB_manager.php";

    $email=$_POST['email'];
    $password=$_POST['pwd'];
    $err_msg=login($email,$password);
    if($err_msg===null){
        header("Location: /php/formAggiungiEvento.php");
    }else{
        header("Location: /php/loginUtente.php?err_msg= ".$err_msg);
    }

    function login(&$email,&$password){
        $userID=autentifica($email,$password);
        if($userID <0){
            return "email e password non validi,riprovare";
        }else if($userID>=0){
            session_start();
            setSession($email,$userID);
            return null;
        }
    }

    function autentifica(&$email,&$password){
        global $cityscapeDB;
        $email=$cityscapeDB->sqlInjectionFilter($email);
        $password=$cityscapeDB->sqlInjectionFilter($password);
        $query="SELECT * FROM utente WHERE email='".$email."' and password='".$password."';";
        $result=$cityscapeDB->lanciaQuery($query);
        $num_risultati=mysqli_num_rows($result);
        if($num_risultati !=1){
            return -1;
        }
        $datiUtente=$result->fetch_assoc();
        $cityscapeDB->closeConnection();
        return $datiUtente['idUtente'];
    }
?>