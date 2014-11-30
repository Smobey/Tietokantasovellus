<?php

require_once 'dbconnect.php';

class Tag
{
    private $tagid;
    private $tagname;
    private $tagdescription;

	public function setTagId($id) 
	{
		$this->tagid = $id;
	}
	
	public function setTagName($title) 
	{
		$this->tagname = $title;
	}
	
	public function setTagDescription($desc) 
	{
		$this->tagdescription = $desc;
	}
	
	public function getTagId() 
	{
		return $this->tagid;
	}
	
	public function getTagName() 
	{
		return $this->tagname;
	}
	
	public function getTagDescription() 
	{
		return $this->tagdescription;
	}
    
	public static function findById($threadid) 
	{
		$sql = "SELECT TagID, Tagname, Tagdescription FROM Tag WHERE TagID = ? LIMIT 1";
		$query = getConnection()->prepare($sql);
		$query->execute(array($threadid));

		$result = $query->fetchObject();
		
		if ($result == null) 
		{
			return null;
		} 
		else 
		{
			$tag = new Tag(); 
			$tag->setTagId($result->TagID);
			$tag->setTagName($result->Tagname);
			$tag->setTagDescription($result->Tagdescription);
			
			return $tag;
		}
	}
}