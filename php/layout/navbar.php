
<ul class="navbar">
    <li><a href="/index.php" >Home</a></li>
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
            <a href="/php/profilo_infoAccount.php" id='infoAccount' >Account</a>
            <a href='/php/profilo_eventiInteresse.php' >Eventi d'interesse</a>
            <a href='/php/profilo_partecipazioni.php' >Partecipazioni</a>
            <a href='/php/profilo_eventiCreati.php' >Eventi creati</a>
            <a href='/php/login_reg/logout.php'>Logout</a>
        </div>
    </li>
    <li >
        <input type="image" src="/images/search.png" id="searchImg" class="searchImg" alt="background tasto cerca" style="float:right">
    </li>
    <li class="search-bar" id="search-bar">
        <input type="text" placeholder="parola chiave..." id="cercaTesto" >
        <input type="text" placeholder="luogo.." id="cercaLuogo">
        <input type="text" placeholder="yyyy-mm-dd" id="cercaData">
    </li>
</ul>
<script>
    document.getElementById("cercaTesto").addEventListener("input",function(){
                    var valore=document.getElementById("cercaTesto").value;
                    CaricaEventi.cercaParola(CaricaEventi.CERCA_PAROLA_CHIAVE,valore,"parolaChiave")});
    document.getElementById("cercaData").addEventListener("input",function(){
                    var valore2=document.getElementById("cercaData").value;
                    CaricaEventi.cercaParola(CaricaEventi.CERCA_DATA,valore2,"data")});
    document.getElementById("cercaLuogo").addEventListener("input",function(){
                    var valore3=document.getElementById("cercaLuogo").value;
                    CaricaEventi.cercaParola(CaricaEventi.CERCA_LUOGO,valore3,"luogo")});
    document.getElementById("searchImg").addEventListener("click",function(){
                    var gruppoSearch=document.getElementById('search-bar');
                    var larghezza=gruppoSearch.offsetWidth;
                    if(gruppoSearch.clientHeight ==0){

                        if(larghezza>700){
                            gruppoSearch.style.height="40px";
                        }else{
                            gruppoSearch.style.height="auto";
                        }
                    }else{
                        gruppoSearch.style.height="0";
                    }
    });
    /*
    var elems=document.getElementsByTagName('a');
    for(var i=0;i<elems.length;i++){
        elems[i].addEventListener("click",function(){
            console.log("click funziona!");
            var activeElem=document.getElementsByClassName("active");
            activeElem[0].className = activeElem[0].className.replace(" active", "");
            this.className +=" active";
        });
    }
    */
    document.getElementById('cercaData').onchange=function(){
                var campoDoveSegnalare=document.getElementById('err_data');
                var campoDaVerificare=document.getElementById('cercaData');
                gestisciErrore.verificaData(campoDoveSegnalare,campoDaVerificare);
            };
</script>