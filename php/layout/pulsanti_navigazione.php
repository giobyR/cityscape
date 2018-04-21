<?php
    echo '<input type="image" src="/images/prev.png" value="" class="precedente">';
    echo '<div class="current-page">Pagina 1</div>';
    echo '<input type="image" src="/images/next.png" value="" class="successivo">';
echo '</section>';
echo '<script>';
    echo 'document.getElementByCLassName("precedente").addEventListener("click",function(){CaricaEventi.caricaPrecedente('.$searchType.')});';
    echo 'document.getElementByCLassName("successivo").addEventListener("click",function(){CaricaEventi.caricaSuccessivo('.$searchType.')});';
?>