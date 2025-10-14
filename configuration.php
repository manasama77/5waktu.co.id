<div class="container">
			<div class="widget-header">
				<i class="icon-list-alt"></i>
				<h3>Modul Konfigurasi</h3>
			</div>
                    
			<?php
			$tab = $_REQUEST['tab'];
			$aktif1 = "";
			$aktif2 = "";
			$aktif3 = "";
			$aktif4 = "";
			$aktif5 = "";
			$aktif6 = "";
			$aktif7 = "";
			$aktif8 = "";
			$aktif9 = "";
			$subaktif1="";
			$subaktif2="";
			$subaktif3="";
			$subaktif4="";
			$subaktif5="";
			$subaktif6="";
			$subaktif7="";
			$subaktif8="";
			$subaktif9="";
			if($tab == 'vehicle')
			{
				$aktif1="class=\"active\"";
				$subaktif1=" active";
			}
			elseif($tab == 'driver')
			{
				$aktif2="class=\"active\"";
				$subaktif2=" active";
			}
			elseif($tab == 'asst')
			{
				$aktif3="class=\"active\"";
				$subaktif3=" active";
			}
			elseif($tab == 'region')
			{
				$aktif4="class=\"active\"";
				$subaktif4=" active";
			}
			elseif($tab == 'expedition')
			{
				$aktif5="class=\"active\"";
				$subaktif5=" active";
			}
			elseif($tab == 'dealer')
			{
				$aktif6="class=\"active\"";
				$subaktif6=" active";
			}
			elseif($tab == 'cpl')
			{
				$aktif7="class=\"active\"";
				$subaktif7=" active";
			}
			elseif($tab == 'mpl')
			{
				$aktif8="class=\"active\"";
				$subaktif8=" active";
			}
			elseif($tab == 'cn')
			{
				$aktif9="class=\"active\"";
				$subaktif9=" active";
			}
			elseif($tab == 'fcpl')
			{
				$aktif7="class=\"active\"";
				$subaktif10=" active";
			}
			elseif($tab == 'fcn')
			{
				$aktif9="class=\"active\"";
				$subaktif11=" active";
			}
			elseif($tab == 'fmpl')
			{
				$aktif8="class=\"active\"";
				$subaktif12=" active";
			}
			elseif($tab == 'fdealer')
			{
				$aktif6="class=\"active\"";
				$subaktif13=" active";
			}
			elseif($tab == 'fexpedition')
			{
				$aktif5="class=\"active\"";
				$subaktif14=" active";
			}
			elseif($tab == 'fregion')
			{
				$aktif4="class=\"active\"";
				$subaktif15=" active";
			}
			elseif($tab == 'fasst')
			{
				$aktif3="class=\"active\"";
				$subaktif16=" active";
			}
			elseif($tab == 'fdriver')
			{
				$aktif2="class=\"active\"";
				$subaktif17=" active";
			}
			elseif($tab == 'fvehicle')
			{
				$aktif1="class=\"active\"";
				$subaktif18=" active";
			}
			//echo $subaktif9;
			?>
            <div class="widget-content">
				<div class="tabbable">
					<ul class="nav nav-tabs">
						<li <?=$aktif1;?>>
						<a data-toggle="tab" href="#listmobil">Vehicle / Mobil</a>
						</li>
                        <li  <?=$aktif2;?>>
                            <a data-toggle="tab" href="#listdriver">Driver / Supir</a>
                        </li>
                        <li  <?=$aktif3;?>>
						<a data-toggle="tab" href="#listasst">Delivery Asst.</a>
						</li>
                        <li  <?=$aktif4;?>>
                            <a data-toggle="tab" href="#listregion">Region</a>
                        </li>
                        <li  <?=$aktif5;?>>
						<a data-toggle="tab" href="#listexpedition">Expedition</a>
						</li>
                        <li  <?=$aktif6;?>>
                            <a data-toggle="tab" href="#listdealer">Dealer</a>
                        </li>
                        <li  <?=$aktif7;?>>
                            <a data-toggle="tab" href="#classpricelist">Class Price List</a>
                        </li>
                        <li  <?=$aktif8;?>>
                            <a data-toggle="tab" href="#minpricelist">Min Price List</a>
                        </li>
                        <li  <?=$aktif9;?>>
                            <a data-toggle="tab" href="#listclassname">Class Name</a>
                        </li>
					</ul><br>
                    <div class="tab-content">
					
						<?php
						if($tab=="fvehicle")
						{
							?>
							<div id="listmobil" class="tab-pane<?=$subaktif18;?>">
								<?php include('filterlistmobil.php'); ?>
							</div>
							<?php
						}
						else
						{
						?>
                        <div id="listmobil" class="tab-pane<?=$subaktif1;?>">
							<?php include('listmobil.php'); ?>
						</div>
                        <?php
						}
						?>
						
						<?php
						if($tab=="fdriver")
						{
							?>
							<div id="listdriver" class="tab-pane<?=$subaktif17;?>">
								<?php include('filterlistdriver.php'); ?>
							</div>
							<?php
						}
						else
						{
						?>
                        <div id="listdriver" class="tab-pane<?=$subaktif2;?>">
							<?php include('listdriver.php'); ?>
						</div>
                        <?php
						}
						?>
						
						<?php
						if($tab=="fasst")
						{
							?>
							<div id="listasst" class="tab-pane<?=$subaktif16;?>">
								<?php include('filterlistasst.php'); ?>
							</div>
							<?php
						}
						else
						{
						?>
                        <div id="listasst" class="tab-pane<?=$subaktif3;?>">
							<?php include('listasst.php'); ?>
						</div>
                        <?php
						}
						?>
						
						<?php
						if($tab=="fregion")
						{
							?>
							<div id="listregion" class="tab-pane<?=$subaktif15;?>">
								<?php include('filterlistregion.php'); ?>
							</div>
							<?php
						}
						else
						{
						?>
                        <div id="listregion" class="tab-pane<?=$subaktif4;?>">
							<?php include('listregion.php'); ?>
						</div>
                        <?php
						}
						?>
						
						<?php
						if($tab=="fexpedition")
						{
							?>
							<div id="listexpedition" class="tab-pane<?=$subaktif14;?>">
								<?php include('filterlistexpedition.php'); ?>
							</div>
							<?php
						}
						else
						{
						?>
                        <div id="listexpedition" class="tab-pane<?=$subaktif5;?>">
							<?php include('listexpedition.php'); ?>
						</div>
                        <?php
						}
						?>
						
						<?php
						if($tab=="fdealer")
						{
							?>
							<div id="listdealer" class="tab-pane<?=$subaktif13;?>">
								<?php include('filterlistdealer.php'); ?>
							</div>
							<?php
						}
						else
						{
						?>
                        <div id="listdealer" class="tab-pane<?=$subaktif6;?>">
							<?php include('listdealer.php'); ?>
						</div>
                        <?php
						}
						?>
                        
						<?php
						if($tab=="fcpl")
						{
							?>
							<div id="classpricelist" class="tab-pane<?=$subaktif10;?>">
								<?php include('filterclasspricelist.php'); ?>
							</div>
							<?php
						}
						else
						{
						?>
                        <div id="classpricelist" class="tab-pane<?=$subaktif7;?>">
							<?php include('classpricelist.php'); ?>
						</div>
                        <?php
						}
						?>
						
						<?php
						if($tab=="fmpl")
						{
							?>
							<div id="minpricelist" class="tab-pane<?=$subaktif12;?>">
								<?php include('filterminpricelist.php'); ?>
							</div>
							<?php
						}
						else
						{
						?>
						<div id="minpricelist" class="tab-pane<?=$subaktif8;?>">
							<?php include('minpricelist.php'); ?>
						</div>
						<?php
						}
						?>                    
                        
                        <?php
						if($tab=="fcn")
						{
							?>
							<div id="listclassname" class="tab-pane<?=$subaktif11;?>">
								<?php include('filterlistclassname.php'); ?>
							</div>
							<?php
						}
						else
						{
						?>
                        <div id="listclassname" class="tab-pane<?=$subaktif9;?>">
							<?php include('listclassname.php'); ?>
						</div>
                        <?php
						}
						?>
					</div>
                    
				</div>
			</div>
</div>