
<div class="row">
	<div class="col-sm-3">
		<h4>Add Reference</h4>
	</div>
</div>
<div class="row">
	<div class="col-sm-3">	
		<form method="POST" id="user_form">
				<div class="">	
      		<input type="hidden"  name="created_by" value="<?php echo $_SESSION[USER_SESS_KEY]['user_id'];?>">
      	</div>

      	<div class="">	
      		<input type="text"  name="email" id="email" placeholder="Reference Email Id">
      	</div>
      	
      	<div class="input-group">
      		<input type="submit" id="user_submit" class="fadeIn fourth" value="Reffer User"  style="width:150%;">
      	</div>

		</form>
	</div>	
</div>

<script>
	var user_form_submit = $("#user_submit");
	var user_form = $("#user_form");
	user_form.validate({
		  rules: {
		  	email:{
		  		required: true,
                email:true,	
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

	user_form.submit(function(e){
		e.preventDefault();
		if(user_form.valid()==false) {
     	 	toastr.error('Please fill all fields properly before proceeding.');
        	return false;
 		}
		var url = $("#user_form").attr('action');
		var _that = $(this).closest('form');
		var formData = new FormData(_that[0]);
		$.ajax({
			type:'POST',
			url:'reffers/add',
			data:formData,
			processData:false,
			contentType: false,
			dataType:'json',
			success:function(res){
				if(res.status == 1){
					toastr.success(res.message);
					setTimeout(function(){ location.reload();; }, 500);
				}else{
					toastr.error(res.message);
				}
			}
		})
	});
</script>