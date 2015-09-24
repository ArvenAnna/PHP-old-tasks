<?php 
/**
* Base class of model for further extending
*/
class Model
{
	public $name;
	public $email;
	public $apartment;
	public $comment;
	
	protected $db;
	
	/**
	* constructor, which define name of db;
	*/
	public function __construct()
	{
		$this->db='Rent';		
	}
	
	/**
	* function for setting data inserting to the form by user;
	* input arguments are name, email, wanted apartment and user comment from order form
	*/
	public function set_form_data($name=null, $email=null, $apart=null, $comment=null)
	{
		$this->name=$name;
		$this->email=$email;
		$this->apartment=$apart;
		$this->comment=$comment;		
	}
	
	/**
	* function for validate data (name and email) inserting to the form by user;
	* input arguments are name and email,
	* output is the array of validation logs
	*/
	public function validate($name, $email)
	{
		$err_logs=array();
		$name_pattern="/^\D+$/i";
		$email_pattern="/^.+@.+\..+$/i";
		if(!preg_match($name_pattern, $name)) {
			$err_logs['err_name']=true;	
		}
		if (!preg_match($email_pattern, $email)) {
			$err_logs['err_email']=true;	
		}
		return $err_logs;
	}
	
	/**
	* function for doing something with db; 
	* input argument is SQL-query, 
	* output is the SQL-response;
	*/
	protected function db_query($query)
	{
		$db = mysql_connect('localhost', 'root', '');
		mysql_select_db($this->db, $db);
		$result=mysql_query($query);
		mysql_close($db);
		return $result;
	}
	
	/**
	* function for converting SQL-response to array;
	* input argument is SQL-response;
	* output is an 2-dimensional array;
	*/
	protected function db_result_to_array($result) 
	{
		$results = array();
		while($row = mysql_fetch_array($result)) 
		{
			$results[] = $row;
		}
		return $results;
    }

	/**
	* function for doing something with db and get response as array;
	* input argument is SQL-query;
	* output is an 2-dimensional array;
	*/
	protected function extract_to_array($query)
	{
		return $this->db_result_to_array($this->db_query($query));
	}	
};