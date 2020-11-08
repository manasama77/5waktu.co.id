<style>
	td{ font-size:12px; }
</style>
<div class="container">	
	<div class="widget-header">
		<i class="fa fa-list-alt"></i>
		<h3>List User</h3>
	</div>
	<div class="widget-content">
		<div class="table-responsive">
			<table id="listuser" width="100%" class="table table-responsive table-hover table-bordered">
				<thead>
					<tr>			
						<th style="text-align:center;">ID User</th>
						<th style="text-align:center;">Username</th>
						<th style="text-align:center;">Level</th>
						<th style="text-align:center;">Status</th>
						<th style="text-align:center;">Dealer</th>
						<th style="text-align:center;">Kota</th>
						<th style="text-align:center;">Ekspedisi</th>
						<th style="text-align:center;"><i class="fa fa-cogs"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>


<div class="modal fade" id="modaledituser">
	<div class="modal-dialog">
		<div class="modal-content">.
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit <span id="usernameeditmodal"></span></h4>
			</div>
			<form class="form" method="post" action="update_user.php">
				<div class="modal-body">
					<div class="form-group">
						<label for="username_edit">Username</label>
						<input type="text" class="form-control" id="username_edit" name="username_edit" required readonly>
					</div>
					<div class="form-group">
						<label for="level_edit">Level</label>
						<select class="form-control" id="level_edit" name="level_edit" required>
							<option value="super_admin">Super Admin</option>
							<option value="admin">Admin</option>
							<option value="marketing">Marketing</option>
							<option value="dealer">Dealer</option>
						</select>
					</div>
					<div class="form-group">
						<label for="status_edit">Status</label>
						<select class="form-control" id="status_edit" name="status_edit" required>
							<option value="show">Show</option>
							<option value="hide">Hide</option>
						</select>
					</div>
					<div class="form-group">
						<label for="id_dealer_edit">Dealer</label>
						<?php
						$sql_dealer_edit_list   = "select * from tbl_dealer";
						$query_dealer_edit_list = mysqli_query($con, $sql_dealer_edit_list);
						$total_dealer_edit_list = mysqli_num_rows($query_dealer_edit_list);
						?>
						<select class="form-control select2" id="id_dealer_edit" name="id_dealer_edit" style="width:100%;" data-placeholder="Pilih Dealer">
							<option value=""></option>
							<?php
							if($total_dealer_edit_list > 0){
								while( $row_dealer_edit_list = mysqli_fetch_array($query_dealer_edit_list)){
									echo '<option value="'.$row_dealer_edit_list['id_dealer'].'">'.$row_dealer_edit_list['nama_dealer'].'</option>';
								}
							}
							?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" class="form-control" id="id_user_edit" name="id_user_edit">
					<button type="submit" class="btn btn-primary">Update</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalresetuser">
	<div class="modal-dialog">
		<div class="modal-content">.
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Reset Password <span id="usernameresetmodal"></span></h4>
			</div>
			<form class="form" method="post" action="reset_user.php">
				<div class="modal-body">
					<div class="form-group">
						<label for="username_reset">Username</label>
						<input type="text" class="form-control" id="username_reset" name="username_reset" required readonly>
					</div>
					<div class="form-group">
						<label for="level_edit">New Password</label>
						<input type="password" class="form-control" id="new_password" name="new_password" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" class="form-control" id="id_user_reset" name="id_user_reset">
					<button type="submit" class="btn btn-primary">Reset Password</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>