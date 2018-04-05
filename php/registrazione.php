<?php
    require_once __DIR__."/configurazione.php";
    require_once DIR_LOGIN_REG."gestione_registrazione.php";
?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
    <meta charset="utf-8">
    <title>Registrazione utente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/login_registrazione.js"></script>
    <script type="text/javascript" src="../js/ajaxManager.js"></script>

</head>
<body onload="forumRegistrazioneHandler()">
    <h1>Effettua la registrazione a Cityscape</h1>
    <p>Per poter accedere a Cityscape è necessario registrarsi </p>
    <p>Compila i seguenti campi inserendo i propri dati personali</p>
    <form name="formRegistrazione" id="formRegistrazione" method="POST" action="../php/login_reg/gestione_registrazione.php">
        <label>Nome
            <input type="text" name="nome" id="nome" required >
        </label>    
        <span id="errNome">
            *
        </span><br>  
        <label>Cognome
            <input type="text" name="cognome" id="cognome" required >
        </label>    
        <span id="errCognome">
            *
        </span><br>
        <label>Email
            <input type="email" required name="email" id="email" >
        </label>    
        <span id="errEmail">
            *
        </span><br>
        <label>Password
            <input type="password" name="pwd" required id="pwd" >
        </label>    
        <span id="errPwd">
            *
        </span><br>
        <label>Conferma Password
            <input type="password" name="Rpwd" required id="Rpwd" >
        </label>    
        <span id="errRpwd">
            *
        </span><br>
        <label>Accetti i <a href="html/condizioniUso.html">Termini e condizioni d'uso*</a>
            <input type="checkbox" name="checkCondizioniUso" required >
        </label>    
        <input type="submit" name="submitButton"  value="registrati" id="submitButton" disabled></input>
        <input type="reset" name="resetButton" value="azzera campi"></input>
    </form>
    <p>I campi contrasegnati con asterisco(*) sono obbligatori</p>
    <?php
        if(isset($_GET['err_msg'])){
            echo '<p> '.$_GET['err_msg'].'</p>';
        }
    ?>
</body>
</html>