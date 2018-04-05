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
            $str="\$_".$tipoRichiesta."['str']";
            $risposta=json_decode($str,false);
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
            $this->descizione=$descrizione;
            $this->data=$data;
            $this->luogo=$luogo;
            $this->prezzo=$prezzo;
            $this->maxPartecipanti=$maxPartecipanti;
            $this->poster=$poster;
            $this->creatore=$creatore;
        }         
    }
?>