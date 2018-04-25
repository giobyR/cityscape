<div onload="forumRegistrazioneHandler()" id="container-reg" class="modal">
    <form name="formRegistrazione" id="formRegistrazione" method="POST" action="../php/login_reg/gestione_registrazione.php" class="modal-content animate">
        <div class="info-container">
            <span onclick="document.getElementById('container-reg').style.display='none'" 
                class="close" title="Chiudi Finestra">&times;
            </span>
            <p>Per poter accedere a Cityscape è necessario registrarsi </p>
            <p>Compila i seguenti campi inserendo i propri dati personali</p>
        </div>
        <div class="form">
            <label for="nome"><b>Nome*</b></label> 
                <input type="text" name="nome" id="nome" required >   
            <span id="errNome"></span>  
            <label for="cognome"><b>Cognome*</b></label>
            <input type="text" name="cognome" id="cognome" required >
            <span id="errCognome"></span>
            <label><b>Email*</b></label> 
            <input type="email" required name="email" id="email" >   
            <span id="errEmail"></span>
            <label for="pwd"><b>Password*</b></label>
            <input type="password" name="pwd" required id="pwd" >   
            <span id="errPwd"></span>
            <label for="Rpwd"><b>Conferma Password*</b></label>
            <input type="password" name="Rpwd" required id="Rpwd" >   
            <span id="errRpwd"></span>
        </div>
            <div id="condizioniUso">
                <label>Accetti le condizioni d'uso*</label>
                <a href="html/condizioniUso.html">Termini e condizioni d'uso</a>
                <input type="checkbox" name="checkCondizioniUso" required >   
            </div>
            <input type="submit" name="submitButton"  value="registrati" id="submitButton" disabled></input>
            <input type="reset" name="resetButton" value="azzera campi"></input>
            <p>I campi contrasegnati con asterisco(*) sono obbligatori</p>
    </form>
    <?php
        if(isset($_GET['err_msg'])){
            echo '<p> '.$_GET['err_msg'].'</p>';
        }
    ?>
</div>