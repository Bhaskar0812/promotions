
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						
					<div class="wrapper fadeInDown">
					  <div id="formContent">
					    <!-- Tabs Titles -->

					    <!-- Icon -->
					    <div class="fadeIn first">
					      <img src="<?php echo base_url().DEFAULT_IMAGE_LOGIN;?>" id="icon" alt="User Icon" />
					    </div>

					    <!-- Login Form -->
					    <form id="loginForm" action="users/login">
					    	<div class="input-group">	
					      		<input type="text" id="email" class="fadeIn second" name="email" placeholder="Email">
					      	</div>
					      	<div class="input-group">
					      		<input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
					      	</div>
					      	<div class="input-group">
					      		<input type="submit" id="login_submit" class="fadeIn fourth" value="Log In" style="width:168%;">
					      	</div>

					      	<a href="<?php echo base_url().'users/registrations/create'?>">Signup</a>
					    </form>

					    <!-- Remind Passowrd -->
					  </div>
					</div>
					</div>
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>

<script>
	var login_form_submit = $("#login_submit");
	var login_form = $("#loginForm");
	login_form.validate({
		  rules: {
		  	email:{
		  		required: true,
                email:true,	
		  	},
		  	password:{
		  		required:true,
		  	}
		  },
		errorElement: 'span',
        	errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
	});

		login_form.submit(function(e){
			e.preventDefault();
		if(login_form.valid()==false) {
     	 	toastr.error('Please fill all fields properly before proceeding.');
        	return false;
 		}

		var url = $("#loginForm").attr('action');
		var _that = $(this).closest('form');
		var formData = new FormData(_that[0]);
		$.ajax({
			type:'POST',
			url:url,
			data:formData,
			processData:false,
			contentType: false,
			dataType:'json',
			success:function(res){
				if(res.status == 1){
					toastr.success(res.message);
					setTimeout(function(){ location.reload(); }, 100);
				}else{
					toastr.error(res.message);
				}
			}
		})
	});
</script>