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
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/layout_evento.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/main.css">

    <script type="text/javascript" src="/js/effects.js"></script>
    <script type="text/javascript" src="/js/caricaEventi.js"></script>
    <script type="text/javascript" src="/js/ajaxManager.js"></script>
    <script type="text/javascript" src="/js/gestioneDashboard.js"></script>
    <title>Informazioni Evento</title>
</head>
<body>
     <?php
        echo "<img alt='immagine copertina evento' src=/images/eventi/".$_GET['poster'].">";
     ?>
    <p><?php echo $_GET['titolo']; ?></p>
    <p><?php echo $_GET['descrizione']; ?></p>
    <p>Luogo evento: <?php echo $_GET['luogo']; ?></p>
    <p>Data Evento: <?php echo $_GET['data']; ?></p>
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
    <label>Hai un codice referral?</label>
    <input type='radio' id="sceltaSI" name='selezioneReferral' checked>NO</input>
    <input type='radio' id="sceltaNO" name='selezioneReferral'>SI</input>
    Codice Referral<input type='text' id='referral' name='referral' disabled>
    <button id='buttonPartecipa'>Partecipa</button>
    <p id='errMsg'></p>
    <script>
        function abilitaReferral(){
            if(document.getElementById('sceltaSI').checked !=false){
                document.getElementById('referral').setAttribute('disabled','false');
            }else{
                document.getElementById('referral').setAttribute('disabled','true');
            }
        }
        window.onLoad=function(){
            document.getElementById("sceltaSI").addEventListener('click',abilitaReferral);
            document.getElementById('sceltaNO').addEventListener('click',abilitaReferral);
            //invia la partecipazione 
            document.getElementById('buttonPartecipa').addEventListener('click',inviaPartecipazione);
            //controlla validità referral e indica lo sconto corrispondente
            document.getElementById('referral').addEventListener('blur',function(){
                <?php 
                    $result= getReferrral($_GET['creatore']); 
                    while($row= $result->fetch_assoc()){
                        $referral=$row['referral'];
                    }
                    echo "var referral='".$referral."';";
                ?>
                if(document.getElementById('referral').value ==referral){
                    <?php
                        $result=getScontoReferral($_GET['referral'],$_GET['idEvento']);
                        while($row= $result->fetch_assoc()){
                            $sconto=$row['sconto'];
                        }
                        echo "document.getElementById('errMsg').innerHTML='Verrà applicato uno sconto pari a ".$sconto." '";
                    ?>
                }
            });
        }
        document.getElementById("sceltaSI").addEventListener('click',abilitaReferral);
        document.getElementById('sceltaNO').addEventListener('click',abilitaReferral);
        //invia la partecipazione 
        document.getElementById('buttonPartecipa').addEventListener('click',inviaPartecipazione);
        //controlla validità referral e indica lo sconto corrispondente
        document.getElementById('referral').addEventListener('blur',function(){
            <?php 
                $result= getReferrral($_GET['creatore']); 
                while($row= $result->fetch_assoc()){
                    $referral=$row['referral'];
                }
                echo "var referral='".$referral."';";
            ?>
            if(document.getElementById('referral').value ==referral){
                <?php
                    $result=getScontoReferral($_GET['referral'],$_GET['idEvento']);
                    while($row= $result->fetch_assoc()){
                        $sconto=$row['sconto'];
                    }
                    echo "document.getElementById('errMsg').innerHTML='Verrà applicato uno sconto pari a ".$sconto." '";
                ?>
            }
        });
        function inviaPartecipazione(){
            var url=CaricaEventi.urlRichiestaPHP
                    +"?queryType="
                    +CaricaEventi.AGGIUNGI_PARTECIPAZIONE
                    +"&idEvento="+<?php echo $_GET['idEvento'];?>
                    +"&utente="+<?php echo $_SESSION['userID'];?>;
            var responseFunction=riceviConferma;
            AjaxManager.inviaRichiesta(CaricaEventi.tipoConnessione,
                                url,
                                CaricaEventi.ASYNC_TYPE,
                                null,
                                responseFunction);
        }                        
        function riceviConferma(risposta){
            if(risposta.statoRisposta==CaricaEventi.NO_DATA){
                document.getElementById('errMsg').innerHTML="Impossibile salvare la partecipazione, riprovare!";
            }
            if(risposta.statoRisposta==CaricaEventi.SUCCESS_RESPONSE){
                document.getElementById('errMsg').innerHTML="Evento prenotato!";
            }
        }            
    </script>
</body>
</html>