  
<div onload="forumLoginHandler()" id="container-login" class="modal">
    <form name="formLogin" id="formLogin" method="POST" action="../php/login_reg/login.php" class="modal-content animate">
        <div class="info-container">
            <span onclick="document.getElementById('container-login').style.display='none'" 
                class="close" title="Chiudi Finestra">&times;
            </span><br>
            <p>Per poter accedere a Cityscape è necessario effettuare il login </p>
        </div>
        <div class="form">
            <label for="email"><b>Email</b> </label>    
            <input type="email" name="email" id="email" required >
            <p id="errEmail"></p>
            <label for="pwd"><b>Password</b></label>    
            <input type="password" name="pwd" id="pwd" required >
            <p id="errPwd"></p>
            <button type="submit" name="submitButton" id="submitButton" >Login</button>
            <button type="reset" name="resetButton">Azzera Campi</button>
        </div>    
        <div class="info-container">
            <p>Se si accede alla piattaforma per la prima volta è necessario registrarsi 
                fornendo alcuni dati personali.</p>
            <a href="/php/registrazione.php">Registrati</a>
        </div>
    </form>
    <?php
            if(isset($_GET['err_msg'])){
                echo '<p> '.$_GET['err_msg'].'</p>';
            }    
   ?>         
    
        
</div>