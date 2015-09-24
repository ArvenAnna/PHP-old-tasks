function createCustomer(name,email,telephone,street,city,state,zip)
{
	var user = new User();
	user.set(name,email,telephone,street,city,state,zip);
	list.addUser(user);
};
