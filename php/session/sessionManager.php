<?php
    function setSession($email,$userID){
        $_SESSION['email']=$email;
        $_SESSION['userID']=$userID;
    }
    function isLogged(){
        if(isset($_SESSION['userID']))
            return $_SESSION['userID'];
        else
            return false;    
    }
?>