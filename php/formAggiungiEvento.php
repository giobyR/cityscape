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
    <script type="text/javascript" src="../js/gestisciErroreForm.js"></script>
    <title>Aggiungi Evento</title>
</head>
<body>

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

    <script>
    /*
    function disabilitaPrezzo(){
        var radioBox=document.getElementById("selezioneSI");
        if(radioBox.checked==true){
            document.getElementById("prezzoEvento").disabled=true;
        }else{
            document.getElementById("prezzoEvento").disabled=false;
        }
    }
    */
    function verificaData(){
        var re=/^(\d{4})\/(\d{1,2})\/(\d{1,2})$/;
        var data=document.getElementById('dataEvento');
        var err=document.getElementById('err_data');
        var vm;
        if((data.value !='')&&(val=data.value.match(re))){
                //giorno fra 1 e 31 
                if(val[3]<1 || val[1]>31){
                    vm="il giorno inserito non e' valido!";
                    data.setCustomValidity(vm);
                    gestisciErroreForm.segnalaErrore(err,data);
                }
                //mese fra 1 e 12
                if(val[2]<1 || val[2]>12){
                    vm="il mese inserito non e'valido!";
                    data.setCustomValidity(vm);
                    gestisciErroreForm.segnalaErrore(err,data);
                }
                //anno  inferiore a quello odierno
                if(val[1]> 1910 || val[3]<(new Date().getFullYear())){
                    vm="l'anno inserito non e'valido!";
                    data.setCustomValidity(vm);
                    gestisciErroreForm.segnalaErrore(err,data);
                }
        }else{
            vm="inserire la data nel formato gg/mm/aaaa";
            data.setCustomValidity(vm);
            gestisciErroreForm.segnalaErrore(err,data);
        }     
    }
    document.getElementById("caricaEvento").namedItem("selezioneGratis").onclick=disabilitaPrezzo;
    document.getElementById('dataEvento').onblur=verificaData;
</script>
</body>
</html>
