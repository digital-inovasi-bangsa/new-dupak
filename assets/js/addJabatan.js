/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addUserForm = $("#addJabatan");
	
	var validator = addUserForm.validate({
		
		rules:{
			fjabatan :{ required : true },
			pangkat : { required : true, selected : true}
		},
		messages:{
			fname :{ required : "This field is required" },
			role : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
});
