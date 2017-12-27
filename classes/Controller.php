<?php
abstract class Controller{
	protected $request;
	protected $action;

	public function __construct($action, $request){
		$this->action = $action;
		$this->request = $request;
	}

	public function executeAction(){
		return $this->{$this->action}();
	}

	protected function returnView($viewmodel, $fullview){
		$view = 'views/'. get_class($this). '/' . $this->action. '.php';
		if($fullview){
			require('views/main.php');
		} else {
			require($view);
		}
	}
 //proveravamo dali je pun view
 //ili individualne views
}

//vracamo nas view
//unutar nasih kontrolera zelimo da dodelimo view, zelimo da prenesemo vrednosti view na nase kontrolere


//ovo je abstratktna klasa, posto ne moramo da je itanciramo, vec ce nasi drugi kontroleri da extenduju od nje
//ovo je base kontroler klasa, sve ostale ce extenduju



