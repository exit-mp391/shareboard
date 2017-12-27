<?php


//pravimo base model
//i njega ce da extendujemo sa svim ostalim modelima koje napravimo


abstract class Model{
	protected $dbh;
	protected $stmt;

	public function __construct(){
		$this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
	}

	//konekcija sa bazom

	public function query($query){
		$this->stmt = $this->dbh->prepare($query);
	}

	//Binds the prep statement
	public function bind($param, $value, $type = null){
 		if (is_null($type)) {
  			switch (true) {
    			case is_int($value):
      				$type = PDO::PARAM_INT;
      				break;
    			case is_bool($value):
      				$type = PDO::PARAM_BOOL;
      				break;
    			case is_null($value):
      				$type = PDO::PARAM_NULL;
      				break;
    				default:
      				$type = PDO::PARAM_STR;
  			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

//provervamo koji je tip, i pozovemo statment bind value i prenosimo sve vrednosti


	public function execute(){
		$this->stmt->execute();
	}

	public function resultSet(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

 //funkcija koja vraca rezultate sa fetchAssoc


	public function lastInsertId(){
		return $this->dbh->lastInsertId();
	}

	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
 //metoda koja radi execute i fetchuje podatke koji su trazeni

}

//jedina razlika izmedju resultSet i single je sto single/fetch izvuce jedan rezultat, resultset izvlaci sve/fetchAll