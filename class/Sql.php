<?php

class Sql extends PDO{ //PDO é uma classe naiva do php

	private $conn;

	public function __construct(){ //conecta ao banco quando um objeto instanciar a classe

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");
	}

	private function setParams($statement,$parameters = array()){

		foreach ($parameters as $key => $value) {
			
			$this->serParam($key,$value);
		}
	}

	private function setParam($statement,$key,$value){

		$statement->bindParam($key,$value);
	}

	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt,$params);

		$stmt->execute();

		return $stmt;

	}

	public function select ($rawQuery,$params = array()){

		$stmt = $this->query($rawQuery,$params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

}

?>