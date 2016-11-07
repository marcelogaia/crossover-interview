		<h2>Report information</h2>

		<form action="<?= site_url('report/save')?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="{id}"">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading">Information</div>
				<div class="panel-body">
					<div class="col-sm-6 col-xs-12">
						<p>
							<label>Patient name:</label><!-- TODO: Ajax DOB and Sex -->
							<select name="patient" class="form-control patients" data-url="<?= site_url('patient/get_ajax/') ?>">
								<option value="">-- Select a patient --</option>
								{patients}
								<option value="{id}" {selected}>{name}</option>
								{/patients}
							</select>
						</p>
						<p class="dob">
							<label>DOB:</label>
							<span class="data">{user_dob}</span>
						</p>
						<p class="sex">
							<label>Sex:</label>
							<span class="data">{user_sex}</span>
						</p>
						<p>
							<label>Doctor name:</label>
							<span class="data"><input type="text" name="doctor" class="form-control" value="{doctor}"></span>
						</p>
					</div>
					<div class="col-sm-6 col-xs-12">
						<p>
							<label>Case number:</label>
							<span class="data"><input type="text" name="case_number" class="form-control" value="{case_number}"></span>
						</p>
						<p>
							<label>Date:</label>
							<span class="data"><input type="text" name="date" class="form-control dtpickr" value="{date}"></span>
						</p>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading">Tests</div>
				<div class="panel-body">
					<table class="table table-hover table-responsive">
						<thead>
							<th>Exam name</th>
							<th>Result</th>
							<th>Expected result</th>
							<th>Date Collected</th>
						</thead>
						<tbody>
							<tr class="blank">
								<td>
									<select name="testResults[x][test_id]" class="form-control test-select">
										<option value="" data-expected="">-- Select a test --</option>
										{tests}
										<option value="{id}" {selected} data-expected="{expected_result}">{name}</option>
										{/tests}
									</select>
								</td>
								<td><input type="text" name="testResults[x][result]" class="form-control" value=""></td>
								<td class="expected"></td>
								<td><input type="text" name="testResults[x][date_collected]" class="form-control dtpickr" value=""></td>
							</tr>
							{testResults}
							<tr>
								<td>
									<select name="testResults[{id}][test_id]" class="form-control test-select">
										<option value="">-- Select a test --</option>
										{tests}
										<option value="{id}" {selected} data-expected="{expected_result}">
											{name}
										</option>
										{/tests}
									</select>
								</td>
								<td><input type="text" name="testResults[{id}][result]" class="form-control" value="{result}"></td>
								<td class="expected">{expected_result}</td>
								<td><input type="text" name="testResults[{id}][date_collected]" class="form-control dtpickr" value="{date_collected}"></td>
							</tr>
							{/testResults}
							<tr>
								<td>
									<button type="button" class="btn btn-default add-row">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									</button>
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>

				</div>
			</div>

			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading">Gross Description</div>
				<div class="panel-body">
					<textarea name="gross" class="form-control">{gross}</textarea>
				</div>
			</div>

			<div class="no-gutter">
				<div class="col-xs-12">
					<button type="submit" class="btn btn-default">Save</button>
				</div>
			</div>
		</form>