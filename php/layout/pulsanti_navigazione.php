<?php
    echo '<input type="image" src="/images/prev.png" value="" class="precedente" disabled ';
    echo 'onClick="CaricaEventi.caricaPrecedente('.$searchType.')">';
    echo '<div class="current-page">Pagina 1</div>';
    echo '<input type="image" src="/images/next.png" value="" class="successivo" disabled ';
    echo 'onClick="CaricaEventi.caricaSuccessivo('.$searchType.')">';
?>