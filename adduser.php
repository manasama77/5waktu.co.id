<div class="container">
	<div class="widget-content">
		<?php
		include('config.php');
		?>
		<div id="formcontrols" class="tab-pane active">
			<form id="add-template" class="form-horizontal" action="prosesadduser.php" method="post">
				<div class="control-group">
					<label class="control-label" for="username">Username</label>
					<input class="form-control" name="username" type="text" id="username" required>
				</div>
				<div class="control-group">
					<label class="control-label" for="kategori">Password</label>
					<input class="form-control" name="password" type="password" class="text" id="password" required>
				</div>
				<div class="control-group">
					<label class="control-label" for="level">Level</label>
					<select class="form-control" id="level" name="level" required>
						<option value=""></option>
						<option value="admin">Admin</option>
						<option value="marketing">Marketing</option>
						<option value="staff">Staff</option>
						<option value="dealer">Dealer</option>
					</select>
				</div>
				<div class="control-group">
					<label class="control-label" for="status">Status</label>
					<select class="form-control" id="status" name="status" required>
						<option value="show">Show</option>
						<option value="hide">Hide</option>
					</select>
				</div>
				<div class="control-group">
					<label class="control-label" for="id_dealer">Dealer</label>
					<?php
					$sql_dealer   = "select * from tbl_dealer";
					$query_dealer = mysqli_query($con, $sql_dealer);
					$total_dealer = mysqli_num_rows($query_dealer);
					?>
					<select class="form-control select2" id="id_dealer" name="id_dealer" data-placeholder="Pilih Dealer" style="width:100%;">
						<option value=""></option>
						<?php
						if($total_dealer > 0){
							while( $row_dealer = mysqli_fetch_array($query_dealer)){
								echo '<option value="'.$row_dealer['id_dealer'].'">'.$row_dealer['nama_dealer'].'</option>';
							}
						}
						?>
					</select>
				</div>

				<div class="form-actions" style="margin-top:10px;">
					<button type="submit" class="btn btn-primary">Tambah User</button>
				</div>
			</form>
		</div>
	</div>
</div>