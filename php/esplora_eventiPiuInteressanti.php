
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
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/formAccountUtente.css">
    <link rel="stylesheet" href="/css/layout_evento.css">
    <link rel="stylesheet" href="/css/pulsantiNavigazione.css">

    <script src="/js/effects.js"></script>
    <script src="/js/caricaEventi.js"></script>
    <script src="/js/ajaxManager.js"></script>
    <script src="/js/gestioneDashboard.js"></script>
    <title>Eventi del momento</title>
</head>
<body onLoad="CaricaEventi.loadData(CaricaEventi.EVENTI_PIU_INTERESSANTI)">
    <header>
        <h1>Eventi considerati piu interessanti dagli utenti</h1>
    </header>
    <nav>
        <?php
            include DIR_LAYOUT.'navbar.php';
        ?>
    </nav>
    <div id="divContenuto"></div>
    <div class="pulsanti-navigazione">
        <?php
            $searchType=EVENTI_PIU_INTERESSANTI;
            include DIR_LAYOUT.'pulsanti_navigazione.php';
        ?>
    </div>
    <footer>
            <?php
                include DIR_LAYOUT.'footer.php';
            ?>
    </footer>
    
</body>
</html>