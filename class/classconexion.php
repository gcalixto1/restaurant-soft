<?php
class Db{
		
	private $dbHost     = "127.0.0.1";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "turadiop_restaurant_new";
	protected $p; 
	protected $dbh; 
	
    public function __construct(){
        if(!isset($this->dbh)){
            // Connect to the database
            try{

                $conn = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUsername, $this->dbPassword,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->dbh = $conn;
            }catch(PDOException $e){
                die("Failed to connect with MySQL: " . $e->getMessage());
            }
        }
    }

		public function SetNames()
	{
		return $this->dbh->query("SET NAMES 'utf8'");
	}

###### FIN DE CLASE #####	

}	
?>