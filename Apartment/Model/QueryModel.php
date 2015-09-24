<?php
/**
* Model for forming different SQL-queries 
*/
class QueryModel extends Model
{	
	/**
	* constructor, which define name of db;
	*/
	public function extract_apartment_list()
	{
		$query='SELECT ap_number FROM apartment where availability="yes";';
		return $this->extract_to_array($query);		
	}
	
	/**
	* forming query to find user's id with his name and email 
	* data must be previously set by method set_form_data() of the parent class;
	* output is the user's id(element of 2-d array with index [0][0]);
	*/
	public function find_user()
	{
		$query="SELECT id_user FROM users 
		WHERE name='" . $this->name . "' and email='" . $this->email . "';";
		return $this->extract_to_array($query);	
	}
	
	/**
	* forming query to insert user data into db if not exist 
	* (users with same names but different emails may exist and reverse,
	* only a pair 'name-email' is unique);
	* data must be previously set by method set_form_data() of the parent class;
	*/
	public function insert_user_into_db()
	{
		$result=$this->find_user();
		if (!$result) {
			$query="insert into users values (null,'" . $this->name . "','" . $this->email . "');";
			$this->db_query($query);
		}
	}

	/**
	* forming query to insert order information into db;
	* data must be previously set by method set_form_data() of the parent class;
	* input is the user id which was found by method find_user();
	*/
	public function insert_order_into_db($id_user)
	{
		$query="insert into orders values 
		(null,'" . $id_user . "','" . $this->apartment . "','" . date('Y-m-d H:i:s') . "','" . $this->comment . "');";
		$this->db_query($query);
	}

	/**
	* forming query to do apartment not available if it was ordered;
	* data must be previously set by method set_form_data() of the parent class;
	*/
	
	public function change_apartment_availability()
	{
		$query='UPDATE apartment SET availability="no" where ap_number= ' . $this->apartment . ';';
		$this->db_query($query);
	}
	
	/**
	* forming query to get order information from db in special way;
	* output is 2-d array of order with the columns of order id, pair user 'name,email', ordered apartment, date and user comment;
	*/
	public function get_orders_information()
	{
		$query="SELECT orders.id_order,CONCAT(users.name,',',users.email),orders.ordered_ap_number,orders.order_date,orders.Comment "
		      . "FROM orders,users WHERE orders.customer=users.id_user ORDER BY orders.id_order;";
		return $this->extract_to_array($query);
	}
	
	/**
	* forming query to get user information from db in special way;
	* input is the string pair of user 'name,email';
	* output is 2-d array of user's order with the columns of ordered apartment and date;
	*/
	public function get_user_information($user)
	{
		$query="SELECT ordered_ap_number,order_date FROM orders WHERE customer IN"
		      . " (SELECT id_user FROM users WHERE CONCAT(name,',',email) = '" . $user . "');";
		return $this->extract_to_array($query);
	}
};