<?php 
	$page_title = "Dashboard";
	require_once('inc/header.php');

	// still running from the verify_login page, the db is still connected and we're running a new query to get all live project that aren't completed
	
	$work_log = "SELECT * FROM track WHERE status != 'complete' ORDER BY turnaround_time ASC";
	$show_work_log = mysqli_query($db_con, $work_log);
?>
<div class="view">
	<div class="container">
		<p><?php echo 'Hello ' .'<b>'. active_user() .'</b>'. '!'; ?></p>
		<?php
			if (mysqli_num_rows($show_work_log) > 0) {
				while($row = mysqli_fetch_assoc($show_work_log)){	
		?>
		<div class="live-project">
			<ul>
				<li><label>Order # : </label><?php echo ($row['project_name']);?></li>
				<li><label>Tracking # : </label><?php echo $row['tracking']; ?></li>
				<li><label>Client Name : </label><?php echo ucwords($row['client_name']); ?></li>
				<li><label>Set Date : </label><?php echo ($row['set_time']); ?></li>
				<li><label>Expected Turnaround : </label>
					<?php 
						switch ($row['turnaround_time']) {
							case 'a':
								echo 'Rush Job' ;
								break;
							case 'b':
								echo '3 - 5 working days ' ;
								break;
							case 'c':
								echo '5 - 7 working days ' ;
								break;
							default:
								'This should never show!! Ever ';
						} 
					?>
				</li>
				<li>
					<label>Brief Description : </label><?php echo wordwrap($row['description'], 40);?>
				</li>
				<li><label>Current Status : </label>
					<?php 
						switch ($row['status']) {
							case 'in_progress':
								echo  ucwords('In Progress') ;
								break;
							case 'pre_press':
								echo ucwords('Pre Press Check ') ;
								break;
							case 'printing':
								echo ucwords('In production (Printing)') ;
								break;
							case 'quality_check':
								echo ucwords('Post production QC') ;
								break;
							case 'complete':
								echo ucwords('Completed') ;
								break;
							default:
								echo strtoupper('This should never show!! Ever ');
						} 	
						// passing the link that will enable the user to edit the status
					 	echo '<a href="edit.php?id='.$row['ID'].'">Edit</a>';
					 ?>
				</li> 
			</ul>
		</div>
		<?php 
				}
				// realising the variable of the data passed to it.
				// not necessary as php automatically does it but it's good practice
				mysqli_free_result($show_work_log);
			}else { echo 'No Live Projects.'; }
		?>
	</div>
</div>


<?php include('inc/footer.php');?>