<?php
    session_start();
    require_once __DIR__."/configurazione.php";
    require_once DIR_DATABASE."queryEvento.php";

    if($_SERVER["REQUEST_METHOD"]!="GET"){
        header("/index.php?errore=Devi registrarti per iscriverti all'evento");
        return;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/pagina_evento.css">

    <script type="text/javascript" src="/js/effects.js"></script>
    <script type="text/javascript" src="/js/caricaEventi.js"></script>
    <script type="text/javascript" src="/js/ajaxManager.js"></script>
    <script type="text/javascript" src="/js/gestioneDashboard.js"></script>
    <script type="text/javascript" src="/js/gestionePaginaEvento.js"></script>

    <title>Informazioni Evento</title>
</head>
<body>
    <nav>
        <?php
            include DIR_LAYOUT.'navbar.php';
        ?>
    </nav>
    <div id="poster">
        <?php
        echo "<img alt='immagine copertina evento' src=/images/eventi/".$_GET['poster'].">";
        ?>
    </div>
    <header id="titolo">
        <h1>
            <?php echo $_GET['titolo']; ?>   
        </h1>
    </header>     
    <p id="descrizione"><?php echo $_GET['descrizione']; ?></p>
    <div id="luogo-data">
        <p>Luogo evento: <?php echo $_GET['luogo']; ?></p>
        <p>Data Evento: <?php echo $_GET['data']; ?></p>
    </div>
    <div id="costo">
        <p>Costo evento:<?php 
                            if($_GET['prezzo']==0){
                                echo "gratis";
                            }else{
                                echo $_GET['prezzo']; 
                            }
                        ?>
        </p>
        <p>Numero massimo di partecipanti: <?php 
                                                if($_GET['maxPartecipanti']==0){
                                                    echo "nessun limite";
                                                }else{
                                                    echo $_GET['maxPartecipanti'];
                                                }     
                                            ?>
        </p>
    </div>
    <div id="referral-contenitore">
        <div id="selezione-referral">
            <label>Hai un codice referral?</label>
            <input type='radio' id="sceltaSI" name='selezioneReferral' checked>NO</input>
            <input type='radio' id="sceltaNO" name='selezioneReferral'>SI</input>
        </div>
        <span >
            <label for="referral">Codice Referral:</label>
            <input type='text' id='referral' name='referral' disabled>
        </span>
        <button id='buttonPartecipa'>Partecipa</button>
    </div>
    <p id='errMsg'></p>
    <?php
        $result= getReferral($_GET['creatore']); 
        while($row= $result->fetch_assoc()){
            $referral=$row['codiceReferral'];
        }
        echo "<script>";
        echo "document.getElementById('referral').addEventListener('blur',function(){ verificaReferral(".$referral.",".$_SESSION['userID'].")});";
        echo "document.getElementById('buttonPartecipa').addEventListener('click',inviaPartecipazione(".$_GET['idEvento'].",".$_SESSION['userID']."));";
        echo "document.getElementById('sceltaSI').addEventListener('click',abilitaReferral);";
        echo "document.getElementById('sceltaNO').addEventListener('click',abilitaReferral);";
        echo "</script>";
    ?>
    <footer>
            <?php
                include DIR_LAYOUT.'footer.php';
            ?>
    </footer>
</body>
</html>