<?php
namespace models;
use database\DbConnect;

class FilmModel
{
	private $conn;
	function __construct()
	{
		$this->conn = DbConnect::getConnection();
	}
	public function getAllFilms()
	{
		$query = "SELECT * FROM films";
		$resultset = $this->conn->query($query);
		$films = $resultset->fetchAll();
		return $films;
	}
	public function getFilmById($filmId)
	{
		$stmt = $this->conn->prepare("SELECT * FROM films WHERE films.id = :id");
		$stmt->bindValue(':id',$filmId);
		$stmt->execute();
		$film = $stmt->fetch();
		return $film;
	}
	public function saveFilm($title, $year, $duration, $certId){
	  $query = "INSERT INTO films (id, title, year, duration, certificate_id) VALUES (NULL, :title, :year, :duration, :certId)";
	  $stmt = $this->conn->prepare($query);
	  $stmt->bindValue(':title', $title);
	  $stmt->bindValue(':year', $year);
	  $stmt->bindValue(':duration', $duration);
	  $stmt->bindValue(':certId', $certId);
	  $stmt->execute();
  }

	function deleteFilms($filmIds){
		$stmt = $this->conn->prepare("DELETE FROM films WHERE films.id = :id");
		foreach($filmIds as $id){
			$stmt->bindValue(':id',$id);
			$stmt->execute();
		}
	}
}

?>
