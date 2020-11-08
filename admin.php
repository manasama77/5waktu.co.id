<?php
session_start();
$level = $_SESSION['login']['level'];
if(isset($_GET['logout']) AND $_GET['logout']=='1')
{
	unset($_SESSION['login']);
	session_destroy();
}
if(!isset($_SESSION['login']))
{
	header('location:index.php');
}
else
{
	include('config.php');
	//print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<title>Lima Waktu Logistic Application</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<link href="css/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="js/ajax.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<!--link rel="stylesheet" type="text/css" href="DataTables/jquery.dataTables.css"/-->
<style>
.dt-center {
	text-align:center;
}

.dt-right {
	text-align:right;
}

.dt-upper {
	text-transform:uppercase;
}
</style>
</head>
<body>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="fa fa-bar"></span>
				<span class="fa fa-bar"></span>
				<span class="fa fa-bar"></span>
			</a>
            <div class="brand"><a href="admin.php"><img src="img/logo.png" /></a></div>
			<div class="nav-collapse">
				<ul class="nav pull-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-user"></i>
							<?php echo($_SESSION['login']['username']); ?>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="?logout=1">
									Logout
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<!-- /nav-collapse -->
		</div>
		<!-- /container -->
	</div>
</div>
<?php include('menu.php'); ?>
<div class="main">
	<input type="hidden" id="level" value="<?=$level;?>">
	<div class="main-inner">
		<?php
		if(isset($_GET['page']))
		{
			$page = $_REQUEST['page'];
			include($page.'.php');
		}
		else
		{
			include('dashboard.php');
		}
		?>
	</div>
</div>
<!-- /main --> 
</div>
<!-- /main -->
<div class="footer">
<div class="footer-inner">
<div class="container">
<div class="row">
<div class="span12"> &copy; 2017 Lima Waktu Logistic. Version 1.0.9 - Add feature Datatables at modul dashboard, pengiriman progress & pengiriman delivered</div>
<!-- /span12 --> 
</div>
<!-- /row --> 
</div>
<!-- /container --> 
</div>
<!-- /footer-inner --> 
</div>
<!-- /footer --> 
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script src="js/jquery-ui.js" type="text/javascript"></script>
<!--script type="text/javascript" src="DataTables/jquery.dataTables.js"></script-->
<script>
function printDiv(divName) {
	 var printContents = document.getElementById(divName).innerHTML;
	 var originalContents = document.body.innerHTML;
	 document.body.innerHTML = printContents;
	 window.print();
	 document.body.innerHTML = originalContents;
}
</script>
<script>
$(document).ready(function(){
	/*var progressList = $('#progresslist').DataTable({
		"pageLength": 10,
		"ajax":{
			"url": 'ajax/data-pengiriman-progress.php',
			"dataSrc": ""
		},
		"columns": [
			{
				"data": null,
				"render": function(data){
					return "<button type=\"button\" class=\"btn btn-info btn-sm\" onClick=\"loadprogressmodal("+data.id_pengiriman+");\">"+data.do_num+"</button>";
				}
			},
			{ "data": "nama_kota" },
			{ "data": "do_print_date" },
			{ "data": "exit_date" },
			{ "data": "estimation_date" },
			{ "data": "nama_dealer" },
			{
				"data": "sum_harga",
				"render": $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' )
			},
			{
				"data": null,
				"render": function(data){
					var id_pengiriman = data.id_pengiriman;
					var random_id = data.random_id;
					var levelnya = $('#level').val();
					
					if(levelnya == "super_admin"){
						return "<a href=\"admin.php?page=editpengirimanprogress&random_id="+random_id+"&id="+id_pengiriman+"\"><button type=\"button\" class=\"btn btn-primary btn-sm\" title=\"Edit Laporan\"><i class=\"fa fa-edit\"></i></button></a><a href=\"deletepengirimanprogress.php?random_id="+random_id+"&id="+id_pengiriman+"\" onClick=\"return confirm('Are you sure you want to DELETE??');\"><button type=\"button\" class=\"btn btn-danger btn-sm\" title=\"Delete Laporan\"><i class=\"fa fa-trash\"></i></button></a>";
					}else{
						return "";
						$('#conlist').addClass("hide");
					}
				}
			}
		],
		"columnDefs": [
			{
				"targets": [6],
				"sClass": "dt-right"
			},
			{
				"targets": [0, 1, 2, 3, 4, 5, 7],
				"sClass": "dt-center"
			},
			{
				"searchable": false,
				"orderable": false,
				"targets": [7]
			}
		],
		"deferRender": true,
		"processing": true
	});*/
	
	/*var deliveredList = $('#deliveredlist').DataTable({
		"serverSide": true,
		"pageLength": 10,
		"ajax":{
			"url": 'ajax/data-pengiriman-delivered.php',
			"dataSrc": ""
		},
		"columns": [
			{
				"data": null,
				"render": function(data){
					return "<button type=\"button\" class=\"btn btn-info btn-sm\" onClick=\"loaddeliveredmodal("+data.id_pengiriman+");\">"+data.do_num+"</button>";
				}
			},
			{ "data": "nama_kota" },
			{ "data": "do_print_date" },
			{ "data": "exit_date" },
			{ "data": "estimation_date" },
			{ "data": "received_date" },
			{ "data": "nama_dealer" },
			{
				"data": "sum_harga",
				"render": $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' )
			},
			{
				"data": null,
				"render": function(data){
					var status_penerimaan = data.status_penerimaan;
					var status_pengiriman = data.status_pengiriman;
					var late = data.late;
					
					if(status_pengiriman == "delivered"){
						if(status_penerimaan == "late"){
							var status_penerimaan = status_penerimaan.toUpperCase();
							return status_pengiriman+" "+status_penerimaan+" "+late+" Hari";
						}else{
							var status_penerimaan = status_penerimaan.toUpperCase();
							return status_penerimaan;
						}
					}else{
						return "";
					}
					
				}
			},
			{
				"data": null,
				"render": function(data){
					var levelnya = $('#level').val();
					if(levelnya == "super_admin"){
						var id_pengiriman = data.id_pengiriman;
						var random_id = data.random_id;
						return "<a href=\"admin.php?page=editpengirimanprogress&random_id="+random_id+"&id="+id_pengiriman+"\"><button type=\"button\" class=\"btn btn-primary btn-sm\" title=\"Edit Laporan\"><i class=\"fa fa-edit\"></i></button></a><a href=\"deletepengirimanprogress.php?random_id="+random_id+"&id="+id_pengiriman+"\" onClick=\"return confirm('Are you sure you want to DELETE??');\"><button type=\"button\" class=\"btn btn-danger btn-sm\" title=\"Delete Laporan\"><i class=\"fa fa-trash\"></i></button></a><a href=\"javascript:displayParameterInfo()\" onClick=\"javascript:ajaxpage('printinvoice.php?id="+id_pengiriman+"', 'printableArea');\" data-toggle=\"modal\" data-target=\"#myModal2\"><button type=\"button\" class=\"btn btn-success btn-sm\" title=\"Print Invoice\"><i class=\"fa fa-print\"></i></button></a>";
					}else{
						return "";
						$('#conlist').addClass("hide");
					}
				}
			}
		],
		"columnDefs": [
			{
				"targets": [7],
				"sClass": "dt-right"
			},
			{
				"targets": [0, 1, 2, 3, 4, 5, 6, 8, 9],
				"sClass": "dt-center"
			},
			{
				"searchable": false,
				"orderable": false,
				"targets": [9]
			}
		],
		"deferRender": true,
		"processing": true
	});*/
	
	var progressList = $('#progresslist').DataTable( {
		"processing": true,
		"serverSide": true,
		"deferRender": true,
		"ajax":{
			url :"ajax/data-pengiriman-progress.php", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling
				$(".progressList-error").html("");
				$("#progressList").append('<tbody class="employee-grid-error"><tr><th colspan="11">No data found in the server</th></tr></tbody>');
				$("#progressList_processing").css("display","none");
				
			}
		},
		"columnDefs": [
			{
				"targets": [6],
				"sClass": "dt-right"
			},
			{
				"targets": [0, 1, 2, 3, 4, 5, 7],
				"sClass": "dt-center"
			},
			{
				"searchable": false,
				"orderable": false,
				"targets": [7]
			}
		]
	} );
	
	var deliveredlist = $('#deliveredlist').DataTable( {
		"processing": true,
		"serverSide": true,
		"deferRender": true,
		"cache": true,
		"order": [[2, 'DESC']],
		"ajax":{
			url :"ajax/data-pengiriman-delivered.php", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling
				$(".deliveredlist-error").html("");
				$("#deliveredlist").append('<tbody class="employee-grid-error"><tr><th colspan="11">No data found in the server</th></tr></tbody>');
				$("#deliveredlist_processing").css("display","none");
				
			}
		},
		"columnDefs": [
			{
				"targets": [7],
				"sClass": "dt-right"
			},
			{
				"targets": [0, 1, 2, 3, 4, 5, 6, 8, 9],
				"sClass": "dt-center"
			},
			{
				"searchable": false,
				"orderable": false,
				"targets": [9]
			}
		]
	} );
	
	var dashboardList = $('#dashboardlist').DataTable( {
		"processing": true,
		"serverSide": true,
		"deferRender": true,
		"ajax":{
			url :"ajax/data-dashboard.php", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling
				$(".dashboardlist-error").html("");
				$("#dashboardlist").append('<tbody class="employee-grid-error"><tr><th colspan="11">No data found in the server</th></tr></tbody>');
				$("#dashboardlist_processing").css("display","none");
				
			}
		},
		"columnDefs": [
			{
				"targets": [7],
				"sClass": "dt-right"
			},
			{
				"targets": [0, 1, 2, 3, 4, 5, 6, 8, 9, 10],
				"sClass": "dt-center"
			}
		],
	} );

	// PART OF USER LIST
	var userList = $('#listuser').DataTable({
		"processing": true,
		"serverSide": true,
		"deferRender": true,
		"order": [[ 0, "asc" ]],
		"columnDefs": [
			{
				"targets": [7],
				"sClass": "dt-center",
				"sortable": false
			}
		],
		"ajax":{
			url :"ajax/data-listuser.php", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling
				$(".listuser-error").html("");
				$("#listuser").append('<tbody class="employee-grid-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
				$("#listuser_processing").css("display","none");
				
			}
		}
	});

	// END PART OF USER LIST
	
	function commaSeparateNumber(val) {
		while (/(\d+)(\d{3})/.test(val.toString())) {
			val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
		}
		return val;
	}
	
    $(function() {
        $( '#masa_berlaku_stnk' ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
		
		$( '#tahun_pembuatan' ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
		
		$( '#do_print_date' ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
		
		$( '#exit_date' ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
		
		$( '#received_date' ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
		
		$( '#date_terima_ekspedisi' ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
		
		$( '#excel_harian' ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
		
		$( '#excel_start' ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
		
		$( '#excel_end' ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
		
		$( '#excel_start1' ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
		
		$( '#excel_end1' ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
		
		$( '#excel_start2' ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
		
		$( '#excel_end2' ).datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
		
    });
});
$.datepicker.setDefaults({
	showOn: "both",
  	buttonImageOnly: true,
  	buttonImage: "img/iconCalendar.gif",
 	buttonText: " Calendar",
	formatDate: "yy-mm-dd"
});
</script>
<!--script src="js/jquery-1.7.2.min.js" type="text/javascript"></script-->
<script src="js/excanvas.min.js"></script> 
<script src="js/chart.min.js" type="text/javascript"></script> 
<script src="js/bootstrap.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>
<script src="js/base.js"></script> 
<script>
function loaddashboardmodal(id){
	$( "#modalnyadash" ).load( "dashboardmodal.php?id="+id, function() {
	  $("#myModal").modal("show");
	});
}

function loadprogressmodal(id){
	$.ajax({
		url: `progressmodal.php`,
		method: 'get',
		data: { 
			id : id,
			level: '<?=$_SESSION['login']['level'];?>'
		}
	}).done(function(res){		
		$('#modalnyaprog').html(res);
		$("#myModal").modal("show");
	});
	// $( "#modalnyaprog" ).load( "progressmodal.php?id="+id, function() {
	//   $("#myModal").modal("show");
	// });
}

function loaddeliveredmodal(id){
	$.ajax({
		url: `deliveredmodal.php`,
		method: 'get',
		data: { 
			id : id,
			level: '<?=$_SESSION['login']['level'];?>'
		}
	}).done(function(res){		
		$('#modalnyadeli').html(res);
		$("#myModal").modal("show");
	});
	// $( "#modalnyadeli" ).load( "deliveredmodal.php?id="+id, function() {
	//   $("#myModal").modal("show");
	// });
}

function editUser(id, username){
	$.ajax({
		url: 'ajax/get_list_single_user_info.php',
		method: 'get',
		dataType: 'json',
		data: { id_user: id }
	})
	.done(function(res){
		if(res.total == 1){
			$('#usernameeditmodal').val(username);
			$('#username_edit').val(res.username);
			$('#level_edit').val(res.level);
			$('#status_edit').val(res.status);
			$('#id_dealer_edit').val(res.id_dealer);
			$('#modaledituser').modal('show');
		}else{
			alert('Data Tidak Ditemukan');
			$('#modaledituser').modal('hide');
		}
	});
}
</script>
</body>
</html>
<?php
}
?>