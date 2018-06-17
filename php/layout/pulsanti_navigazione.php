<?php
    echo '<input type="image" src="/images/prev.png" value="" class="precedente" ';
    echo 'onClick="CaricaEventi.caricaPrecedente('.$searchType.')">';
    echo '<div class="current-page" id="numeroPagina">Pagina 1</div>';
    echo '<input type="image" src="/images/next.png" value="" class="successivo" ';
    echo 'onClick="CaricaEventi.caricaSuccessivo('.$searchType.')">';
?>