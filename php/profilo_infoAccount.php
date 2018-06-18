<?php
    session_start();
    require_once __DIR__."/configurazione.php";
    require_once DIR_SESSION."sessionManager.php";
    
    if(!isLogged()){
        header("Location: /index.php?err_msg='Devi effettuare l'accesso usando le tue credenziali !'");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/layout_evento.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/formAccountUtente.css">

    <script src="/js/effects.js"></script>
    <script src="/js/caricaEventi.js"></script>
    <script src="/js/ajaxManager.js"></script>
    <script src="/js/gestioneDashboard.js"></script>
    <title>Profilo utente</title>
</head>
<body onLoad="CaricaEventi.loadData(CaricaEventi.ACCOUNT_UTENTE)">
    <nav>
        <?php
            include DIR_LAYOUT.'navbar.php';
        ?>
    </nav>
    <div id='main'>
        <div class="sidebar">
            <?php
                include DIR_LAYOUT.'sidebar.php';
            ?>
        </div>
        <div id="divContenuto" >
            <div>
                <div class="element-container">
                    <label for="idUtente">ID Utente</label>
                    <input type="text" disabled id="idUtente">
                </div>
                <div class='element-container'>
                    <label for="email">Email</label>
                    <input type="text" disabled id="email">
                </div>
                <div class='element-container'>
                    <label for="referral">Codice Referral</label>
                    <input type="text" disabled id="referral">
                </div>
                <div class='element-container'>
                    <label for="nome">Nome</label>
                    <input type="text" disabled id="nome">
                    <input type='image' class="img-modifica" id="abilitaInputNome" src='/images/edit.png' alt="icona modifica campo">
                </div>
                <div class='element-container'>
                    <label for="cognome">Cognome</label>
                    <input type="text" disabled id="cognome">
                    <input type='image' class="img-modifica"  id="abilitaInputCognome" src='/images/edit.png' alt="icona modifica campo">
                </div>
                <div class='element-container'>
                    <label for="password">Password</label>
                    <input type="text" disabled id="password">
                    <input type='image' class="img-modifica"  id="abilitaInputPassword" src='/images/edit.png' alt="icona modifica campo">
                </div>
                <p id='err_msg' class="errore"></p>
                <input type="submit" id="submit" value="Salva Modifiche">
            </div>
        </div>
    </div>
    <footer>
            <?php
                include DIR_LAYOUT.'footer.php';
            ?>
    </footer>
    <?php
        echo "<script>";
        echo "document.getElementById('abilitaInputNome').addEventListener('click',function(){gestioneDashboard.rendiModificabileFormElement(document.getElementById('nome'))});\n";
        echo "document.getElementById('abilitaInputCognome').addEventListener('click',function(){gestioneDashboard.rendiModificabileFormElement(document.getElementById('cognome'))});\n";
        echo "document.getElementById('abilitaInputPassword').addEventListener('click',function(){gestioneDashboard.rendiModificabileFormElement(document.getElementById('password'))});\n";
        echo "document.getElementById('submit').addEventListener('click',gestioneDashboard.aggiornaProfiloLatoServer)";
        echo "</script>";
    ?>
</body>
</html>