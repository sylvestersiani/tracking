<?php require_once 'inc/control/add-project.php';?>
<?php 
	$page_title = "New order";
	require_once('inc/header.php');?>


<div class="view">
	<div class="container">		
		<form id="add-form" method="post" action="<?php $_SERVER['PHP_SELF'];?>">	
			<div class="error-box">

				<ul>
					<li>
						<span class="error"><?php isset($warning)? print $warning : '';?></span>
					</li>
					<li>
						<span class="error"><?php isset($name)? print $name : '';?></span>
					</li>
					<li>
						<span class="error"><?php isset($email)? print $email  : '';?></span>
					</li>
					<li>
						<span class="error"><?php isset($type)? print $type : '';?></span>
					</li>
					<li>
						<span class="error"><?php isset($timeline)? print $timeline  : '';?></span>
					</li>
					<li>
						<span class="error"><?php isset($status)? print  $status : '';?></span>
					</li>
					<li>
						<span class="error"><?php isset($description)? print $description : '';?></span>
					</li>
				</ul>
			</div>
			<div>
				<label>Client Name : 
					<input type="text" name="client_name" value="<?php isset($client_name) ? print $client_name : '' ;?>"  placeholder="Example"/>
				</label>
			</div>
			<div>
				<label>Client Email : 
					<input type="email" name="client_email" value="<?php isset($client_email) ? print $client_email : '' ;?>"  placeholder="example@mail.com"/>
				</label>
			</div>
			<div>
				<label>Order Type? : 
					<select name="project_type">
						<option value="">None</option>
						<option value="garment_printing"
							<?php isset($project_type)? print selected_option($project_type, 'garment_printing'): '' ;?>>Garment Printing
						</option>
						<option value="digital_printing"
							<?php isset($project_type)? print selected_option($project_type, 'digital_printing'): '' ;?>>Digital Printing
						</option>
					</select>
				</label>
			</div>
			<div>
				<label>Turnaround? : 
					<select name="project_timeline">
						<option value="">None</option>
						<option value="a" 
							<?php isset($project_timeline)? print selected_option($project_timeline, 'a'): '' ;?>  >Rush Job - 3 working days
						</option>
						<option value="b" 
							<?php isset($project_timeline)? print selected_option($project_timeline, 'b'): '' ;?>>3 - 5 working days
						</option>
						<option value="c" 
							<?php isset($project_timeline)? print selected_option($project_timeline, 'c'): '' ;?>>7 - 11 working days
						</option>
					</select>
				</label>
			</div>
			<div>
				<label>Order Status : 
					<select name="project_status">
						<option value="in_progress" 
							<?php isset($project_status)? print selected_option($project_status, 'in_progress'): '' ;?> >In Progress 
						</option>
						<option value="pre_press" 
							<?php isset($project_status)? print selected_option($project_status, 'pre_press'): '' ;?>>Pre-press Check
						</option>
						<option value="printing" 
							<?php isset($project_status)? print selected_option($project_status, 'printing'): '' ;?>>Printing
						</option>
						<option value="quality_check" 
							<?php isset($project_status)? print selected_option($project_status, 'quality_check'): '' ;?>>Quality Check
						</option>
						<option value="complete" 
							<?php isset($project_status)? print selected_option($project_status, 'project_status'): '' ;?>>Completed
						</option>
					</select>
				</label>
			</div>
			<div>
				<label>Brief Order Description :  <br>
					<textarea cols="5" rows="5" type="text" name="description" value="<?php isset($description)? print $description : '';?>" ></textarea>
				</label>
				<div>
					<button type="submit">Add</button>
				</div>
			</div>	
			
		</form><!--/end of form-->
	</div><!--/end of container div-->
</div>



<?php include('inc/footer.php');?>