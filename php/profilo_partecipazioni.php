<?php
    //session_start();
    require_once __DIR__."/configurazione.php";
    /*
    require_once DIR_SESSION."sessionManager.php";
    if(!isLogged()){
        header("Location: /index.html");
        exit;
    }
    */
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
<body onLoad="CaricaEventi.loadData(CaricaEventi.EVENTI_PARTECIPAZIONI_UTENTE)">
    <?php
        include DIR_LAYOUT.'sidebar.php';
    ?>
    <div id='main'>
        <nav>
            <?php
                include DIR_LAYOUT.'navbar.php';
            ?>
        </nav>
        <span style="font-size:30px;cursor:pointer" onclick="openSidebar()">&#9776;Profilo Personale</span>
        <div id="divContenuto">
        </div>
        <footer>
            <?php
                include DIR_LAYOUT.'footer.php';
            ?>
        </footer>
    </div>
</body>
</html>