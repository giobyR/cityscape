<?php
    require_once __DIR__."/../configurazione.php";
    require_once DIR_DATABASE."db_config.php";

    $cityscapeDB= new cityscapeDB();

    class cityscapeDB{
        private $conn=null;

        function cityscapeDB(){
            $this->openConnection();
        }

        function openConnection(){
            if(!$this->isOpened()){
                global $dbHostname;
                global $dbUsername;
                global $dbPassword;
                global $dbName;

                $this->conn=new mysqli($dbHostname,$dbUsername,$dbPassword);
                if($this->conn->connect_error){
                    die('Connect Error (' . $this->conn->connect_errno . ') ' . $this->conn->connect_error);
                }
                $this->conn->select_db($dbName) or die("impossibile collegarsi al database cityscape:".mysqli_error());
            }
        }
        function isOpened(){
            return ($this->conn !=null);
        }
        function lanciaQuery($stringa){
            if(!$this->isOpened()){
                $this->openConnection();
            }
            return $this->conn->query($stringa);
        }
        function sqlInjectionFilter($parameter){
			if(!$this->isOpened())
				$this->openConnection();
				
			return $this->conn->real_escape_string($parameter);
        }
        function closeConnection(){
            if($this->conn !==null)
                $this->conn->close();
            $this->conn=null;
        }

    }
?>