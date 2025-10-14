<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Pengiriman</h3>
</div>
<div class="widget-content">
<?php
include('config.php');
?>
<div id="formcontrols" class="tab-pane active">
	<form id="add_pengiriman" class="form-horizontal" action="admin.php?page=addpengiriman2" method="post">
    	<fieldset>
			
			<div class="control-group">
            	<label class="control-label" for="">Gudang</label>
				<div class="controls">
					<select name="nama_gudang" id="nama_gudang">
					  <option value="PUNINAR">PUNINAR</option>
					  <option value="MOL MARUNDA">MOL MARUNDA</option>
<option value="YMSC">YMSC</option>
<option value="YMID OFFICE">YMID OFFICE</option>
<option value="YMHSHRM">YMHSHRM</option>
<option value="DLRRTN">DLRRTN</option>
                  	</select>
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Provinsi</label>
				<div class="controls">
					<select name="id_provinsi" id="id_provinsi">
                    <?php
					$kueri_provinsi = mysqli_query($con, "SELECT * FROM tbl_provinsi ORDER BY nama_provinsi ASC");
					while($data_provinsi=mysqli_fetch_array($kueri_provinsi))
					{
						$id_provinsi=$data_provinsi['id_provinsi'];
						$nama_provinsi=$data_provinsi['nama_provinsi'];
					?>
					  <option value="<?=$id_provinsi;?>"><?=$nama_provinsi;?></option>
			      	<?php
					}
				  	?>
                  	</select>
				</div>
            </div>
			
			
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Next</button>
            </div>
    	</fieldset>
    </form>
</div>
</div>