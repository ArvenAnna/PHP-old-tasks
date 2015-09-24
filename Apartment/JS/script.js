$(document).ready(function() { 
	$("#rentForm").submit(function(){
		var form = $(this);

		var data = form.serialize();
		$.ajax({
			type: "POST", 
			url: "Controller/init.php",
			data: data,
			beforeSend: function(data) { 
						form.find('input[type="submit"]').attr('disabled', 'disabled');
						},
			success: function(data) {
		       			log=$.parseJSON(data);
						
						if (log['err_email']) {
							var msg="Please, insert the correct email";
							$('#msg').attr('style','color:red');
						}
						if (log['err_name']) {
							var msg="Please, don't use the numbers and don't leave the empty name";
							$('#msg').attr('style','color:red');
						}
						if (log['success']) {
							var msg="Data successful inserted, please, wait for the answer";
							$('#msg').attr('style','color:green');
						}
						$('#msg').text(msg);
						$('option[value='+log["apartment"]+']').remove();
						$('.field').val("");
						$('textarea').val("");
					},
			error: function (xhr, ajaxOptions, thrownError) {
		            alert(xhr.status); 
		            alert(thrownError); 
					},
			complete: function(data) {
		            form.find('input[type="submit"]').prop('disabled', false);
					}  		

		});
		return false;
	});
	
	$('.link').on('click', function(event){
		var target = $(event.target);
		var href=target.attr('href');
		href = href +"?user=" + target.text();
        target.attr('href',href);
    });
});
