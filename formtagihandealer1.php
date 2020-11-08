<?php
$kueri_pengiriman = mysql_query("SELECT * FROM tbl_pengiriman WHERE status = 'show'");
$jenis_barang = mysql_query("SELECT * FROM tbl_barang WHERE status = 'show'");
?>
<form method="post" id="add-template" class="form-horizontal" action="admin.php?page=addpengiriman&&sub=2">
<fieldset>
<div class="control-group">
    <label class="control-label" for="no_mobil">No. Mobil</label>
    <div class="controls">
    <select name="no_mobil" id="no_mobil">
    <?php
    while($data_mobil = mysql_fetch_array($kueri_mobil))
    {
    ?>
        <option value="<?=$data_mobil['id_mobil'];?>"><?=$data_mobil['nama_mobil'];?></option>
    <?php
    }
    ?>
    </select>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="id_barang">Jenis Barang</label>
    <div class="controls">
    <select name="id_barang" id="id_barang">
<?php
    while($data_barang = mysql_fetch_array($jenis_barang))
    {
    ?>
        <option value="<?=$data_barang['id_barang'];?>"><?=$data_barang['nama_barang'];?></option>
    <?php
    }
    ?>
    </select>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="id_barang"><button class="btn btn-primary" type="submit">Next</button></label>
</div>
</fieldset>
</form>
</div>