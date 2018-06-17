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
    <link rel="stylesheet" href="/css/pulsantiNavigazione.css">


    <script type="text/javascript" src="/js/effects.js"></script>
    <script type="text/javascript" src="/js/caricaEventi.js"></script>
    <script type="text/javascript" src="/js/ajaxManager.js"></script>
    <script type="text/javascript" src="/js/gestioneDashboard.js"></script>
    <title>Profilo utente</title>
</head>
<body onLoad="CaricaEventi.loadData(CaricaEventi.EVENTI_PARTECIPAZIONI_UTENTE)">
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
        <div id="paginazioneProfilo">
            <div id="divContenuto"></div>    
            <section class="pulsanti-navigazione">
                <?php
                    $searchType=EVENTI_PARTECIPAZIONI_UTENTE;
                    include DIR_LAYOUT.'pulsanti_navigazione.php';
                ?>
            </section>
        </div>
    </div>
    <footer>
        <?php
            include DIR_LAYOUT.'footer.php';
        ?>
    </footer>
</body>
</html>