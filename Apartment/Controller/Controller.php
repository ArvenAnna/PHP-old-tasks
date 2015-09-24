<?php 
/**
* Controller for the application 
*/
Class Controller
{
	public $model;
	
	/**
	* constructor, which create object of model;
	*/
	public function __construct()
	{
		$this->model = new QueryModel();
	}
	
	/**
	* function for getting apartment numbers from model and show order form;
	*/
	public function actionIndex()
	{
		$result = $this->model->extract_apartment_list();
		require $_SERVER['DOCUMENT_ROOT'] . '/View/index_view.php';	
	}
	
	/**
	* function for inserting correct data to db from the order form with AJAX
	* (it works with AJAX form data and returns JSON array of logs and chosen apartment number);
	*/
	public function actionCreateOrder($request)
	{
		$err_logs = $this->model->validate($request['name'], $request['email']);
		
		$response = array();
		
		if (empty($err_logs)) {
				
			$this->model->set_form_data($request['name'], $request['email'], $request['apartment'], $request['comment']);
			$this->model->insert_user_into_db();
			$arr=$this->model->find_user();
			$this->model->insert_order_into_db($arr[0][0]);
			$this->model->change_apartment_availability();
			
			$response['apartment']=$this->model->apartment;
			$response['success']=true;
		}
		if ($err_logs['err_name']) {
			$response['err_name']=true;			
		}
		
		if ($err_logs['err_email']) {
			$response['err_email']=true;
		}
		echo json_encode($response);
	}

	/**
	* function for getting from db and showing list of orders;
	*/
	public function actionListOrders()
	{
		$result=$this->model->get_orders_information();
		require $_SERVER['DOCUMENT_ROOT'] . '/View/Order_list_view.php';	
	}
	
	/**
	* function for getting from db and showing information about chosen user orders;
	*/
	public function actionListUser($user)
	{
		$result=$this->model->get_user_information($user);
		require $_SERVER['DOCUMENT_ROOT'] . '/View/User_orders_view.php';
	}
};