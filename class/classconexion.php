<?php
class Db{
		
	private $dbHost     = "sql213.byethost9.com";
    private $dbUsername = "b9_32075627";
    private $dbPassword = "95831mqd";
    private $dbName     = "b9_32075627_restaurant_new";
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
