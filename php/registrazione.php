<?php
    session_start();
    require_once __DIR__."/configurazione.php";
    require_once DIR_LOGIN_REG."gestione_registrazione.php";
    require_once DIR_SESSION."sessionManager.php";

    if(isLogged()){
        header("Location: /php/esplora_eventiRecenti.php");
    }
?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
    <meta charset="utf-8">
    <title>Registrazione utente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/login_registrazione.js"></script>
    <script type="text/javascript" src="../js/ajaxManager.js"></script>

    <link rel="stylesheet" href="/css/form_layout.css">
</head>
<body onload="forumRegistrazioneHandler()" id="container-reg" class="modal">
    <form name="formRegistrazione" id="formRegistrazione" method="POST" action="../php/login_reg/gestione_registrazione.php" class="modal-content ">
        <div class="info-container">
            <p>Per poter accedere a Cityscape è necessario registrarsi </p>
            <p>Compila i seguenti campi inserendo i propri dati personali</p>
        </div>
        <div class="form">
            <label for="nome"><b>Nome*</b></label> 
                <input type="text" name="nome" id="nome" required >   
            <span id="errNome" class="errore"></span><br>  
            <label for="cognome"><b>Cognome*</b></label>
            <input type="text" name="cognome" id="cognome" required >
            <span id="errCognome" class="errore"></span><br>
            <label><b>Email*</b></label> 
            <input type="email" required name="email" id="email" >   
            <span id="errEmail" class="errore"></span><br>
            <label for="pwd"><b>Password*</b></label>
            <input type="password" name="pwd" required id="pwd" >   
            <span id="errPwd" class="errore"></span><br>
            <label for="Rpwd"><b>Conferma Password*</b></label>
            <input type="password" name="Rpwd" required id="Rpwd" >   
            <span id="errRpwd" class="errore"></span><br>
        </div>
            <div id="condizioniUso">
                <label>Accetti i <a href="html/condizioniUso.html">termini e condizioni d'uso*</a></label>
                <input type="checkbox" name="checkCondizioniUso" required >   
            </div>
            <?php
                if(isset($_GET['err_msg'])){
                    echo '<p> '.$_GET['err_msg'].'</p>';
                }
            ?>
            <input type="submit" name="submitButton"  value="registrati" id="submitButton" disabled></input>
            <input type="reset" name="resetButton" value="azzera campi"></input>
            <p>I campi contrasegnati con asterisco(*) sono obbligatori</p>
    </form>
</body>
</html>