<?php
$params = array(
			// 'id' => '#',
	'title' => 'HAWB',
	'description' => 'Last comment',
	'created_at' => 'Start date',
	'last_updated' => 'Last update',
	'name' => 'Pre/Post Release',
	'sla' => 'SLA (days)',
	'assigned' => 'Worker',
	'assigner' => 'Assigned by',
	'addonstatus' => array(
		'นายตรวจ','shift','consignee','refNo','สาเหตุ'
		)
	);
	?>

	<style type="text/css">
		table.table.table-responsive {
			min-width: 1500px;
		}

		section.newcontent {
			overflow: auto;
		}

		thead tr td {
		    font-size: 16px;
		    font-weight: bold;
		}

		.wrapper {
		    height: initial;
		    min-height: 100%;
		}
	</style>

	<!-- ( [id] => 2 [title] => Title2 Edit3 [description] => Test Description Edit3 [group] => 2 [category] => 1 [status] => 3 [addonstatus] => {"Agent":"","shift":"","consignee":"","refNo":"","causes":"0"} [assigned_to] => 7 [assigned_by] => 4 [comment] => [created_at] => 2017-03-14 00:00:00 [last_updated] => 2017-04-17 12:05:30 [updatedBy] => 1 [isDeleted] => 0 [userId] => 4 [email] => igetter7@gmail.com [password] => $2y$10$WaUYfWHQ6B6pMjj9WPH/fO.D0bYMlt8RYKrbEGylReLiqLbkysOdy [name] => Pre-release [mobile] => 0944247673 [roleId] => 3 [groupId] => 2 [createdBy] => 1 [createdDtm] => 2017-03-08 10:02:13 [updatedDtm] => 2017-03-14 04:19:19 [categoryId] => 1 [sla] => 30 [statusId] => 3 [statusName] => Closed [enabled] => 1 [enableAfter] => [statusGroup] => 2 [isDone] => 0 [group_name_EN] => Legal [group_name_TH] => งานคดี [cat_name] => Pre-release [assigned] => Tester [assigner] => Parinya Panyato [groupName] => งานคดี ) -->

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				<?= $groupName; ?> - Tasks
				<small>Add, Edit, Delete</small>
			</h1>
		</section>


		<section class="newcontent">
			<table class="table table-responsive hover" id="reporttbl">
				<thead>
					<tr>
						<?php
						foreach ($params as $key => $value) {
							if(is_array($value)) {
								foreach ($value as $v) {
						?>
							<td><?php echo $v; ?></td>
						<?php
								}
							} else {
							?>
							<td><?php echo $value; ?></td>
							<?php
							}
						}
						?>
					</tr>
				</thead>
				<tr>
					<?php
	// print_r($result);
					foreach ($result as $job) {
						foreach ($params as $key => $value) {
							if($key == "addonstatus") {
								$addition_rarams = json_decode($job->$key);
								foreach ($addition_rarams as $key => $value) {							
									?>
									<td><?php echo($value); ?></td>
									<?php
								}
							} else {
								?>
								<td><?php echo($job->$key); ?></td>
								<?php
							}
						}
						?>
					</tr>

					<?php
				}
				?></table>
			</section>

		</div>
		<script type="text/javascript">
			

        $(document).ready(function() {
            $('#reporttbl').DataTable( {
		         "scrollY":        "20vh",
		        // "scrollCollapse": true,
		        "paging":         false,
		        // "stateSave": true,
		        "dom": 'Bfrtip',
		        "buttons": [
		            'copy', 'csv', 'excel', 'pdf', 'print'
		        ]
		    } );
        } );


		</script>
