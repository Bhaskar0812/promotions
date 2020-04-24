<div class="row">
	<div class="col-sm-12">
		<table id="show_users" class="display">
		    <thead>
		        <tr>
		            <th>User name</th>
		            <th>Email</th>
		            <th>Promotion Amount</th>
		            <th>Poll</th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php foreach($users as $user_key => $user_value){?>
		        <tr>
		            <td><?php echo $user_value['name']?></td>
		            <td><?php echo $user_value['email']?></td>
		            <td><?php echo $user_value['promotion_amount']?></td>
		            <td><?php 
		            			if($user_value['referer_poll'] == 1) 
		            				echo "Poll 1"; 
		            			elseif($user_value['referer_poll'] == 2)
		            					echo "Poll 2";
		            			elseif($user_value['referer_poll'] == 3)
		            					echo "Poll 3"
		            		?>
		            						
		            </td>
		        </tr>
		      <?php }?>  
		    </tbody>
		</table>
	</div>
</div>