<?php
    session_start();
    require_once __DIR__."/configurazione.php";
    require_once DIR_SESSION."sessionManager.php";
    if(!isLogged()){
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/formAccountUtente.css">


    <script src="/js/gestisciErroreForm.js"></script>
    <script src="/js/effects.js"></script>
    <title>Aggiungi Evento</title>
</head>
<body>
        <nav class="navbar">
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
            <div id="divContenuto" class="content">
                <form id='caricaEvento' method="POST" action="/php/aggiungiEvento.php" enctype="multipart/form-data" class="form-content">
                    <label for="titoloEvento">Titolo*</label>
                    <input type="text" name="titoloEvento" id="titoloEvento" required>
                    <div class="box-orizzontale">
                        <div class="displayVerticale">
                            <label for="dataEvento">Data Evento*</label>
                            <input type="text" name="dataEvento" id="dataEvento" placeholder='aaaa/mm/dd' required >
                            <span id="err_data" class="errore"></span>
                        </div>
                        <div class="displayVerticale">
                            <label for="luogoEvento">Luogo Evento*</label>
                            <input type="text" name="luogoEvento" required id="luogoEvento">
                        </div>
                    </div>
                    <label for="descrizioneEvento">Descrizione*</label>
                    <textarea name="descrizioneEvento" id="descrizioneEvento"
                                rows="10" 
                                cols="100" 
                                required >
                    </textarea>
                    <label for="maxPartecipanti">Numero massimo di partecipanti</label>
                    <input type="number" id="maxPartecipanti" name="maxPartecipanti" title="lasciare vuoto se non ci sono limiti al numero di partecipanti">
                    <label>L'evento è gratis?</label>
                    <div class="selezionePrezzo">
                        <label for="selezioneSI">SI</label>
                        <input type='radio' name='selezioneGratis' id="selezioneSI" value='si' checked required >
                        <label for="selezioneNO">NO</label>
                        <input type='radio' name='selezioneGratis' id="selezioneNO" value='no'  required>
                    </div>
                    <div class="selezionePrezzo">
                    </div>
                    <label for="prezzoEvento">Prezzo evento(€)</label>
                    <input type='number' name='prezzoEvento' id="prezzoEvento" value="0" title="scrivere 0 se l'evento è gratis" required>
                    <div class="select-container">
                        <label for="categoriaEvento">categoria Evento*</label>
                        <select name='categoriaEvento' id="categoriaEvento" required >
                            <option value=''>Seleziona</option>
                            <option value='bambini'>Bambini</option>
                            <option value='cinema'>Cinema</option>
                            <option value='concerti'>Concerti</option>
                            <option value='cultura'>Cultura</option>
                            <option value='nightlife'>Nightlife</option>
                            <option value='sport'>Sport</option>
                            <option value='altro'>Altro</option>
                        </select>
                        <p class="errore" id="err_msg"></p>
                    </div>    
                    <label for="posterEvento">Carica poster evento*</label>
                    <input type="file" id="posterEvento" name="posterEvento" required>
                    <input type="submit" id="submitEvent" name="submit" value="Aggiungi Evento">
                    <label>I campi contrassegnati con (*) sono obbligatori</label>
                <?php
                    if(isset($_GET['err_msg'])){
                        echo '<p> '.$_GET['err_msg'].'</p>';
                    }
                ?>
                </form>
            </div>
        </div>
        <footer>
            <?php
                include DIR_LAYOUT.'footer.php';
            ?>
        </footer>
    <script>
            //document.getElementById("caricaEvento").namedItem("selezioneGratis").onclick=disabilitaPrezzo;
            document.getElementById('dataEvento').onchange=function(){
                var campoDoveSegnalare=document.getElementById('err_data');
                var campoDaVerificare=document.getElementById('dataEvento');
                gestisciErrore.verificaData(campoDoveSegnalare,campoDaVerificare);
            };
            document.getElementById('categoriaEvento').onblur=function(){
                var val=document.getElementById('categoriaEvento');
                if(val.value=="Seleziona"){
                    val.setCustomValidity("categoria scelta non valida!")
                    document.getElementById('err_msg').innerHTML=val.validationMessage;
                }
            };    
    </script>
    
</body>
</html>
