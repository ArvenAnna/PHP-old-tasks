function GetContent()
{
	$(document).on("ready", function(){
		list = new List();
		list.setInitial();
		view = new View();
		listCustomers();
		clickedUserName ="";
	});

	$('#delete').click(function()
	{
		deleteCustomer();
		view.toInitialView();
		listCustomers();	
		return false;
	});

	$('#update').click(function()
	{
		if(view.validateDataForUpdate())
		{
			updateCustomer();
			view.toInitialView();
			listCustomers();
		}
		else
		{	
			view.returnCustomerBack(list.findUser(clickedUserName));
		}
		return false;
	});

	$('table').on("click", function(event)
	{
		var target = $(event.target);
		if (target.is("td")) 
		{
			view.returnCustomerBack(list.findUser(clickedUserName));
			view.toInitialView();
			view.toUpdatableView(target);	
			clickedUserName = view.getCustomerName();
		}	
	});
	
	$('#create').on("click", function()
	{		
		view.returnCustomerBack(list.findUser(clickedUserName));
		view.toInitialView();
		
		if(view.validateData($('#name').val(),$('#email').val(),$('#telephone').val(),$('#zip').val()))
		{
			createCustomer($('#name').val(),$('#email').val(),$('#telephone').val(),$('#street').val(),$('#city').val(),$('#state').val(),$('#zip').val());
			listCustomers();
			view.clearCreateForm();
		}
		return false;
	});

	$('#createForm input').on("focus", function()
	{		
		view.returnCustomerBack(list.findUser(clickedUserName));
		view.toInitialView();
	});
};

