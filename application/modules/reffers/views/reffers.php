<div class="row">
	<div class="col-sm-12">
		<table id="show_users" class="display">
		    <thead>
		        <tr>
		            <th>Reffer name</th>
		            <th>Reffer Email</th>
		            <th>Reffer Date</th>
		            <th>Reffer Status</th>
		            <th>Reffer Pool</th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php foreach($users as $user_key => $user_value){?>
		        <tr>
		            <td><?php echo $user_value['name']?></td>
		            <td><?php echo $user_value['email']?></td>
		            <td><?php echo $user_value['refrance_date']?></td>
		            <td>
		            	<?php 
		            		if($user_value['reffrence_status'] == 0){
		            					echo "Pending";
            				}else{
            					echo "Complete";
            				}?>	
            		</td>

            		<td>
		            	<?php 
		            		if($user_value['referer_poll'] == 1){
		            			echo "Poll 1";
            				}elseif($user_value['referer_poll'] == 2){
            					echo "Poll 2";
            				}elseif($user_value['referer_poll'] == 3){
            					echo "Poll 3";
            				}?>	
            		</td>
		        </tr>
		      <?php }?>  
		    </tbody>
		</table>
	</div>
</div>