<?php

class connect_base
{
	var $connect_id;
	var $query_result;
	var $row=array();
	var $rowset=array();
	var $num_queries=0;
	//constructor
	//Old PHP4 : function connect_base($Serveur,$userDB,$UserName,$UserPass, $persistency = true)
	//PHP 7  constructor
	
	function __construct($Serveur,$userDB,$UserName,$UserPass, $persistency = true)
	{
		$this->persistency=$persistency;
		$this->user=$UserName;
		$this->base=$userDB; 
		$this->password=$UserPass;
		$this->host=$Serveur;
		if($this->persistency)
		{
			try
			{
				$this->connect_id =new PDO('mysql:host='.$this->host.';dbname='.$this->base,$this->user,$this->password,array( PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
				$this->connect_id->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$this->connect_id->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e)
			{
				$this->connect_id = null;
			}
		}
		else
		{
			try
			{
			$this->connect_id =new PDO('mysql:host='.$this->host.';dbname='.$this->base,$this->user,$this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
			$this->connect_id->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$this->connect_id->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e)
			{
				$this->connect_id = null;
			}
		}
		if ($this->connect_id)
		{
			return $this->connect_id;
			
		}
		else
		{
			return null;
		}
	}  //fin constructeur
//************************************************	
	//Destucteur
	function sql_close()
	{
		if($this->connect_id)
		{
			$this->connect_id=null;
		}
	}
	//Fin destructeur
	
//*****************************************************	
	//requete
	function sql_query($query = "", $transaction = FALSE)
	{
		if(!(is_null($this->connect_id)))
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

	}
	
//*************************************************************	
	 //Ajout V2
	function ExecProc($TabVal, $Requete)
	{
		if(!(is_null($this->connect_id)))
		{
			unset($this->query_result);
			if($Requete!='')
			{
				try
				{
					$this->sth=$this->connect_id->prepare($Requete);
					$this->query_result =$this->sth->execute($TabVal);
					//Retourne le nombre d'enregistrements si requete select
					return $this->sth->rowCount();
				}
				catch(PDOException $e)
				{
					/*echo "<p> Erreur : ";
					$a=$this->sth->errorInfo();
					print_r($a);
					echo "</p>";*/
					return -1;
				}
			}
			else
			{
				return -1;
			}
		}
	}

//*************************************************************************************	
	function sql_fetch_prepared($TabVal,$Requete)
	{
		try
		{
			if(!(is_null($this->connect_id)))
			{
				$this->sth=$this->connect_id->prepare($Requete);
				$this->query_result =$this->sth->execute($TabVal);
			}
			else
				return -1;
		}
		catch(PDOException $e)
		{
			return -1;
		}
	}
	function sql_Insert_With_ID($TabVal,$query)
	{
		/*Nécessite une requete de type insert, update ou delete suivant
			INSERT INTO table (champs, champs, ...) VALUES(:a,:b,...)
			de meme pour delete ou update
			ne fonctionne pas avec une procédure stockée
		*/
		/*Voir pour pousser les recherche avec une Proc stock */
		if(!(is_null($this->connect_id)))
		{
		// Remove any pre-existing queries 
			unset($this->query_result);
			if($query != "")
			{
				try
				{
					$this->sth=$this->connect_id->prepare($query);
					foreach($TabVal as $key=>$value)
					{
						$this->sth->bindParam($key,$value);
					}	
					if($this->sth->execute())
					{
						//OK
						return $this->connect_id->lastInsertId();
					}
					else
					{
						return false;
					}
				}
				catch(PDOException $e)
				{
					return -1;
				}
			}
			return false;
		}

	}
  //
	function sql_fetchrow($query_id = 0)
	{
		if(!(is_null($this->connect_id)))
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
	}
	
	function sql_fetch_all($query)
	{
		if(!(is_null($this->connect_id)))
		{
			$this->sth=$this->connect_id->prepare($query);
			$this->query_result =$this->sth->execute();
			$this->Tab_All=$this->sth->fetchAll();
			return $this->Tab_All;
		}
	}
	function sql_Last_Erreur()
	{
		$a=$this->sth->errorInfo();
		return $a;
	}
}
?>