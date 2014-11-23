<?php

require_once 'dbconnect.php';

class User 
{
	private $id;
	private $username;
	private $password;
	private $priv_email;
	private $pub_email;
	private $userinfo;
	private $usergroup;
	private $joindate;

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
	
	public function setPrivEmail($priv_email) 
	{
		$this->priv_email = $priv_email;
	}
	
	public function setPubEmail($pub_email) 
	{
		$this->pub_email = $pub_email;
	}
	
	public function setUserinfo($userinfo) 
	{
		$this->userinfo = $userinfo;
	}
	
	public function setUsergroup($usergroup) 
	{
		$this->usergroup = $usergroup;
	}
	
	public function setJoindate($joindate) 
	{
		$this->joindate = $joindate;
	}
	
	public function getId() 
	{
		return $this->id;
	}
	
	public function getUsername() 
	{
		return $this->username;
	}
	
	public function getPassword() 
	{
		return $this->password;
	}
	
	public function getPrivEmail() 
	{
		return $this->priv_email;
	}
	
	public function getPubEmail() 
	{
		return $this->pub_email;
	}
	
	public function getUserinfo() 
	{
		return $this->userinfo;
	}
	
	public function getUsergroup() 
	{
		return $this->usergroup;
	}
	
	public function getUsergroupName() 
	{
		if ($this->usergroup == 0)
			return 'User';
		elseif ($this->usergroup == 1)
			return 'Moderator';
		elseif ($this->usergroup == 2)
			return 'Administrator';
		else
			return 'Mystery';
	}
	
	public function getJoindate() 
	{
		return $this->joindate;
	}	
	
	public static function checkExisting($username) 
	{
		$sql = "SELECT Username FROM Users WHERE Username = ? LIMIT 1";
		$query = getConnection()->prepare($sql);
		$query->execute(array($username));

		$result = $query->fetchObject();
		
		if ($result == null) 
		{
			return false;
		} 
		else 
		{
			return true;
		}
	}
	
	public function toDatabase() 
	{
		$date = date('Y-m-d H:i:s');
		$sql = "INSERT INTO Users(Username, Password, PrivEmail, Joindate, Usergroup) VALUES(?,?,?,?,0)";
		$connection = getConnection();
		$query = $connection->prepare($sql);
		$query->execute(array($this->getUsername(), $this->getPassword(), $this->getPrivEmail(), $date));
		$ok = $connection->lastInsertId();
		
		return $ok;
	}
	
	public function updateInfo() 
	{
		$sql = "UPDATE Users SET PrivEmail = ?, PubEmail = ?, Userinfo = ?, Usergroup = ? WHERE UserID = ". $this->getId();
		$connection = getConnection();
		$query = $connection->prepare($sql);
		$query->execute(array($this->getPrivEmail(), $this->getPubEmail(), $this->getUserinfo(), $this->getUsergroup()));
		$ok = $connection->lastInsertId();
		
		return $ok;
	}
	  
	public static function findUser($username, $password) 
	{
		$sql = "SELECT UserID, Username, Password, PrivEmail, PubEmail, Userinfo, Usergroup, Joindate FROM Users WHERE Username = ? AND Password = ? LIMIT 1";
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
			$user->setPrivEmail($result->PrivEmail);
			$user->setPubEmail($result->PubEmail);
			$user->setUserinfo($result->Userinfo);
			$user->setUsergroup($result->Usergroup);
			$user->setJoindate($result->Joindate);

			return $user;
		}
	}
	
	public static function findById($userid) 
	{
		$sql = "SELECT UserID, Username, Password, PrivEmail, PubEmail, Userinfo, Usergroup, Joindate FROM Users WHERE UserID = ? LIMIT 1";
		$query = getConnection()->prepare($sql);
		$query->execute(array($userid));

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
			$user->setPrivEmail($result->PrivEmail);
			$user->setPubEmail($result->PubEmail);
			$user->setUserinfo($result->Userinfo);
			$user->setUsergroup($result->Usergroup);
			$user->setJoindate($result->Joindate);
			
			return $user;
		}
	}
	
	public static function getNUsers($amount, $page) 
	{
		$offset = ($page - 1) * $amount;
		
		$sql = "SELECT UserID, Username, Joindate FROM Users ORDER BY UserID LIMIT ? OFFSET ?";
		$query = getConnection()->prepare($sql);
		$query->bindParam(1, $amount, PDO::PARAM_INT);
		$query->bindParam(2, $offset, PDO::PARAM_INT);
		$query->execute();

		$result = $query->fetchAll();
		
		if ($result == null) 
		{
			return null;
		} 
		else 
		{
			return $result;
		}
	}
	
	public static function countUsers() 
	{
		$sql = "SELECT count(*) FROM Users";
		$query = getConnection()->prepare($sql);
		$query->execute();

		return $query->fetchColumn();
	}
}