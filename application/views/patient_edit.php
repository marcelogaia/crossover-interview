		<h3>Patient information</h3>

		<form action="<?= site_url('patient/save')?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="{id}"">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading">Information</div>
				<div class="panel-body">
					<div class="col-sm-6 col-xs-12">
						<p>
							<label>Patient name:</label>
							<span class="data"><input type="text" name="name" value="{name}" class="form-control"></span>
						</p>
						<p>
							<label>DOB:</label>
							<span class="data"><input type="text" name="dob" value="{dob}" class="dtpickr form-control"></span>
						</p>
						<p>
							<label>Sex:</label>
							<select name="sex" class="form-control">
								<option value="">-- Select a sex --</option>
								{sexes}
								<option value="{sex}" {selected}>{label}</option>
								{/sexes}
							</select>
						</p>
						<p>
							<label>Blood type:</label>
							<select name="blood" class="form-control">
								<option value="">-- Select a Blood type --</option>
								{bloods}
								<option {selected}>{blood}</option>
								{/bloods}
							</select>
						</p>
					</div>
					<div class="col-sm-6 col-xs-12">
						<p>
							<label>Email:</label>
							<span class="data"><input type="text" name="email" value="{email}" class="form-control"></span>
						</p>
						<p>
							<label>Pass code:</label>
							<span class="input-group">
								<input type="text" value="{password}" name="password" class="form-control">
								<span class="input-group-btn">
									<button class="btn btn-default generate" type="button">
										<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
									</button>
								</span>
							</span>
						</p>
					</div>
					<div class="col-xs-12"><button type="submit" class="btn btn-default">Save</button></div>
				</div>
			</div>
		</form>