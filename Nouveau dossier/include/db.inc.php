<?php

class connect_base
{
	var $connect_id;
	var $query_result;
	var $row=array();
	var $rowset=array();
	var $num_queries=0;
	//constructor
	function connect_base($Serveur,$userDB,$UserName,$UserPass, $persistency = true)
	{
		$this->persistency=$persistency;
		$this->user=$UserName;
		$this->base=$userDB; 
		$this->password=$UserPass;
		$this->host=$Serveur;
		if($this->persistency)
		{
			$this->connect_id =new PDO('mysql:host='.$this->host.';dbname='.$this->base,$this->user,$this->password,array( PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
		}
		else
		{
			$this->connect_id =new PDO('mysql:host='.$this->host.';dbname='.$this->base,$this->user,$this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));;
		}
		if ($this->connect_id)
		{
			return $this->connect_id;
		}
		else
		{
			return false;
		}
	}  //fin constructeur
	//Destucteur
	function sql_close()
	{
		if($this->connect_id)
		{
			$this->connect_id=null;
		}
	}
	//Fin destructeur
	//requete
	function sql_query($query = "", $transaction = FALSE)
	{
	// Remove any pre-existing queries 
		unset($this->query_result);
		if($query != "")
		{
			$this->sth=$this->connect_id->prepare($query);
			$this->query_result =$this->sth->execute();
		}
		return $this->sth->rowCount();

	}
	 //Ajout V2
	function ExecProc($TabVal, $Requete)
	{
		unset($this->query_result);
		if($Requete!='')
		{
			$this->sth=$this->connect_id->prepare($Requete);
			$this->query_result =$this->sth->execute($TabVal);
			/*echo "<p> Erreur : ";
			$a=$this->sth->errorInfo();
			print_r($a);
			echo "</p>";*/
			return $this->sth->rowCount();
		}
		else
		{
			return -1;
		}
	}
  //
	function sql_fetchrow($query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
		  //$this->row[$query_id] =mysql_fetch_assoc($query_id);
			$this->row[$query_id]=$this->sth->fetch(PDO::FETCH_ASSOC);
			return $this->row[$query_id];
		}
		else
		{
			return false;
		}
	}
	
	function sql_fetch_all($query)
	{
		$this->sth=$this->connect_id->prepare($query);
		$this->query_result =$this->sth->execute();
		$this->Tab_All=$this->sth->fetchAll();
		return $this->Tab_All;
	}
}