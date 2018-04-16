<?php
    class RispostaAjax{
        public $statoRisposta;
        // 1 => codice errore
        //0 => nessun errore
        //-1 => warnings
        public $messaggio;
        public $data;
        //public $risposta;
        function RispostaAjax($statoRisposta=1,$messaggio="Errore non identificato",$data=null){
            $this->statoRisposta=$statoRisposta;
            $this->messaggio=$messaggio;
            $this->data=$data;
        }
        function getRisposta($tipoRichiesta){
            if(strpos($tipoRichiesta,'GET')){
                $str=$_GET['str'];
                $risposta=json_decode($str,false);
            }else{
                //$str=$_POST['str'];
                $str=stripslashes(htmlspecialchars($_POST['str']));
                $risposta=json_decode($str,false);
            }
            return $risposta;  
        }
    }
    class Evento{
        public $idEvento;
        public $titolo;
        public $descrizione;
        public $data;
        public $luogo;
        public $prezzo;
        public $maxPartecipanti;
        public $poster;
        public $creatore;
        function Evento($idEvento=null,
                        $titolo=null,
                        $descrizione=null,
                        $data=null,
                        $luogo=null,
                        $prezzo=null,
                        $maxPartecipanti=null,
                        $poster=null,
                        $creatore=null){
            $this->idEvento=$idEvento;
            $this->titolo=$titolo;
            $this->descrizione=$descrizione;
            $this->data=$data;
            $this->luogo=$luogo;
            $this->prezzo=$prezzo;
            $this->maxPartecipanti=$maxPartecipanti;
            $this->poster=$poster;
            $this->creatore=$creatore;
        }         
    }
    class Utente{
        public $idUtente;
        public $nome;
        public $cognome;
        public $email;
        public $password;
        public $referral;
        function Utente($idUtente=null,
                        $nome=null,
                        $cognome=null,
                        $email=null,
                        $password=null,
                        $referral=null){
            $this->idUtente=$idUtente;
            $this->nome=$nome;
            $this->cognome=$cognome;
            $this->email=$email;
            $this->password=$password;
            $this->referral=$referral;
        }
    }
?>