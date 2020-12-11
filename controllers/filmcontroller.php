<?php
namespace controllers;
use models\FilmModel;
class FilmController
{
	private $filmModel;
	function __construct(){

		$this->filmModel = new FilmModel();
	}
	public function list()
	{
		$films=$this->filmModel->getAllFilms();
		$this->loadView("list-view", ["films"=>$films,"pageTitle"=>"List all films"]);
	}
	public function details($filmId){
	    $film = $this->filmModel->getFilmById($filmId);
	    $this->loadView("details-view", ["film"=>$film,"pageTitle"=>"Film Details"]);
	}
	public function create(){
		$this->loadView("create-view", ["pageTitle"=>"Create a new film"]);
	}
	public function save(){
		$title=$_POST['title'];
		$year=$_POST['year'];
		$duration=$_POST['duration'];
		$certId=$_POST['certificate'];

		$msg="";
		if($this->filmModel->saveFilm($title,$year,$duration,$certId)){
		    $msg="Successfully added the details for ".$title;
		}else{
		    $msg="There was a problem inserting the data";
		}
		$this->loadView("save-view", ["pageTitle"=>"Save film","msg"=>$msg]);
	}
	public function deleteList(){
		$films = $this->filmModel->getAllFilms();
		$this->loadView("delete-list-view", ["pageTitle"=>"Delete films","films"=>$films]);
	}
	public function deleteFilms()
	{
		if(isset($_POST['ids'])){
			//the ids come from the form as an array e.g. ids=[3,6,7]
			$ids = $_POST['ids'];
			$this->filmModel->deleteFilms($ids);
			$numFilms = count($ids);
		}else{
			$numFilms = 0;
		}
	  $this->loadView("delete-view", ["numFilms"=>$numFilms,"pageTitle"=>"Delete film"]);
	}
	
	private function loadView($view,$data)
	{
		extract($data);
		require("views/".$view.".php");
	}
}
