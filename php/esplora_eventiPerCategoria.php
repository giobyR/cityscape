
<?php
    session_start();
    require_once __DIR__."/configurazione.php";
    
    require_once DIR_SESSION."sessionManager.php";
    if(!isLogged()){
        header("Location: /index.php");
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
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/formAccountUtente.css">
    <link rel="stylesheet" href="/css/layout_evento.css">
    <link rel="stylesheet" href="/css/pulsantiNavigazione.css">


    <script type="text/javascript" src="/js/effects.js"></script>
    <script type="text/javascript" src="/js/caricaEventi.js"></script>
    <script type="text/javascript" src="/js/ajaxManager.js"></script>
    <script type="text/javascript" src="/js/gestioneDashboard.js"></script>
    <title>Eventi del momento</title>
</head>
<body >
    <header>
        <h1>Eventi creati</h1>
    </header>
    <nav>
        <?php
            include DIR_LAYOUT.'navbar.php';
        ?>
    </nav>
    <div id="divContenuto"></div>
    <section class="pulsanti-navigazione">
        <?php
            include DIR_LAYOUT.'pulsanti_navigazione.php';
        ?>
    </section>
    <footer>
            <?php
                include DIR_LAYOUT.'footer.php';
            ?>
    </footer>
    
    <?php
    //carico gli eventi corrispondenti alla categoria richiesta
    //tramite richiesta Ajax inviata al server
        if(isset($_GET['categoria'])){
            $categoria=strtoupper($_GET['categoria']);
            echo "<script>";
            //echo "document.body.addEventListener('load',CaricaEventi.loadData(CaricaEventi.CATEGORIA_".$categoria."));";
            echo "CaricaEventi.loadData(CaricaEventi.CATEGORIA_".$categoria.")";
            echo "</script>";
        }
    ?>    
</body>
</html>