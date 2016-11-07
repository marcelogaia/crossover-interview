		<h2>Local medical Laboratory</h2>
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Information</div>
			<div class="panel-body">
				<div class="col-sm-6 col-xs-12">
					<p>
						<span class="label">Patient name:</span>
						<span class="data">{user_name}</span>
					</p>
					<p>
						<span class="label">DOB:</span>
						<span class="data">{user_dob}</span>
					</p>
					<p>
						<span class="label">Sex:</span>
						<span class="data">{user_sex}</span>
					</p>
					<p>
						<span class="label">Doctor name:</span>
						<span class="data">{doctor}</span>
					</p>
				</div>
				<div class="col-sm-6 col-xs-12">
					<p>
						<span class="label">Case number:</span>
						<span class="data">{case_number}</span>
					</p>
					<p>
						<span class="label">Date:</span>
						<span class="data">{date}</span>
					</p>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Tests</div>
			<div class="panel-body">
				<table class="table table-hover table-responsive report-list">
					<thead>
						<th>Exam name</th>
						<th>Result</th>
						<th>Expected result</th>
						<th>Date Collected</th>
					</thead>
					<tbody>
						{testResults}
						<tr>
							<td>{name}</td>
							<td>{result}</td>
							<td>{expected_result}</td>
							<td>{date_collected}</td>
						</tr>
						{/testResults}
					</tbody>
				</table>

			</div>
		</div>

		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">Gross Description</div>
			<div class="panel-body">
				{gross}
			</div>
		</div>
		<a href="<?= site_url('report/export/{id}')?>" class="btn btn-default"><img src="http://i.stack.imgur.com/ladJx.png" alt="PDF"> Export to PDF</a>