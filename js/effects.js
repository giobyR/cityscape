
    function openSidebar(){
        document.getElementById("sideBar").setAttribute("style","width:250px");
    }
    function closeSidebar(){
        document.getElementById("sideBar").setAttribute("style","width:0");
    }
    function searchOnHover(){
        document.getElementById("searchBar").setAttribute("style","opacity:1");
        document.getElementById("searchBar").setAttribute("style","transition:opacity 1s linear");
    }
    function searchOnHoverOut(){
        document.getElementById("searchBar").setAttribute("style","opacity:0");
        document.getElementById("searchBar").setAttribute("style","position:absolute");
    }
    function displayEventOnClick(element){
        //element.addEventListener('click',function(){
            var fratello=element.nextElementSibling;
            if(fratello.style.maxHeight){
                fratello.style.maxHeight=null;
            }else{
                fratello.style.maxHeight=fratello.scrollHeight+'px';
            }
        //});
    }