<?php
//costanti per i path
    define("DIR_BASE",__DIR__.'/');
    define("DIR_DATABASE",DIR_BASE."database/");
    define("DIR_AJAX",DIR_BASE."ajax/");
    define("DIR_SESSION",DIR_BASE."session/");
    define("DIR_LOGIN_REG",DIR_BASE."login_reg/");
    define("DIR_LAYOUT",DIR_BASE."layout/");
    
    //costanti per chiamate Ajax
    define('EVENTI_PIU_RECENTI',0);
    define('EVENTI_PIU_INTERESSANTI',1);
    define('EVENTI_INTERESSE_UTENTE',2);
    define('EVENTI_PARTECIPAZIONI_UTENTE',3);
    define('EVENTI_CREATI_UTENTE',4);
    define('ACCOUNT_UTENTE',5);
    define('AGGIORNA_UTENTE',7);
    define('CATEGORIA_BAMBINI',6);
    define('CATEGORIA_CINEMA',8);
    define('CATEGORIA_CONCERTI',9);
    define('CATEGORIA_CULTURA',10);
    define('CATEGORIA_NIGHTLIFE',11);
    define('CATEGORIA_SPORT',12);
    define('CATEGORIA_ALTRO',13);
    define('CANCELLA_EVENTO',14);
    define('AGGIUNGI_PARTECIPAZIONE',15);
    define('AGGIUNGI_INTERESSE_UTENTE',16);
    define('RICEVI_SCONTO_REFERRAL',17);
    define('CERCA_PAROLA_CHIAVE',18);
    define('CERCA_LUOGO',19);
    define('CERCA_DATA',20);
    define('SALVA_LUOGO',21);

?>