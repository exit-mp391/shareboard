<?php

//ova klasa ce da nam zavrsi uzimanje nasih requesta ili bilo koji url, procesurianje kontrolera ili bilo koje akcije


class Bootstrap{
	private $controller;
	private $action;
	private $request;

	public function __construct($request){
		$this->request = $request;
		if($this->request['controller'] == ""){
			$this->controller = 'home';
		} else {
			$this->controller = $this->request['controller'];
		}
		if($this->request['action'] == ""){
			$this->action = 'index';
		} else {
			$this->action = $this->request['action'];
		}
	}

 //proveravamo ako je request prazan odnosno ako je url prazan znaci loaduj home kontroler odnosno home stranicu, ako nije prazno onda uradi sta god je vec requestovano tamo
//proveravamo akciju, (to je npr url/users/regist, register bi bila akcija) ako je prazno onda idi na index stranicu, ako ima nesto onda uradi tu akciju	




	public function createController(){
		// Check Class
		if(class_exists($this->controller)){
			$parents = class_parents($this->controller);
			// Check Extend
			if(in_array("Controller", $parents)){
				if(method_exists($this->controller, $this->action)){
					return new $this->controller($this->action, $this->request);
				} else {
					// Method Does Not Exist
					echo '<h1>Method does not exist</h1>';
					return;
				}
			} else {
				// Base Controller Does Not Exist
				echo '<h1>Base controller not found</h1>';
				return;
			}
		} else {
			// Controller Class Does Not Exist
			echo '<h1>Controller class does not exist</h1>';
			return;
		}
	}
}


//proveravamo dali postoji klasa, dali postoji taj kontroler, dali postoji metoda, 
//proveravamo dali postoji klasa i ako postoji, pravimo promenljivu u kojoj stavljamo taj kontroler i proveravamo dali postoji taj kontroler u parrents
//provaravamo onda da li kontroler ima akciju koja je preneta, i ako ima vratimo kontroler sa tom akcijom i request
//ako ne onda ta metoda ne postoji
//i ako nije u arrayu onda nije nadjen
//i ako ne postoji klasa ne postoji klasa kontroler














