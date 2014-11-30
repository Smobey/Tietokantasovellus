<?php

require_once 'dbconnect.php';

class Message
{
    private $messageid;
    private $message;
    private $thread;
    private $creator;
    private $deleted;
    private $postdate;

	public function setMessageId($id) 
	{
		$this->messageid = $id;
	}
	
	public function setMessage($message) 
	{
		$this->message = $message;
	}
	
	public function setThread($thread) 
	{
		$this->thread = $thread;
	}
    
    public function setCreator($creator) 
	{
		$this->creator = $creator;
	}
    
    public function setDeleted($deleted) 
	{
		$this->deleted = $deleted;
	}
    
    public function setPostdate($postdate) 
	{
		$this->postdate = $postdate;
	}
	
	public function getMessageId() 
	{
		return $this->messageid;
	}
	
	public function getMessage() 
	{
		return $this->message;
	}
	
	public function getThread() 
	{
		return $this->thread;
	}
    
    public function getCreator() 
	{
		return $this->creator;
	}
    
    public function getDeleted() 
	{
		return $this->deleted;
	}
    
    public function getPostdate() 
	{
		return $this->postdate;
	}
    
	public function messageExists($id) 
	{
		$sql = "SELECT MessageID FROM Message WHERE MessageID = ? LIMIT 1";
		$query = getConnection()->prepare($sql);
		$query->execute(array($id));

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
		$sql = "INSERT INTO Message(Message, Thread, Creator, Deleted, Postdate) VALUES(?,?,?,0,?)";
		$connection = getConnection();
		$query = $connection->prepare($sql);
		$query->execute(array($this->getMessage(), $this->getThread(), $this->getCreator(), $date));
		$ok = $connection->lastInsertId();
		
		return $ok;
	}
    
	public function deleteMessage($id) 
	{
        $sql = "UPDATE Message SET Deleted = 1 WHERE MessageID = ?";
		$connection = getConnection();
		$query = $connection->prepare($sql);
		$query->execute(array($id));

		return true;
	}
    
	public static function findById($messageid) 
	{
		$sql = "SELECT MessageID, Message, Thread, Creator, Deleted, Postdate FROM Message WHERE MessageID = ? LIMIT 1";
		$query = getConnection()->prepare($sql);
		$query->execute(array($messageid));

		$result = $query->fetchObject();
		
		if ($result == null) 
		{
			return null;
		} 
		else 
		{
			$message = new Message(); 
			$message->setMessageId($result->MessageID);
			$message->setMessage($result->Message);
			$message->setThread($result->Thread);
			$message->setCreator($result->Creator);
			$message->setDeleted($result->Deleted);
			$message->setPostdate($result->Postdate);
			
			return $message;
		}
	}
    
	public static function showMessages($amount, $page, $thread) 
	{
		$offset = ($page - 1) * $amount;
		
		$sql = "SELECT MessageID, Message, Thread, Creator, Deleted, Postdate FROM Message WHERE Thread = ? ORDER BY Postdate LIMIT ? OFFSET ?";
		$query = getConnection()->prepare($sql);
        $query->bindParam(1, $thread, PDO::PARAM_INT);
		$query->bindParam(2, $amount, PDO::PARAM_INT);
		$query->bindParam(3, $offset, PDO::PARAM_INT);
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
    
	public static function countMessages($thread) 
	{
		$sql = "SELECT count(*) FROM Message WHERE Thread = ?";
		$query = getConnection()->prepare($sql);
		$query->execute(array($thread));

		return $query->fetchColumn();
	}
}