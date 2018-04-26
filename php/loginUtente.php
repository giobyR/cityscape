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

    <link rel="stylesheet" href="/css/form_layout.css">

</head>
<body onload="forumLoginHandler()" id="container-login" class="modal">
    <form name="formLogin" id="formLogin" method="POST" action="../php/login_reg/login.php" class="modal-content animate">
        <div class="info-container">
            <p>Per poter accedere a Cityscape è necessario effettuare il login </p>
        </div>
        <div class="form">
            <label for="email"><b>Email</b> </label>    
            <input type="email" name="email" id="email" required >
            <p id="errEmail" class="errore"></p>
            <label for="pwd"><b>Password</b></label>    
            <input type="password" name="pwd" id="pwd" required >
            <p id="errPwd" class="errore"></p>
            <button type="submit" name="submitButton" id="submitButton" >Login</button>
            <button type="reset" name="resetButton">Azzera Campi</button>
        </div>
        <?php
            if(isset($_GET['err_msg'])){
                echo '<p> '.$_GET['err_msg'].'</p>';
            }    
        ?>            
        <div class="info-container">
            <p>Se si accede alla piattaforma per la prima volta è necessario registrarsi 
                fornendo alcuni dati personali.</p>
            <a href="/php/registrazione.php" id="regButton">Registrati</a>
        </div>
    </form>        
</body>
</html>