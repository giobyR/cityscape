<?php
    echo '<input type="image" src="/images/prev.png" class="precedente" alt="pulsante precedente"  id="precedente" ';
    echo 'onClick="CaricaEventi.caricaPrecedente('.$searchType.')">';
    echo '<div class="current-page" id="numeroPagina">Pagina 1</div>';
    echo '<input type="image" src="/images/next.png" class="successivo" alt="pulsante successivo" id="successivo" ';
    echo 'onClick="CaricaEventi.caricaSuccessivo('.$searchType.')">';
?>