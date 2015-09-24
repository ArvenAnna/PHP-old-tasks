function View() 
{
  this.html="";

  this.showTable = function(data) 
  {
	this.html = "<thead>";
	this.html += "<tr>";
	
	for (var property in data[0])
	{		
		if(typeof (data[0][property]) == "object")
		{		
			var i=0;
			for (var prop in data[0][property])
			{
				i++;
			}
			this.html += "<th colspan="+i+">"+property+"</th>";
			break;
		}
		this.html += "<th rowspan=2>"+property+"</th>";
	}
	
	this.html += "</tr>";
	this.html += "<tr>";
	
	for (var property in data[0])
	{	
		if(typeof (data[0][property]) == "object")
		{
			var i=0;
			for (var prop in data[0][property])
			{
				i++;
				this.html += "<th>"+prop+"</th>";
			}	
			break;
		}	
	}
	
	this.html += "</tr>";
	this.html += "</thead>";
	this.html += "<tbody>";
		
	self=this;
		
	data.forEach(function(item, i) 
	{	
		self.html += "<tr id='"+i+"' class='tr'>";
		for (var property in item)
		{
			if(typeof (item[property]) == "object")
			{
				for (var prop in item[property])
				{
					self.html += "<td>"+item[property][prop]+"</td>";
				}
				break;
			}
			self.html += "<td>"+item[property]+"</td>";
		}
		self.html += "</tr>";
	});
		
	this.html += "</tbody>";
	
	if(this.html=="<thead><tr></tr><tr></tr></thead><tbody></tbody>")
	{
		this.html="<p>List has no customers</p>";
	}
	
	$('.table').html(this.html);	
  };
  
  this.showUpdateForm = function()
  {
	var prevTr = new Array();
	var size = $('.clickedTr').size();	
	for(var i=0;i<size;i++)
	{
		prevTr[i] = $('.clickedTr:eq('+i+')').text();
		this.html = "<input type='text' class='form-control cell' value='"+prevTr[i]+"'/>";
		$('.clickedTr:eq('+i+')').html(this.html);
	}
	
	$('.cell').on("focus", function(event)
			{		
				var target = $(event.target);
				target.css("width","auto");
			});
			
	$('.cell').on("blur", function(event)
			{		
				var target = $(event.target);
				target.css("width","");
			});
  };
  
  this.removeUpdateForm = function()
  {
	var prevInput = new Array();
	var size = $('.clickedTr').size();	
	for(var i=0;i<size;i++)
	{
		prevInput[i] = $('.clickedTr:eq('+i+')>input').val();
		$('.clickedTr:eq('+i+')').html(prevInput[i]);
	}
  };
  
  this.getUpdateData = function()
  {
	var input = new Array();
	var size = $('.clickedTr').size();	
	for(var i=0;i<size;i++)
	{
		input[i] = $('.clickedTr:eq('+i+')>input').val();
	}
	return input;
  };
  
 this.toInitialView = function()
  {
		$('#update').addClass("hide");
		$('#delete').addClass("hide");
		this.removeUpdateForm();
		$('td').removeClass("clickedTr");
  };
  
  this.validateData = function(name,email,telephone,zip)
  {
	var emailPattern = /^[A-Za-z]+\w*@\w[\w*.]+\w+$/i
	var telPattern = /^\d{12}$/i;
	var zipPattern = /^\d{5}$/i;
	var nameSelector = $("td:first-child").not(".clickedTr");
	var size = nameSelector.size();

	for(var i=0;i<size;i++)
	{
		if($("td:first-child").not(".clickedTr").filter(':eq('+i+')').text()==name)
		{
			alert("Such name is exist");
			return false;			
		}
	}

	if (!name) 
	{
		alert("Please insert the name");
		return false;
	}
	if (!emailPattern.test(email)) 
	{
		alert("Please insert the correct email");
		return false;
	}
	if (!telPattern.test(telephone)) 
	{
		alert("Please insert the correct telephone. It has 12 numbers.");
		return false;
	}
	if (!zipPattern.test(zip)) 
	{
		alert("Please insert the correct zip. It has 5 numbers.");
		return false;
	}
	return true; 
  };
  
  this.getCustomerName = function()
  {
	return $('.clickedTr:first>input').val();
  };
  
  this.validateDataForUpdate = function()
  {
	return this.validateData($('.clickedTr:eq(0)>input').val(),$('.clickedTr:eq(1)>input').val(),$('.clickedTr:eq(2)>input').val(),$('.clickedTr:eq(6)>input').val());
  };
  
  this.toUpdatableView = function(target)
  {
	var parTarget = target.parent();
	var childTarget = parTarget.children();
	childTarget.addClass('clickedTr');
	this.showUpdateForm();			
	$('#update').removeClass("hide");
	$('#delete').removeClass("hide");	
  };
  
  this.returnCustomerBack = function(customer)
  {
	for(var i=0;i<$('.cell').size();i++)
	{
		$('.cell:eq('+i+')').val(customer[i]);
	}
  };
  
  this.clearCreateForm = function()
  {
	$('#name').val('');
	$('#email').val('');
	$('#telephone').val('');
	$('#street').val('');
	$('#city').val('');
	$('#state').val('');
	$('#zip').val('');
  }
};

