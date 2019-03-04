$(document).ready(function () {

	setCookie("jwt", "", 1);

	// function to set cookie
	function setCookie(cname, cvalue, exdays) {
	    var d = new Date();
	    d.setTime(d.getTime() + (exdays*24*60*60*1000));
	    var expires = "expires="+ d.toUTCString();
	    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	// function to make form values to json format
	$.fn.serializeObject = function(){
	 
	    var o = {};
	    var a = this.serializeArray();
	    $.each(a, function() {
	        if (o[this.name] !== undefined) {
	            if (!o[this.name].push) {
	                o[this.name] = [o[this.name]];
	            }
	            o[this.name].push(this.value || '');
	        } else {
	            o[this.name] = this.value || '';
	        }
	    });
	    return o;
	};

	// trigger when login form is submitted
	$(document).on('submit', '#login_form', function(){
	 
	    // get form data
	    var login_form=$(this);
	    var form_data=JSON.stringify(login_form.serializeObject());

	    console.log('here');
	 
	    // submit form data to api
		$.ajax({
		    url: "../../api/user/sign_in.php",
		    type : "POST",
		    contentType : 'application/json',
		    data : form_data,
		    success : function(result){
		 
		        // store jwt to cookie
		        setCookie("jwt", result.jwt, 1);
		 
		        // show home page & tell the user it was a successful login
		        window.location.href = "http://stackoverflow.com";
		        $('#response').html("<div class='alert alert-success'>Successful login.</div>");
		 
		    },
		    error: function(xhr, resp, text){
			    // on error, tell the user login has failed & empty the input boxes
			    $('#response').html("<div class='alert alert-danger'>Login failed. Email or password is incorrect.</div>");
			    login_form.find('input').val('');
			}
		});
	 
	    return false;
	});

	// trigger to show home page will be here

});