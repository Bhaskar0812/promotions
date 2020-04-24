
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						
					<div class="wrapper fadeInDown">
					  <div id="formContent">
					    <div class="fadeIn first">
					      <img src="<?php echo base_url().DEFAULT_IMAGE_LOGIN;?>" id="icon" alt="User Icon" />
					    </div>
					    <form id="registrationForm" action="store">
					    		<div class="input-group">	
					      		<input type="text" id="email" class="fadeIn second" name="email" placeholder="Email">
					      	</div>

					      	<div class="input-group">	
					      		<input type="text" id="name" class="fadeIn second" name="name" placeholder="Name">
					      	</div>
					      	<div class="input-group">
					      		<input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
					      	</div>
					      	<div class="input-group">
					      		<input type="submit" id="registration_submit" class="fadeIn fourth" value="Register" style="width:150%;">
					      	</div>	
					      	
					      		<a href="<?php echo base_url();?>">Login</a>
					      	
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
	var registration_form_submit = $("#registration_submit");
	var registration_form = $("#registrationForm");
	registration_form.validate({
		  rules: {
		  	email:{
		  		required: true,
                email:true,	
		  	},
		  	name:{
		  		required: true,
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

	registration_form.submit(function(e){
			e.preventDefault();
		if(registration_form.valid()==false) {
     	toastr.error('Please fill all fields properly before proceeding.');
      return false;
 		}
		var url = $("#registrationForm").attr('action');
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
					setTimeout(function(){ window.location = "<?php echo base_url();?>"; }, 200);
				}else{
					toastr.error(res.message);
				}
			}
		})
	});
</script>