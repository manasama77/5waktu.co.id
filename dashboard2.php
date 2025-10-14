                            <div class="widget-header">
                                <i class="icon-bar-chart"></i>
                                <h3>Jumlah Game Template Answer</h3>
                            </div>
                            <!-- /widget-header -->
                            <div class="widget-content" align="center">
                                <canvas id="bar-chart" class="chart-holder" width="1000" height="300">
                                </canvas>
                                <!-- /bar-chart -->
                            </div>
                            <!-- /widget-content -->

<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/base.js"></script>
<?php
$kueribs = mysqli_query($con, "SELECT * FROM tbl_template");
$kueriao = mysqli_query($con, "SELECT * FROM tbl_template_ao");
$kuericbl = mysqli_query($con, "SELECT * FROM tbl_template_cbl");
$kueridn = mysqli_query($con, "SELECT * FROM tbl_template_dn");
$kuerieos = mysqli_query($con, "SELECT * FROM tbl_template_eos");
$kuerigid = mysqli_query($con, "SELECT * FROM tbl_template_gid");
$kuerils = mysqli_query($con, "SELECT * FROM tbl_template_ls");
$kuerith = mysqli_query($con, "SELECT * FROM tbl_template_th");
$kueriyg = mysqli_query($con, "SELECT * FROM tbl_template_yg");

$countbs = mysql_num_rows($kueribs);
$countao = mysql_num_rows($kueriao);
$countcbl = mysql_num_rows($kuericbl);
$countdn = mysql_num_rows($kueridn);
$counteos = mysql_num_rows($kuerieos);
$countgid = mysql_num_rows($kuerigid);
$countls = mysql_num_rows($kuerils);
$countth = mysql_num_rows($kuerith);
$countyg = mysql_num_rows($kueriyg);
//echo($countbs);
?>
<script>
var barChartData = {
	labels: ["BS (<?=$countbs;?>)", "TH (<?=$countth;?>)", "DN (<?=$countdn;?>)", "EOS (<?=$counteos;?>)", "AO (<?=$countao;?>)", "LS (<?=$countls;?>)", "YG (<?=$countyg;?>)", "CBL (<?=$countcbl;?>)", "G-ID (<?=$countgid;?>)"],
	datasets: [
		{
			fillColor: "rgba(151,187,205,0.5)",
			strokeColor: "rgba(151,187,205,1)",
			data: [<?=$countbs;?>, <?=$countth;?>, <?=$countdn;?>, <?=$counteos;?>, <?=$countao;?>, <?=$countls;?>, <?=$countyg;?>, <?=$countcbl;?>, <?=$countgid;?>]
		}
	]

}

var myLine = new Chart(document.getElementById("bar-chart").getContext("2d")).Bar(barChartData);
</script>