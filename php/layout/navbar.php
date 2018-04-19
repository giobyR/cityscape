<div>
<ul class="navbar">
    <li class="active"><a>Home</a></li>
    <li><a href='/php/esplora_eventiRecenti.php' >Ultimi Eventi Inseriti</a></li>
    <li><a href='/php/esplora_eventiPiuInteressanti.php' >Eventi del momento</a></li>
    <li class="dropdown">
        <a class="dropdown-button" href='javascript:void(0)'>Categoria Eventi</a>
        <div class="dropdown-content">
            <a href='/php/esplora_eventiPerCategoria.php?categoria=bambini' >Bambini</a>
            <a href='/php/esplora_eventiPerCategoria.php?categoria=cinema' >Cinema</a>
            <a href='/php/esplora_eventiPerCategoria.php?categoria=concerti' >Concerti</a>
            <a href='/php/esplora_eventiPerCategoria.php?categoria=cultura' >Cultura</a>
            <a href='/php/esplora_eventiPerCategoria.php?categoria=nightlife' >Nightlife</a>
            <a href='/php/esplora_eventiPerCategoria.php?categoria=sport' >Sport</a>
            <a href='/php/esplora_eventiPerCategoria.php?categoria=altro' >Altro</a>
        </div>
    </li>
    <li class="dropdown">
        <a class="dropdown-button" href='javascript:void(0)'>Profilo Personale</a>
        <div class="dropdown-content">
            <a href="/php/profilo_infoAccount.php" >Account</a>
            <a href='/php/profilo_eventiInteresse.php' >Eventi d'interesse</a>
            <a href='/php/profilo_partecipazioni.php' >Partecipazioni</a>
            <a href='/php/profilo_eventiCreati.php' >Eventi creati</a>
            <a href='php/login_reg/logout.php'>Logout</a>
        </div>
    </li>
    <li class="searchImg">
        <input type="image" src="/images/search.png">
    </li>
    <li class="search-bar">
        <input type="text" placeholder="parola chiave..." name="cercaTesto">
        <input type="date" placeholder="yyyy-mm-dd" name="cercaData">
        <input type="text" placeholder="luogo.." name="luogo">
        <input type=""
    </li>
</ul>
</div>