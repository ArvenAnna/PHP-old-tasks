function updateCustomer()
{
	var newUser = new User();
	newUser.set(view.getUpdateData()[0],view.getUpdateData()[1],view.getUpdateData()[2],view.getUpdateData()[3],view.getUpdateData()[4],view.getUpdateData()[5],view.getUpdateData()[6]);
	list.updateUser(clickedUserName,newUser);
};