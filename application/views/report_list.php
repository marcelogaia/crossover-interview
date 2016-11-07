		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading"><h3>Reports List</h3></div>
			<div class="panel-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>

			<!-- Table -->
			<table class="table table-hover table-responsive report-list" data-object="report" data-delete-url="<?= site_url('report/delete/') ?>">
				<thead>
					<th>Report ID</th>
					<th>Case number</th>
					<th>Patient name</th>
					<th>Doctor name</th>
					<th>Date</th>
<?php if($this->session->user_type == "Operator"){ ?>
					<th>Actions</th>
<?php } ?>
				</thead>
				<tbody>
					{report_entries}
					<tr class='item' data-href="<?= site_url('report/{link}{id}') ?>" data-id="{id}" >
						<td>{id}</td>
						<td>{case_number}</td>
						<td>{patient_name}</td>
						<td>{doctor}</td>
						<td>{date}</td>
<?php if($this->session->user_type == "Operator"){ ?>
						<td style="width:100px">
							<div class="btn-group" role="group" aria-label="Report Actions">
								<button type="button" class="btn btn-default edit">
									<span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit" aria-hidden="true"></span>
								</button>
								<button type="button" class="btn btn-default remove">
									<span class="glyphicon glyphicon-remove" data-toggle="tooltip" title="Delete" style="color:red" aria-hidden="true"></span>
								</button>
							</div>
						</td>
<?php } ?>
					</tr>
					{/report_entries}
				</tbody>
			</table>
			<a href="<?= site_url('report/add') ?>" class="btn btn-default">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			</a>
		</div>