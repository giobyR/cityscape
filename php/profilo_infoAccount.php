<?php
    session_start();
    require_once __DIR__."/configurazione.php";
    require_once DIR_SESSION."sessionManager.php";
    
    if(!isLogged()){
        header("Location: /index.html");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/layout_evento.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/formAccountUtente.css">

    <script type="text/javascript" src="/js/effects.js"></script>
    <script type="text/javascript" src="/js/caricaEventi.js"></script>
    <script type="text/javascript" src="/js/ajaxManager.js"></script>
    <script type="text/javascript" src="/js/gestioneDashboard.js"></script>
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
                    <input type="text" contenteditable="false" id="idUtente"></input>
                </div>
                <div class='element-container'>
                    <label for="email">Email</label>
                    <input type="text" contenteditable="false" id="email"></input>
                </div>
                <div class='element-container'>
                    <label for="referral">Codice Referral</label>
                    <input type="text" contenteditable="false" id="referral"></input>
                </div>
                <div class='element-container'>
                    <label for="nome">Nome</label>
                    <input type="text" contenteditable="false" id="nome"></input>
                    <input type='image' src='/images/edit.png'  onClick="rendiModificabileFormElement(document.getElementById('nome'))">
                </div>
                <div class='element-container'>
                    <label for="cognome">Cognome</label>
                    <input type="text" contenteditable="false" id="cognome"></input>
                    <input type='image' src='/images/edit.png'  onClick="rendiModificabileFormElement(document.getElementById('cognome'))">
                </div>
                <div class='element-container'>
                    <label for="password">Password</label>
                    <input type="text" contenteditable="false" id="password"></input>
                    <input type='image' src='/images/edit.png'  onClick="rendiModificabileFormElement(document.getElementById('password'))">
                </div>
                
                <input type="submit" id="submit" onSubmit="salvaModifiche()" value="Salva Modifiche"></input>
            </div>
        </div>
    </div>
    <footer>
            <?php
                include DIR_LAYOUT.'footer.php';
            ?>
    </footer>
    <script>
        //rendo le parti di input del form utente modificabili 
        function rendiModificabileFormElement(dataInput){
            //var attribute=dataInput.getAttribute('contenteditable');
            //if(attribute==false){
                dataInput.setAttribute('contenteditable','true');
            //}
        }
        function salvaModifiche(){
            gestioneDashboard.aggiornaProfiloLatoServer();
        }
    </script>    
</body>
</html>