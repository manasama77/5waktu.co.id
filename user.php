<div class="container">
			<div class="widget-header">
				<i class="fa fa-list-alt"></i>
				<h3>Management User Account</h3>
			</div>
                    
			<div class="widget-content">
				<div class="tabbable">
					<ul class="nav nav-tabs">
						<li class="active">
						<a data-toggle="tab" href="#listuser">List User</a>
						</li>
                        <li>
                            <a data-toggle="tab" href="#adduser">Add User</a>
                        </li>
					</ul><br>
                    <div class="tab-content">
						<div id="listuser" class="tab-pane active">
							<?php include('listuser.php'); ?>
						</div>
						<div id="adduser" class="tab-pane">
							<?php include('adduser.php'); ?>
						</div>
					</div>
				</div>
			</div>
</div>