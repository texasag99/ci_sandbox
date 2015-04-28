
//$.fn.editable.defaults.mode = 'inline';

$(document).ready(function(){	
	$('#header').fadeTo(4000,0.25); //FADES THE HEADER
   $('input').addClass('form-control'); //ADD CLASS TO FORM INPUTS
	$('select').addClass('form-control'); //ADD CLASS TO FORM DROPDOWNS
   $('.multi-select').multiselect({
					buttonWidth: '500px',
					buttonClass: 'btn btn-default',
					 buttonText: function(options, select) {
								if (options.length === 0) {
									return 'None selected...';
								}
									else if (options.length > 3) {
									return 'More than 3 selected';
								}
									else {
									var labels = [];
									options.each(function() {
								if ($(this).attr('label') !== undefined) {
									labels.push($(this).attr('label'));
								}
									else {
									labels.push($(this).html());
										}
									});
									return labels.join(', ') + '';
									}
								}
				});//makes dropdown multiple select lists work properly


	$('#paginate').change(function() { 
        var selectedVal = $(this).val();
        window.location.href = selectedVal;
        
    });
	
	$('#delete_message').click(function(){//Used to display the delete confirmation message on the website.
		if (!confirm("Do you want to delete?")){
			return false;
		}
	});
});






//*********************AJAX CONTROLLER BELOW ********************************
$.fn.existsChecker = function(){//USED TO CHECK IF THE VALUE (EMAIL) ALREADY EXISTS AND RETURN IT TO THE BROWSER IN REAL-TIME USING AJAX
	return this.each(function(){ //This return this.each is to set the checker for specific and separate tags, if you have more than one field to check.
		var interval; //This variable will be used to set the interval by which we make requests to the server for the data.
		
		$(this).on('keyup',function(){ //The request will be made on the keyup, after you start typing.
			var self= $(this), 
				selfType = self.data('type'),
				selfValue,
				feedback = $('.check-exists-feedback[data-type=' + selfType + ']');
			if(interval === undefined){
				interval = setInterval(function(){
					if(selfValue !== self.val()){
						selfValue = self.val();
						if(selfValue.length > 4){//we won't check unless the value in the field is at least 4 characters long
							    var sValue; //this variable is setup to replace the "@" symbol which cannot be passed in the URL.
							    sValue = selfValue.replace("@","-"); //here is where I replace the "@" with a "-"
								var url;
							    url = location.protocol + '//' + location.host + '/CodeIgniter/User/ajax_verify/' + selfType + '/' + sValue ; 
								$.ajax({
									url: url,
									type: 'GET',
									dataType: 'json',
									data: {type:selfType , value:selfValue},
									processData: true,
									success: function(data){
										if(data.exists !== undefined){
											if(data.exists === true){
												feedback.text('The user email already exists.');
												$('#control-group').addClass('control-group has-error');
											}else{
												feedback.text('');
												$('#control-group').removeClass('control-group has-error');
											}
										}
									},
									error: function(){
									   console.log('Something went wrong');	//something went wrong, logged in the browser console
									}
								});
						}
					}
				}, 2000); // the timer for how often we search the server 2000 = every 2 seconds, 3000 = every 3 seconds, etc...
			}
			
		});
	});
};




