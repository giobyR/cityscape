<div>
<ul class="navbar">
    <li class="active"><a>Home</a></li>
    <li><a href='#' onclick='CaricaEventi.loadData(CaricaEventi.EVENTI_PIU_RECENTI)'>Ultimi Eventi Inseriti</a></li>
    <li><a href='#' onclick='CaricaEventi.loadData(CaricaEventi.EVENTI_PIU_INTERESSANTI)'>Eventi del momento</a></li>
    <li class="dropdown">
        <a class="dropdown-button" href='javascript:void(0)'>Categoria Eventi</a>
        <div class="dropdown-content">
            <a href='#' onclick="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'bambini')">Bambini</a>
            <a href='#' onclick="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'cinema')">Cinema</a>
            <a href='#' onclick="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'concerti')">Concerti</a>
            <a href='#' onclick="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'cultura')">Cultura</a>
            <a href='#' onclick="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'nightlife')">Nightlife</a>
            <a href='#' onclick="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'sport')">Sport</a>
            <a href='#' onclick="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'altro')">Altro</a>
        </div>
    </li>
    <li class="dropdown">
        <a class="dropdown-button" href='javascript:void(0)'>Profilo Personale</a>
        <div class="dropdown-content">
            <a href="/php/mainUtente.php" onclick='CaricaEventi.loadData(CaricaEventi.ACCOUNT_UTENTE)'>Account</a>
            <a href='/php/mainUtente.php' onclick='CaricaEventi.loadData(CaricaEventi.EVENTI_INTERESSE_UTENTE)'>Eventi d'interesse</a>
            <a href='/php/mainUtente.php' onclick='CaricaEventi.loadData(CaricaEventi.EVENTI_PARTECIPAZIONI_UTENTE)'>Partecipazioni</a>
            <a href='/php/mainUtente.php' onclick='CaricaEventi.loadData(CaricaEventi.EVENTI_CREATI_UTENTE)'>Eventi creati</a>
            <a href='php/login_reg/logout.php'>Logout</a>
        </div>
    </li>
    
</ul>
</div>