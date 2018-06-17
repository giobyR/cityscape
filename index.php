<?php
    session_start();
    require_once __DIR__."/php/configurazione.php";
    require_once DIR_SESSION."sessionManager.php";
    require_once DIR_LOGIN_REG."gestione_registrazione.php";
    /*
    if(isLogged()){
        header("Location: /php/esplora_eventiRecenti.php");
    }
    */
?>  
<!DOCTYPE html>
<html lang="it-IT">
<head>
    <meta charset="utf-8" />
    <title>CityScape</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/form_layout.css">
    <link rel="stylesheet" href="/css/footer.css">


    <script src="/js/login_registrazione.js"></script>
    <script src="/js/ajaxManager.js"></script>


    
</head>
<body>
    <div class="container-video">
        <video autoplay loop muted>
            <source src="/images/blurPeople.mp4" type="video/mp4">
            <source src="/images/blurPeople.ogg" type="video/mp4">
            Il video non è supportato
        </video>
        <div class="contenuto">
            <h1>Benvenuto su Cityscape</h1>
            <h3>Questa piattaforma ti permette di cercare e iscriverti a eventi di tuo interesse</h3>
        </div>
    </div>
    <p id="text">
            Puoi esplorare gli eventi presenti in Italia,divisi per categoria oppure ordinati 
            per interesse mostrato da parte degli utenti o per data. 
            
            Se sei iscritto alla piattaforma ,oltre alla semplice esplorazione puoi anche inviare la tua adesione
             un evento e vedere il numero di posti disponibili rimasti.
    </p>
    <div class="div-img">
        <p>Puoi cercare concerti , spettacoli 
           nonchè iscriverti agli eventi organizzati dalle discoteche di tua scelta
        </p>
        <img src="/images/chitarra.jpg" alt="Uomo con chitarra al concerto">
    </div>
    <div class="div-img">
        <img src="/images/cinema.jpg" alt="sala di cinema con persone ">
        <p>
            Se sei interessato a scoprire la programmazione del cinema a te più vicino 
            o in una particolare città , cityscape ti da la possibilità di farlo.
        </p>
    </div>
    <div class="div-img">
        <p> 
            
            Su Cityscape puoi creare il tuo evento inserendo le informazioni utili agli altri per 
            conoscere meglio cosa stai organizzando, come ad esempio luogo,data , numero massimo
            di partecipanti e quota di partecipazione.     
        </p>
        <img src="/images/maratona.jpg" alt="persone che corrono durante una maratona">
    </div>
    <div class="div-img"> 
        <img src="/images/museo.jpg" alt="quadro Van Gogh al museo">
        <p>
            Puoi trovare anche gli eventi culturali presenti in italia, come ad esempio 
            mostre al museo e prenotare comodamente dopo esserti iscritto alla nostra piattaforma. 
        </p>
    </div>
    <div id="div-scopriEventi">
        <p>
            Inizia a scoprire nuovi eventi . 
        </p>
        <a href="/php/esplora_eventiRecenti.php">Scopri Eventi</a>
        <p> 
            Oppure
        </p>
        <div id="pulsanti">
            <a  href="/php/loginUtente.php"  >Login</a>
            <a  href="/php/registrazione.php" >Registrati</a>
        </div>       
    </div>
    <footer>
            <?php
                include DIR_LAYOUT.'footer.php';
            ?>
    </footer>
    <?php
            if(isset($_GET['err_msg'])){
                echo "<script>";
                echo "window.alert('".$_GET['err_msg']."');";
                echo "</script>";
            }    
    ?>  
</body>
</html>