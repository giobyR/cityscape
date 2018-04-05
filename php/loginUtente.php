<?php
    session_start();
    require_once __DIR__."/configurazione.php";
    require_once DIR_SESSION."sessionManager.php";

    if(isLogged()){
        header("Location: /php/formAggiungiEvento.php");
    }
    
?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
    <meta charset="utf-8">
    <title>Login utente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="/js/login_registrazione.js"></script>
</head>
<body onload="forumLoginHandler()">
    <h1>Effettua il login a Cityscape</h1>
    <p>Per poter accedere a Cityscape è necessario effettuare il login </p>
    <form name="formLogin" id="formLogin" method="POST" action="../php/login_reg/login.php">
        <label>email 
            <input type="email" name="email" id="email" required >
        </label>    
        <p id="errEmail"></p>
        <label>password
            <input type="password" name="pwd" id="pwd" required >
        </label>    
        <p id="errPwd"></p>
        <button type="submit" name="submitButton" id="submitButton" >Login</button>
        <button type="reset" name="resetButton">Azzera Campi</button>
    </form>
    <?php
            if(isset($_GET['err_msg'])){
                echo '<p> '.$_GET['err_msg'].'</p>';
            }    
   ?>         
    
    <p>Se si accede alla piattaforma per la prima volta è necessario registrarsi 
        fornendo alcuni dati personali.</p>
    <a href="/php/registrazione.php">Registrati</a>    
</body>
</html>