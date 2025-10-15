<div class="subnavbar">
	<div class="subnavbar-inner" style="overflow-y: hidden; overflow-x: auto; min-height: 75px;">
		<div class="container">
			<ul class="mainnav">
				<li><a href="admin.php"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
				<li style="width:5px;"></li>
				<?php
				if ($_SESSION['login']['level'] == "super_admin") {
				?>
					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-truck"></i>
							<span>Pengiriman</span></a>
						<ul class="dropdown-menu">
							<li>
								<a href="admin.php?page=pengirimanprogress">
									<i class="fa fa-truck"></i>
									Progress
								</a>
							</li>
							<li>
								<a href="admin.php?page=pengirimandelivered">
									<i class="fa fa-truck"></i>
									Delivered
								</a>
							</li>
							<li style="background-color:#ccc;">
								<a href='admin.php?page=addpengiriman1'>
									<i class="fa fa-plus"></i><b>Add Pengiriman</b>
								</a>
							</li>
						</ul>
					</li>

					<li style="width:5px;"></li>
					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-globe"></i>
							<span>Regional</span></a>
						<ul class="dropdown-menu">
							<li><a href="admin.php?page=provinsi"><i class="fa fa-globe"></i> <span>Provinsi</span></a></li>
							<li><a href="admin.php?page=kota"><i class="fa fa-globe"></i> <span>Kota</span></a></li>
						</ul>
					</li>

					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-building"></i>
							<span>Dealer & Ekspedisi</span></a>
						<ul class="dropdown-menu">
							<li><a href="admin.php?page=dealer"><i class="fa fa-building"></i> <span>Dealer</span></a></li>
							<li><a href="admin.php?page=ekspedisi"><i class="fa fa-ship"></i> <span>Ekspedisi</span></a></li>
						</ul>
					</li>

					<li style="width:5px;"></li>

					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-list-alt"></i>
							<span>Produk</span></a>
						<ul class="dropdown-menu">
							<li><a href="admin.php?page=kategoriproduk"><i class="fa fa-list"></i> <span>Kategori Produk</span></a></li>
							<li><a href="admin.php?page=produkkatalog"><i class="fa fa-list"></i> <span>Produk Katalog</span></a></li>
						</ul>
					</li>

					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-dollar"></i>
							<span>Setting Harga</span></a>
						<ul class="dropdown-menu">
							<li><a href="admin.php?page=daftarharga&&subpage=1"><i class="fa fa-dollar"></i> <span>Daftar Harga</span></a></li>
							<li><a href="admin.php?page=satuanhargakota"><i class="fa fa-dollar"></i> <span>Satuan Harga Dasar</span></a></li>
							<li><a href="admin.php?page=satuanhargamin"><i class="fa fa-dollar"></i> <span>Satuan Harga Minimum</span></a></li>
							<li><a href="admin.php?page=satuanhargavol"><i class="fa fa-dollar"></i> <span>Satuan Harga Volumetric</span></a></li>
							<li><a href="admin.php?page=satuanhargaelectone"><i class="fa fa-dollar"></i> <span>Satuan Harga Electone</span></a></li>
							<li><a href="admin.php?page=satuanhargaclavinova"><i class="fa fa-dollar"></i> <span>Satuan Harga Clavinova</span></a></li>
						</ul>
					</li>

					<li style="width:5px;"></li>
					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-car"></i>
							<span>Driver, Asst. & Mobil</span></a>
						<ul class="dropdown-menu">
							<li><a href="admin.php?page=driver"><i class="fa fa-car"></i> <span>Driver</span></a></li>
							<li><a href="admin.php?page=asst"><i class="fa fa-car"></i> <span>Assistant</span></a></li>
							<li><a href="admin.php?page=mobil"><i class="fa fa-car"></i> <span>Mobil</span></a></li>
						</ul>
					</li>

					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa   fa-newspaper-o"></i>
							<span>Export Data</span></a>
						<ul class="dropdown-menu">
							<li><a href="admin.php?page=export"><i class="fa fa-file-excel-o"></i> <span>Excel Harian</span></a></li>
							<li><a href="admin.php?page=export2"><i class="fa fa-file-excel-o"></i> <span>Excel Select Range Date</span></a></li>
							<li><a href="admin.php?page=export3"><i class="fa fa-file-excel-o"></i> <span>Excel Monthly</span></a></li>
						</ul>
					</li>

					<li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-users"></i>
							<span>User Management</span></a>
						<ul class="dropdown-menu">
							<li><a href="admin.php?page=listuser"><i class="fa fa-users"></i> <span>List User</span></a></li>
							<li><a href="admin.php?page=adduser"><i class="fa fa-plus"></i> <span>Tambah User</span></a></li>
						</ul>
					</li>
				<?php
				}
				?>
				<?php
				if ($_SESSION['login']['level'] == "admin") {
				?>
					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-truck"></i>
							<span>Pengiriman</span></a>
						<ul class="dropdown-menu">
							<li>
								<a href="admin.php?page=pengirimanprogress">
									<i class="fa fa-truck"></i>
									Progress
								</a>
							</li>
							<li>
								<a href="admin.php?page=pengirimandelivered">
									<i class="fa fa-truck"></i>
									Delivered
								</a>
						</ul>
					</li>

					<li style="width:5px;"></li>
					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-globe"></i>
							<span>Regional</span></a>
						<ul class="dropdown-menu">
							<li><a href="admin.php?page=provinsi"><i class="fa fa-globe"></i> <span>Provinsi</span></a></li>
							<li><a href="admin.php?page=kota"><i class="fa fa-globe"></i> <span>Kota</span></a></li>
						</ul>
					</li>

					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-building"></i>
							<span>Dealer & Ekspedisi</span></a>
						<ul class="dropdown-menu">
							<li><a href="admin.php?page=dealer"><i class="fa fa-building"></i> <span>Dealer</span></a></li>
							<li><a href="admin.php?page=ekspedisi"><i class="fa fa-ship"></i> <span>Ekspedisi</span></a></li>
						</ul>
					</li>

					<li style="width:5px;"></li>

					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-list-alt"></i>
							<span>Produk</span></a>
						<ul class="dropdown-menu">
							<li><a href="admin.php?page=kategoriproduk"><i class="fa fa-list"></i> <span>Kategori Produk</span></a></li>
							<li><a href="admin.php?page=produkkatalog"><i class="fa fa-list"></i> <span>Produk Katalog</span></a></li>
						</ul>
					</li>

					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-dollar"></i>
							<span>Setting Harga</span></a>
						<ul class="dropdown-menu">
							<li><a href="admin.php?page=daftarharga&&subpage=1"><i class="fa fa-dollar"></i> <span>Daftar Harga</span></a></li>
							<li><a href="admin.php?page=satuanhargakota"><i class="fa fa-dollar"></i> <span>Satuan Harga Dasar</span></a></li>
							<li><a href="admin.php?page=satuanhargamin"><i class="fa fa-dollar"></i> <span>Satuan Harga Minimum</span></a></li>
							<li><a href="admin.php?page=satuanhargavol"><i class="fa fa-dollar"></i> <span>Satuan Harga Volumetric</span></a></li>
							<li><a href="admin.php?page=satuanhargaelectone"><i class="fa fa-dollar"></i> <span>Satuan Harga Electone</span></a></li>
							<li><a href="admin.php?page=satuanhargaclavinova"><i class="fa fa-dollar"></i> <span>Satuan Harga Clavinova</span></a></li>
						</ul>
					</li>

					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa   fa-newspaper-o"></i>
							<span>Export Data</span></a>
						<ul class="dropdown-menu">
							<li><a href="admin.php?page=export"><i class="fa fa-file-excel-o"></i> <span>Excel Harian</span></a></li>
							<li><a href="admin.php?page=export2"><i class="fa fa-file-excel-o"></i> <span>Excel Select Range Date</span></a></li>
							<li><a href="admin.php?page=export3"><i class="fa fa-file-excel-o"></i> <span>Excel Monthly</span></a></li>
						</ul>
					</li>

					<li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-users"></i>
							<span>User Management</span></a>
						<ul class="dropdown-menu">
							<li><a href="admin.php?page=listuser"><i class="fa fa-users"></i> <span>List User</span></a></li>
							<li><a href="admin.php?page=adduser"><i class="fa fa-plus"></i> <span>Tambah User</span></a></li>
						</ul>
					</li>
				<?php
				}
				?>
				<?php
				if ($_SESSION['login']['level'] == "marketing") {
				?>
					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-truck"></i>
							<span>Pengiriman</span></a>
						<ul class="dropdown-menu">
							<li>
								<a href="admin.php?page=pengirimanprogress">
									<i class="fa fa-truck"></i>
									Progress
								</a>
							</li>
							<li>
								<a href="admin.php?page=pengirimandelivered">
									<i class="fa fa-truck"></i>
									Delivered
								</a>
							</li>
						</ul>
					</li>
				<?php
				}
				?>
				<?php
				if ($_SESSION['login']['level'] == "staff") {
				?>
					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-truck"></i>
							<span>Pengiriman</span></a>
						<ul class="dropdown-menu">
							<li>
								<a href="admin.php?page=pengirimanprogress">
									<i class="fa fa-truck"></i>
									Progress
								</a>
							</li>
							<li>
								<a href="admin.php?page=pengirimandelivered">
									<i class="fa fa-truck"></i>
									Delivered
								</a>
							</li>
					</li>
					<li style="background-color:#ccc;">
						<a href='admin.php?page=addpengiriman1'>
							<i class="fa fa-plus"></i><b>Add Pengiriman</b>
						</a>
					</li>
			</ul>
			</li>
			<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-list-alt"></i>
					<span>Produk</span></a>
				<ul class="dropdown-menu">
					<!--li><a href="admin.php?page=kategoriproduk"><i class="fa fa-list"></i> <span>Kategori Produk</span></a></li-->
					<li><a href="admin.php?page=produkkatalog"><i class="fa fa-list"></i> <span>Produk Katalog</span></a></li>
				</ul>
			</li>
		<?php
				}
		?>
		</ul>
		</div>
	</div>
</div>