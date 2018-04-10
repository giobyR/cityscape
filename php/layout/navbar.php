<div>
<ul class="navbar">
    <li class="active"><a>Home</a></li>
    <li><a href='CaricaEventi.loadData(CaricaEventi.EVENTI_PIU_RECENTI)'>Ultimi Eventi Inseriti</a></li>
    <li><a href='CaricaEventi.loadData(CaricaEventi.EVENTI_PIU_INTERESSANTI)'>Eventi del momento</a></li>
    <li class="dropdown">
        <a class="dropdown-button" href='javascript:void(0)'>Categoria Eventi</a>
        <div class="dropdown-content">
            <a href="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'bambini')">Bambini</a>
            <a href="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'cinema')">Cinema</a>
            <a href="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'concerti')">Concerti</a>
            <a href="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'cultura')">Cultura</a>
            <a href="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'nightlife')">Nightlife</a>
            <a href="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'sport')">Sport</a>
            <a href="CaricaEventi.loadDataCategoria(CaricaEventi.CATEGORIA,'altro')">Altro</a>
        </div>
    </li>
    <li class="dropdown">
        <a class="dropdown-button" href='javascript:void(0)'>Profilo Personale</a>
        <div class="dropdown-content">
            <a href='CaricaEventi.loadData(CaricaEventi.ACCOUNT_UTENTE)'>Account</a>
            <a href='CaricaEventi.loadData(CaricaEventi.EVENTI_INTERESSE_UTENTE)'>Eventi d'interesse</a>
            <a href='CaricaEventi.loadData(CaricaEventi.EVENTI_PARTECIPAZIONI_UTENTE)'>Partecipazioni</a>
            <a href='CaricaEventi.loadData(CaricaEventi.EVENTI_CREATI_UTENTE)'>Eventi creati</a>
            <a>Logout</a>
        </div>
    </li>
    
</ul>
</div>