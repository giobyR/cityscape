
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

    <script type="text/javascript" src="/js/effects.js"></script>
    <script type="text/javascript" src="/js/caricaEventi.js"></script>
    <script type="text/javascript" src="/js/ajaxManager.js"></script>
    <script type="text/javascript" src="/js/gestioneDashboard.js"></script>
    <title>Eventi del momento</title>
</head>
<body onLoad="CaricaEventi.loadData(CaricaEventi.EVENTI_PIU_INTERESSANTI)">
    <header>
        <h1>Eventi creati</h1>
    </header>
    <nav>
        <?php
            //echo "<div id='sidebar'>";
            include DIR_LAYOUT.'navbar.php';
            //echo "</div>";
        ?>
    </nav>
    <div id="divContenuto"></div>
    <footer>
        <address>
            Creato da Popitanu Silviu Roberto<br>
            Contatti: <a href="<mailto:>popitanu_roberto@hotmail.com</mailto:>">Popitanu S. Roberto</a><br>
            Indirizzo: Sarzana(SP),Italia<br>
        </address>
        <p><a href="../html/condizioniUso.html">Termini e condizioni d'uso</a></p>
    </footer>
    <?php
        if(isset($_GET['categoria'])){
            $categoria=strtoupper($_GET['categoria']);
            echo "<script>";
            echo "document.body.addEventListener('load',CaricaEventi.loadData(CaricaEventi.CATEGORIA_".$categoria."));";
            echo "</script>";
        }
    ?>    
</body>
</html>