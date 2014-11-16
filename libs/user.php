<?php

require_once 'dbconnect.php';

class User 
{
	private $id;
	private $username;
	private $password;

	public function setId($id) 
	{
		$this->id = $id;
	}
	
	public function setUsername($username) 
	{
		$this->username = $username;
	}
	
	public function setPassword($password) 
	{
		$this->password = $password;
	}
	
	public function getId() 
	{
		return $this->id;
	}
	
	public function getUsername() 
	{
		return $this->username;
	}
	  
	public static function findUser($username, $password) 
	{
		$sql = "SELECT UserID, Username, Password FROM Users where Username = ? AND Password = ? LIMIT 1";
		$query = getConnection()->prepare($sql);
		$query->execute(array($username, $password));

		$result = $query->fetchObject();
		
		if ($result == null) 
		{
			return null;
		} 
		else 
		{
			$user = new User(); 
			$user->setId($result->UserID);
			$user->setUsername($result->Username);
			$user->setPassword($result->Password);

			return $user;
		}
	}
}