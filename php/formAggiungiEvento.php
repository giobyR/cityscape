<?php
    session_start();
    require_once __DIR__."/configurazione.php";
    require_once DIR_SESSION."sessionManager.php";
    if(!isLogged()){
        header("Location: ../index.html");
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

    <script type="text/javascript" src="/js/gestisciErroreForm.js"></script>
    <script type="text/javascript" src="/js/effects.js"></script>
    <title>Aggiungi Evento</title>
</head>
<body>
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
            <form id='caricaEvento' method="POST" action="/php/aggiungiEvento.php" enctype="multipart/form-data">
                Titolo*<input type="text" name="titoloEvento" required><br>
                Data Evento*<input type="data" name="dataEvento" id="dataEvento" placeholder='aaaa/mm/dd' required>
                <span id="err_data"></span><br>
                Luogo Evento*<input type="text" name="luogoEvento" required><br>
                Descrizione*<textarea name="descrizioneEvento" 
                            row="10" 
                            columns="50" 
                            required >
                        </textarea><br>
                Numero massimo di partecipanti<input type="number" name="maxPartecipanti" title="lasciare vuoto se non ci sono limiti al numero di partecipanti"><br>
                <label>L'evento è gratis?</label><br>
                SI<input type='radio' name='selezioneGratis' id="selezioneSI" value='si' checked required >
                NO<input type='radio' name='selezioneGratis' id="selezioneNO" value='no'  required>
                Prezzo evento(€)<input type='number' name='prezzoEvento' id="prezzoEvento" value='0' title="scrivere 0 se l'evento è gratis" required><br>
                categoria Evento*<br>
                    <select name='categoriaEvento' required>
                        <option value='bambini'>Bambini</option>
                        <option  value='cinema'>Cinema</option>
                        <option value='concerti'>Concerti</option>
                        <option value='cultura'>Cultura</option>
                        <option value='nightlife'>Nightlife</option>
                        <option value='sport'>Sport</option>
                        <option value='altro'>Altro</option>
                    </select><br>
                Carica poster evento*<input type="file" name="posterEvento" required><br>
                <input type="submit" name="submit" value="Aggiungi Evento">
            </form>
            <label>I campi contrassegnati con (*) sono obbligatori</label>
            <?php
                if(isset($_GET['err_msg'])){
                    echo '<p> '.$_GET['err_msg'].'</p>';
                }
            ?>
        </div>
        <footer>
            <?php
                include DIR_LAYOUT.'footer.php';
            ?>
        </footer>
    </div>
    <script>
            //document.getElementById("caricaEvento").namedItem("selezioneGratis").onclick=disabilitaPrezzo;
            document.getElementById('dataEvento').onblur=function(){
                gestisciErrore.verificaData(document.getElementById('err_data'),document.getElementById('dataEvento'))};
    </script>
</body>
</html>
