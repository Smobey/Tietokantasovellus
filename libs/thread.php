<?php

require_once 'dbconnect.php';

class Thread
{
    private $threadid;
    private $threadtitle;
    private $tag1;
    private $tag2;
    private $tag3;
    private $tag4;
    private $creator;
    private $msgcount;
    private $lastpost;

	public function setThreadId($id) 
	{
		$this->threadid = $id;
	}
	
	public function setThreadTitle($title) 
	{
		$this->threadtitle = $title;
	}
	
	public function setTag1($tag) 
	{
		$this->tag1 = $tag;
	}
    
    public function setTag2($tag) 
	{
		$this->tag2 = $tag;
	}
    
    public function setTag3($tag) 
	{
		$this->tag3 = $tag;
	}
    
    public function setTag4($tag) 
	{
		$this->tag4 = $tag;
	}
	
	public function setCreator($creator) 
	{
		$this->creator = $creator;
	}
	
	public function setMessageCount($msgcount) 
	{
		$this->msgcount = $msgcount;
	}
	
	public function setLastPostTime($lastpost) 
	{
		$this->lastpost = $lastpost;
	}
	
	public function getThreadid() 
	{
		return $this->threadid;
	}
	
	public function getThreadTitle() 
	{
		return $this->threadtitle;
	}
	
	public function getTag1() 
	{
		return $this->tag1;
	}
    
    public function getTag2() 
	{
		return $this->tag2;
	}
    
    public function getTag3() 
	{
		return $this->tag3;
	}
    
    public function getTag4() 
	{
		return $this->tag4;
	}
	
	public function getCreator() 
	{
		return $this->creator;
	}
	
	public function getMessageCount() 
	{
		return $this->msgcount;
	}
	
	public function getLastPostTime() 
	{
		return $this->lastpost;
	}
    
	public function threadExists($id) 
	{
		$sql = "SELECT ThreadID FROM Thread WHERE ThreadID = ? LIMIT 1";
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
    
	public function newPost() 
	{
		$date = date('Y-m-d H:i:s');
        $sql = "UPDATE Thread SET MessageCount = ?, Lastpost = ? WHERE ThreadID = ". $this->getThreadId();
		$connection = getConnection();
		$query = $connection->prepare($sql);
		$query->execute(array($this->getMessageCount() + 1, $date));
		$ok = $connection->lastInsertId();
		
		return $ok;
	}
	
	public function toDatabase() 
	{
		$date = date('Y-m-d H:i:s');
		$sql = "INSERT INTO Thread(Title, Tag1, Tag2, Tag3, Tag4, Creator, MessageCount, Lastpost) VALUES(?,?,?,?,?,?,1,?)";
		$connection = getConnection();
		$query = $connection->prepare($sql);
		$query->execute(array($this->getThreadTitle(), $this->getTag1(), $this->getTag2(), $this->getTag3(), $this->getTag4(), $this->getCreator(), $date));
		$ok = $connection->lastInsertId();
		
		return $ok;
	}
    
	public function deleteThread($id) 
	{
        $sql = "DELETE FROM Thread WHERE ThreadID = ?";
		$connection = getConnection();
		$query = $connection->prepare($sql);
		$query->execute(array($id));

		return true;
	}
	  
	public static function findById($threadid) 
	{
		$sql = "SELECT ThreadID, Title, Tag1, Tag2, Tag3, Tag4, Creator, MessageCount, Lastpost FROM Thread WHERE ThreadID = ? LIMIT 1";
		$query = getConnection()->prepare($sql);
		$query->execute(array($threadid));

		$result = $query->fetchObject();
		
		if ($result == null) 
		{
			return null;
		} 
		else 
		{
			$thread = new Thread(); 
			$thread->setThreadId($result->ThreadID);
			$thread->setThreadTitle($result->Title);
			$thread->setTag1($result->Tag1);
			$thread->setTag2($result->Tag2);
			$thread->setTag3($result->Tag3);
			$thread->setTag4($result->Tag4);
			$thread->setCreator($result->Creator);
			$thread->setMessageCount($result->MessageCount);
            $thread->setLastPostTime($result->Lastpost);
			
			return $thread;
		}
	}
	
	public static function getNThreads($amount, $page) 
	{
		$offset = ($page - 1) * $amount;
		
		$sql = "SELECT ThreadID, Title, Tag1, Tag2, Tag3, Tag4, Creator, MessageCount, Lastpost FROM Thread ORDER BY Lastpost DESC LIMIT ? OFFSET ?";
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
	
	public static function countThreads() 
	{
		$sql = "SELECT count(*) FROM Thread";
		$query = getConnection()->prepare($sql);
		$query->execute();

		return $query->fetchColumn();
	}
}