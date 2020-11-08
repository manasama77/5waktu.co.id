<?php
$kueri_region = mysqli_query($con, "SELECT * FROM tbl_region ORDER by nama_region ASC");
?>
<form method="post" id="add-template" class="form-horizontal" action="admin.php?page=addpengiriman&amp;&amp;sub=1">
<fieldset>
<div class="control-group">
    <label class="control-label" for="">Region</label>
    <div class="controls">
    <select name="id_region" id="id_region">
    <?php
    while($data_region = mysqli_fetch_array($kueri_region))
    {
    ?>
        <option value="<?=$data_region['id_region'];?>"><?=$data_region['nama_region'];?></option>
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