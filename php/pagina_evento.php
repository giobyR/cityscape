<?php
    session_start();
    require_once __DIR__."/configurazione.php";
    require_once DIR_DATABASE."queryEvento.php";

    if($_SERVER["REQUEST_METHOD"]!="GET"){
        header("Location: /index.php?err_msg='Devi registrarti per iscriverti all'evento'");
        return;
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/pagina_evento.css">

    <script src="/js/effects.js"></script>
    <script src="/js/caricaEventi.js"></script>
    <script src="/js/ajaxManager.js"></script>
    <script src="/js/gestioneDashboard.js"></script>
    <script src="/js/gestionePaginaEvento.js"></script>

    <title>Informazioni Evento</title>
</head>
<body >
    <nav>
        <?php
            include DIR_LAYOUT.'navbar.php';
        ?>
    </nav>
    <header id="titolo">
        <h1>
            <?php echo $_GET['titolo']; ?>   
        </h1>
    </header> 
    <div class="contenitore-posterInfo">
        <div id="poster">
            <?php
            echo "<img alt='immagine copertina evento' src=/images/eventi/".$_GET['poster'].">";
            ?>
        </div>
        <div id="contenitore-infoGenerali">
            <div id="luogo-data">
                <span>
                    <label class="etichetta">Luogo evento: </label>
                    <label class="valore">
                        <?php echo $_GET['luogo']; ?>
                    </label>
                </span>
                <span>
                    <label class="etichetta">Data Evento:</label>
                    <label class="valore">
                        <?php echo $_GET['data']; ?>
                    </label>
                </span>
            </div>
            <div id="costo">
                <span>
                    <label class="etichetta">Costo evento:</label>
                    <label class="valore">
                                    <?php 
                                        if($_GET['prezzo']==0){
                                            echo "gratis";
                                        }else{
                                            echo $_GET['prezzo']; 
                                        }
                                    ?>
                    </label>
                </span>
                <span>
                    <label class="etichetta">Numero massimo di partecipanti: </label>
                    <label class="valore">
                                                        <?php 
                                                            if($_GET['maxPartecipanti']==0){
                                                                echo "nessun limite";
                                                            }else{
                                                                echo $_GET['maxPartecipanti'];
                                                            }     
                                                        ?>
                    </label>
                </span>
            </div>
        </div>
    </div>
        
    <p id="descrizione"><?php echo $_GET['descrizione']; ?></p>
    
    <div id="referral-contenitore">
        <div id="selezione-referral">
            <label>Hai un codice referral?</label>
            <input type='radio' id="sceltaSI" name='selezioneReferral' value="si" onclick="abilitaReferral()">SI
            <input type='radio' id="sceltaNO" name='selezioneReferral' value="no" checked onclick="abilitaReferral()">NO
        </div>
        <span >
            <label for="referral">Codice Referral:</label>
            <input type='text' id='referral' name='referral' disabled>
            <button id="verificaReferral" disabled >VERIFICA</button>
        </span>
        <p id='errMsg' class="errore"></p>
        <span class="button-group">
            <button id='buttonPartecipa'>Partecipa</button>
            <button id='buttonInteresse'>Sono Interessato</button>
            <button id='buttonSegnala' title="segnala come contenuto inappropiato">Segnala Contenuto</button>
        </span>
    </div>
    <?php
    //prelevo il referral della persona che ha organizzato l'evento
        $result= getReferral($_GET['creatore']); 
        while($row= $result->fetch_assoc()){
            $referral=$row['codiceReferral'];
        }
        
        echo "<script>";
            echo "document.getElementById('verificaReferral').addEventListener('click',function(){ verificaReferral('".$referral."',".$_GET['idEvento'].")});";
            if(empty($_SESSION['userID'])){
                echo "document.getElementById('buttonPartecipa').disabled=true; ";
                echo "document.getElementById('errMsg').innerHTML='Devi esssere loggato per inviare partecipazione'; ";
            }else{
                echo "document.getElementById('buttonPartecipa').addEventListener('click',function(){ inviaPartecipazione(".$_GET['idEvento'].",".$_SESSION['userID'].")});";
                echo "document.getElementById('buttonInteresse').addEventListener('click',function(){ aggiungiInteresse(".$_GET['idEvento'].",".$_SESSION['userID'].")});";
                echo "document.getElementById('buttonSegnala').addEventListener('click',function(){ segnala_evento(".$_GET['idEvento'].")});";

            }
        echo "</script>";
    ?>
    <footer>
            <?php
                include DIR_LAYOUT.'footer.php';
            ?>
    </footer>
</body>
</html>