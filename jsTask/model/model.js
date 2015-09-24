function User() 
{ 
  this.name=null;
  this.email=null;
  this.telephone=null;
  this.address={street:null,city:null,state:null,zip:null};
  
  this.set = function(name,email,telephone,street,city,state,zip) 
  {
	this.name=name;
	this.email=email;
	this.telephone=telephone;
	this.address={street:street,city:city,state:state,zip:zip};
  };	
};

function List() 
{
  this.jsons = new Array();

  this.setInitial = function() 
  {
	var user1 = new User();
	var user2 = new User();
	user1.set("Vasiliy","Vasiliy@gmail.ru",380976572735,"Gelovan","Sevastopol","Ukraine",13456);
	user2.set("Valeriy","Valeriy@gmail.ru",380967852733,"Irpinska","Kiev","Ukraine",44876);
	this.jsons[0]=JSON.stringify(user1);
	this.jsons[1]=JSON.stringify(user2);	  
  };
  
  this.getList = function()
  {
	var list = new Array();
	this.jsons.forEach(function(item, i){
		list[i] = JSON.parse(item);
	});
	return list; 
  };
  
  this.addUser = function(user)
  {
	this.jsons.push(JSON.stringify(user));
  };
  
  this.deleteUser = function(name)
  {
	var list = new Array();
	self = this;
	this.jsons.forEach(function(item, i){
		list[i] = JSON.parse(item);
		if(list[i].name == name)
		{
			self.jsons.splice(i,1);
		}
	}); 
  };
  
  this.updateUser = function(name,newUser)
  {
	var list = new Array();
	self = this;
	this.jsons.forEach(function(item, i){
		list[i] = JSON.parse(item);
		if(list[i].name == name)
		{
			self.jsons.splice(i,1,JSON.stringify(newUser));
		}
	}); 	  
  };
  
  this.findUser = function(name)
  {
	var list = new Array();
	var user = new Array();
	self = this;
	this.jsons.forEach(function(item, i){
		list[i] = JSON.parse(item);
		if(list[i].name == name)
		{
			user[0]=list[i].name;
			user[1]=list[i].email;
			user[2]=list[i].telephone;
			user[3]=list[i].address.street;
			user[4]=list[i].address.city;
			user[5]=list[i].address.state;
			user[6]=list[i].address.zip;
		}
	});
	return user;
  };
};

