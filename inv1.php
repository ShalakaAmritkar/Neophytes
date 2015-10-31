<?php
    require("config.php");
    /*if(empty($_SESSION['id'])) 
    {
        header("Location: home.php");
        die("Redirecting to home.php"); 
    }*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Visual Admin Dashboard - Home</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <!-- 
    Visual Admin Template
    http://www.templatemo.com/preview/templatemo_455_visual_admin
    -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
	
	
	
	<script type="text/javascript">

		function ValidateMobNumber(txtMobId,txtNameId,txtAddrId,txtCityId) {
		  var fld = document.getElementById(txtMobId);
		  var fld1 = document.getElementById(txtNameId);
		  var fld2 = document.getElementById(txtAddrId);
		  var fld3 = document.getElementById(txtCityId);
		  
		
		  if (isNaN(fld.value)) {
		  alert("The phone number contains illegal characters.");
		  fld.value = "";
		  fld1.value= "";
		  fld2.value= "";
		  fld3.value="";
		  fld.focus();
		  return false;
		 }
		 else if (!(fld.value.length == 10)) {
		  alert("The phone number is the wrong length. \nPlease enter 10 digit mobile no.");
		  fld.value = "";
		  fld1.value= "";
		  fld2.value= "";
		  fld3.value="";
		  fld.focus();
		  return false;
		 }

		}
		
		function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
}

	</script>

  </head>
  <body>  
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <img src="images/Neevlogo.png" alt="Profile Photo" class="img-responsive">  
        </header>
		<nav class="templatemo-left-nav">          
          <ul>
            <li><a href="inv1.php" class="active"><i class="fa fa-database fa-fw"></i>Inventory</a></li>
            <li><a href="sales.php"><i class="fa fa-shopping-cart fa-fw"></i>Sales</a></li>
			<li><a href="reports.php"><i class="fa fa-bar-chart fa-fw"></i>Reports</a></li>
            <li><a href="logout.php"><i class="fa fa-power-off fa-fw"></i>Sign Out</a></li>
          </ul>  
        </nav>
		
        <div class="profile-photo-container">
          <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">  
          <div class="profile-photo-overlay"></div>
        </div>      
        <!-- Search box -->
        <form class="templatemo-search-form" role="search">
          <div class="input-group">
                        
          </div>
        </form>
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        
      </div>   <!-- templatemo-sidebar --> 
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
			    <li><a href="#inv" data-toggle="tab">Inventory</a></li>
                <li><a href="#supplier" data-toggle="tab">Supplier</a></li>
				<li><a href="#update" data-toggle="tab">Update inventory</a></li>
				</ul> 
            </nav> 
          </div>
        </div>

		<!-- Modal HTML -->
	
			<div class="tab-content" >
                  <div class="tab-pane active in" id="inv">
                     <div class="templatemo-content-container">
			
			<form action="" method="post">
			<input type="submit" class="btn square-btn-adjust btn-primary text-uppercase pull-right" name="rem_finish" value="Remove"  />
			<div class="pull-right" style="color: #efefef;">kds</div>
			<input type="button" class="btn square-btn-adjust btn-primary text-uppercase pull-right" name="add_finish" value="Add" data-toggle="modal" data-target="#add_finish" />
			<div class="pull-right" style="color: #efefef;">kds</div>
			<div class="col-1">
              <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">Finished goods</h2>
				</div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
						<td></td>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Quantity</td>
						<td>Production Cost</td>
                      </tr>
                    </thead>
                    <tbody>
 						<?php
							$query = "SELECT * FROM neev.product";
							try {
								$res = mysql_query($query);
								if($res === FALSE) { 
									die(mysql_error()); // TODO: better error handling
								}
							}	
							catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
							if (mysql_num_rows($res) > 0 ) {
								while($row = mysql_fetch_array($res)) {?>
									<tr>
									<td><input type="checkbox" name="prod[]" value="<?php echo $row['pid']; ?>" /></td>
									<td><?php echo $row['pid']; ?></td>
									<td><?php echo $row['type']; ?></td>
									<td><?php echo $row['quantity']; ?></td>
									<td><?php echo $row['prodprice']; ?></td>
									</tr>
									<?php }
								}
							?>  
                    </tbody>
                  </table>    
                </div>                          
              </div>
            </div>
		</form>
			
							<?php
								if(!empty($_POST['rem_finish'])){
									if (isset($_POST['prod'])) {
										$query2 = "DELETE FROM neev.product WHERE pid in ";
										$query2.="('".implode("','", array_values($_POST['prod']))."')";
											try {  
												$res = mysql_query($query2);
												if($res === FALSE) { 
													die(mysql_error()); // TODO: better error handling
												}
											} 
											catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
									} else {
										echo '<script type="text/javascript">alert("Please select entries to remove")</script>';
									}
									echo '<meta http-equiv="refresh" content="0">';
								}
							?>
			
		<div id="add_finish" class="modal fade">
		<form action="" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add new item</h4>
                </div>
                <div class="modal-body">
							Product: </br> 
							<input type="text" name="product" value="" required />
							</br> </br>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-default" data-dismiss="modal" value="Cancel" />
					<input type="submit" class="btn btn-default btn-primary" name="add_finish" value="Add" />
                </div>
            </div>
        </div>
		</form>
			<?php
				if(!empty($_POST['add_finish'])){
					$date = date('Y-m-d');
					$query2 = "INSERT INTO neev.product (type, quantity, prodprice, sellprice, date) VALUES ('".$_POST['product']."',0,0,0, '$date')" ;						
					try {  
						$res = mysql_query($query2);
						if($res === FALSE) { 
							die(mysql_error()); // TODO: better error handling
						}
					} 
					catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
					echo '<meta http-equiv="refresh" content="0">';
				}
				?>
    </div>
	
	
			<hr style="border-top: dotted 1px;" />
			<form action="" method="post">
			<input type="submit" class="btn square-btn-adjust btn-primary text-uppercase pull-right" name="rem_raw" value="Remove" />
			<div class="pull-right" style="color: #efefef;">kds</div>
			<input type="button" class="btn square-btn-adjust btn-primary text-uppercase pull-right" name="add_raw" value="Add" data-toggle="modal" data-target="#add_raw"/>
			<div class="pull-right" style="color: #efefef;">kds</div>
			<div class="col-1">
              <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">Raw material</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
						<td></td>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Quantity</td>
                      </tr>
                    </thead>
                    <tbody>
					 	<?php
							$query = "SELECT * FROM neev.rawmaterial";
							try {
								$res = mysql_query($query);
								if($res === FALSE) { 
									die(mysql_error()); // TODO: better error handling
								}
							}	
							catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
							if (mysql_num_rows($res) > 0 ) {
								while($row = mysql_fetch_array($res)) {?>
									<tr>
									<td><input type="checkbox" name="raw[]" value="<?php echo $row['materialid']; ?>" /></td>
									<td><?php echo $row['materialid']; ?></td>
									<td><?php echo $row['materialname']; ?></td>
									<td><?php echo $row['quantity']; ?></td>
									</tr>
									<?php }
								}
							?>
                    </tbody>
                  </table>    
                </div>                          
              </div>
            </div>        
		</form>
  
  
  							<?php
								if(!empty($_POST['rem_raw'])){
										
										if (isset($_POST['raw'])) {
											$query2 = "DELETE FROM neev.rawmaterial WHERE materialid in ";
											$query2.="('".implode("','", array_values($_POST['raw']))."')";
												try {  
													$res = mysql_query($query2);
													if($res === FALSE) { 
														die(mysql_error()); // TODO: better error handling
													}
												} 
												catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
										}
										else {
											echo '<script type="text/javascript">alert("Please select entries to remove")</script>';
										}
										echo '<meta http-equiv="refresh" content="0">';
								}
							?>
  
  		<div id="add_raw" class="modal fade">
		<form action="" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add new item</h4>
                </div>
                <div class="modal-body">
							Product: </br> 
							<input type="text" name="product" value="" required />
							</br> </br>
							Minimum quantity: </br> 
							(Enter the minimum quantity of raw material that should be present)
							<input type="number" name="min_quant" value="" id="text1" onkeypress="return isNumberKey(event);" required />
					
	
							</br> </br>

                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-default" data-dismiss="modal" value="Cancel" />
					<input type="submit" class="btn btn-default btn-primary" name="add_raw" value="Add" />
                </div>
            </div>
        </div>
		</form>
		<?php
				if(!empty($_POST['add_raw'])){
					$query1 = "SELECT materialid FROM neev.rawmaterial WHERE materialname='".$_POST['product']."'";
					try {  
						$res = mysql_query($query1);
						if($res === FALSE) { 
							die(mysql_error()); // TODO: better error handling
						}
					} 
					catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
					if (mysql_num_rows($res) > 0 ) {
						echo "Raw material exists";	
					} else {
						$query = "INSERT INTO neev.rawmaterial (materialname,threshhold,quantity) VALUES ('".$_POST['product']."',".$_POST['min_quant'].", 0)";
						try {  
							$res = mysql_query($query);
							if($res === FALSE) { 
								die(mysql_error()); // TODO: better error handling
							}
						} 
						catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
					}
					echo '<meta http-equiv="refresh" content="0">';
				}
			?>
    </div>
	
        </div>
    </div ><!-- /.inv-pane -->
	
				
                  <div class="tab-pane" id="supplier" style="width: 80%; position: absolute" > <!-- /.supplier-pane -->
					<div class="panel panel-default templatemo-content-widget white-bg">
					
					
							<div class="panel-heading"><h2 class="text-uppercase">Supplier</h2> </div>
							
							
                    		<form action="" method="post" target="hiddenFrame">
								 <table class="table table-striped table-bordered">
									<thead>
									  <tr>
										<td></td>
										<td>Id</td>
										<td>Name</td>
										<td>Address</td>
										<td>City</td>
										<td>Contact</td>
									  </tr>
									</thead>
									<tbody>
									<?php
										$query = "SELECT * FROM neev.supplier";
										try {
											$res = mysql_query($query);
											if($res === FALSE) { 
												die(mysql_error()); // TODO: better error handling
											}
										}	
										catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
										if (mysql_num_rows($res) > 0 ) {
											while($row = mysql_fetch_array($res)) {?>
												<tr>
												<td><input type="checkbox" name="supp[]" value="<?php echo $row['supplierid']; ?>" style="align: center"/></td>
												<td><?php echo $row['supplierid']; ?></td>
												<td><?php echo $row['suppliername']; ?></td>
												<td><?php echo $row['street']; ?></td>
												<td><?php echo $row['city']; ?></td>
												<td><?php echo $row['contact']; ?></td>
												</tr>
										<?php }
										}
									?>                  
									</tbody>
								  </table>    
							</br> </br>
							<input type="button" class="btn square-btn-adjust btn-primary text-uppercase" name="add_supplier" value="Add" data-toggle="modal" data-target="#add_supplier" />
							<input type="button" class="btn square-btn-adjust btn-primary text-uppercase" name="update_supplier" value="Update" data-toggle="modal" data-target="#update_supplier"/>
							<input type="submit" class="btn btn-default btn-primary" name="remove_supp" value="Remove" />
					</form>
					
							<?php
								if(!empty($_POST['remove_supp'])){
									if (isset($_POST['supp'])) {
										$query2 = "DELETE FROM neev.supplier WHERE supplierid in ";
										$query2.="('".implode("','", array_values($_POST['supp']))."')";
											try {  
												$res = mysql_query($query2);
												if($res === FALSE) { 
													die(mysql_error()); // TODO: better error handling
												}
											} 
											catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
									}
									else {
											echo '<script type="text/javascript">alert("Please select entries to Remove.")</script>';
									}
									echo '<meta http-equiv="refresh" content="0">';
								}
								
							?>
						
						
								<div id="add_supplier" class="modal fade">
								
								
									<form action="" method="post" target="hiddenFrame">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">Add supplier</h4>
											</div>
											<div class="modal-body">
												Supplier name: </br> 
												<input type="text" name="supplier_name" value="" id="supplier_name_id" required />
												</br> </br>
												Supplier address: </br> 
												<input type="text" name="supplier_address" value="" id="supplier_address_id"required />
												</br> </br>
												 City: </br> 
												<input type="text" name="supplier_city" value="" id="supplier_city_id" required />
												</br> </br>
												Contact: </br> 
												<input type="tel" name="supplier_contact" value="" id="supplier_contact_id" required/>
												</br> </br>											
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-default" data-dismiss="modal" value="Cancel" />
												<input type="submit" id="btnVal" class="btn btn-default btn-primary" name="add_supplier" value="Add" onclick="return ValidateMobNumber('supplier_contact_id','supplier_name_id','supplier_address_id','supplier_city_id')"  />
											</div>
										</div>
									</div>
									</form>
									<?php
											if(!empty($_POST['add_supplier'])){
												$query1 = "SELECT suppliername FROM neev.supplier WHERE contact='".$_POST['supplier_contact']."'";
												try {  
													$res = mysql_query($query1);
													if($res === FALSE) { 
														die(mysql_error()); // TODO: better error handling
													}
												} 
												catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
												if (mysql_num_rows($res) > 0 ) {
													echo "Supplier exists";	
												} else {
													$query2 = "INSERT INTO neev.supplier (suppliername, street, city, contact) VALUES ('".$_POST['supplier_name']."','".$_POST['supplier_address']."','".$_POST['supplier_city']."',".$_POST['supplier_contact'].")" ;
													try {  
														$res = mysql_query($query2);
														if($res === FALSE) { 
															die(mysql_error()); // TODO: better error handling
														}
													} 
													catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
												}
												echo '<meta http-equiv="refresh" content="0">';
											}
										?>
								</div>
								
								
								<div id="update_supplier" class="modal fade" >
									<form action="" method="post" method="post" target="hiddenFrame">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">Update supplier</h4>
											</div>
											<div class="modal-body">
												Supplier name: </br> 
													<select name="supplier_name" value="">
													<?php
														$query = "SELECT suppliername FROM neev.supplier";
														try {
															$res = mysql_query($query);
															if($res === FALSE) { 
																die(mysql_error()); // TODO: better error handling
															}
														}	
														catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
														if (mysql_num_rows($res) > 0 ) {
															while($row = mysql_fetch_array($res)) { ?>
																<option><?php echo $row['suppliername']; ?></option>
															<?php 
															}	
														}	
													?>
												 </select>
												</br> </br>
												Supplier address: </br> 
												<input type="text" name="supplier_address" id="supplier_address_id1" value="" required />
												</br> </br>
												 City: </br> 
												<input type="text" name="supplier_city" id="supplier_city_id1"value="" required />
												</br> </br>
												Contact: </br> 
												<input type="text" name="supplier_contact" value="" id="supplier_contact_id1"required />
												</br> </br>											
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-default" data-dismiss="modal" value="Cancel" />
												<input type="submit" class="btn btn-default btn-primary" name="update_supplier" value="Update" onclick="return ValidateMobNumber('supplier_contact_id1','supplier_address_id1','supplier_city_id1')" />
											</div>
										</div>
									</div>
									</form>
									<?php
											if(!empty($_POST['update_supplier'])){
												$query1 = "SELECT supplierid FROM neev.supplier WHERE suppliername='".$_POST['supplier_name']."'";
												try {  
													$res = mysql_query($query1);
													if($res === FALSE) { 
														die(mysql_error()); // TODO: better error handling
													}
												} 
												catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
												if (mysql_num_rows($res) == 1 ) {
													$row = mysql_fetch_array($res);
													$query2 = "UPDATE neev.supplier SET street='"
													.$_POST['supplier_address'].
													"',city='"
													.$_POST['supplier_city'].
													"',contact='"
													.$_POST['supplier_contact'].
													"' WHERE supplierid=".$row['supplierid'];
													
													try {  
														$res = mysql_query($query2);
														if($res === FALSE) { 
															die(mysql_error()); // TODO: better error handling
														}
													} 
													catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
												}
												echo '<meta http-equiv="refresh" content="0">';
											}
										?>
								</div>
								
						
	
								</div>

						
                  </div><!-- /.supplier-pane -->
				  
                  <div class="tab-pane" id="update" style="width: 80%; position: absolute" > <!-- /.update-pane -->
					<div class="panel panel-default templatemo-content-widget white-bg">
							<div class="panel-heading"><h2 class="text-uppercase">Update Inventory</h2> </div>
							</br>
							<div class="panel-group" id="accordion">
							<div class="panel panel-default templatemo-content-widget white-bg">
								<h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#update_raw" class="collapsed">Raw Material</a>
                                </h4>   
                                    <div id="update_raw" class="panel-collapse active in">
                                        <div class="panel-body">
											<form action="" method="post">
											<table class="table">	
											<tbody>
											<tr>
											 <td>Date: </td> 
											<td><input type="date" name="date" value="" required/></td>
											</tr>
											<tr></tr>
											<tr>
											 <td>Raw material: </td> 
											 <td><select name="raw" value="">
													<?php
														$query = "SELECT materialname FROM neev.rawmaterial";
														try {
															$res = mysql_query($query);
															if($res === FALSE) { 
																die(mysql_error()); // TODO: better error handling
															}
														}	
														catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
														if (mysql_num_rows($res) > 0 ) {
															while($row = mysql_fetch_array($res)) { ?>
																<option><?php echo $row['materialname']; ?></option>
															<?php 
															}	
														}	
													?>
												 </select></td>
											</tr>
											<tr></tr>
											<tr>
											<td>Quantity: </td> 
											<td><input type="number" name="quantity" value="" onkeypress="return isNumberKey(event)" required /></td>
											</tr>
											<tr></tr>
											<tr>
											<td>Cost per item: </td> 
											<td><input type="number" name="cost" value="" onkeypress="return isNumberKey(event)" required /></td>
											</tr>
											<tr></tr>
											<tr>
											<td>Supplier: </td> 
											<td><select name="supplier_name" value="">
													<?php
														$query = "SELECT suppliername FROM neev.supplier";
														try {
															$res = mysql_query($query);
															if($res === FALSE) { 
																die(mysql_error()); // TODO: better error handling
															}
														}	
														catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
														if (mysql_num_rows($res) > 0 ) {
															while($row = mysql_fetch_array($res)) { ?>
																<option><?php echo $row['suppliername']; ?></option>
															<?php 
															}	
														}	
													?>
												</select></td>
											</tr>
											<tr></tr>
											</tbody>
											</table>
											</br> </br>
											<input type="submit" class="btn btn-default"  value="Cancel" />
											<input type="submit" class="btn btn-default btn-primary" name="update_raw" value="Update" />
											</form>
											
											
											<?php
											if(!empty($_POST['update_raw'])){
												$query1 = "SELECT materialid,quantity FROM neev.rawmaterial WHERE materialname='".$_POST['raw']."'"; 
												
												try {  
													$res = mysql_query($query1);
													if($res === FALSE) { 
														die(mysql_error()); // TODO: better error handling
													}
												} 
												catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
												if (mysql_num_rows($res) == 1 ) {
													$row = mysql_fetch_array($res);
													
													$query1 = "SELECT supplierid FROM neev.supplier WHERE suppliername='".$_POST['supplier_name']."'"; 
													
													try {  
														$res = mysql_query($query1);
														if($res === FALSE) { 
															die(mysql_error()); // TODO: better error handling
														}
													}
													catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
													if (mysql_num_rows($res) == 1 ) {
														$row1 = mysql_fetch_array($res);
													
														$query1 = "INSERT INTO neev.rawmaterialorder (supplierid, date, materialid, quantity) VALUES (".$row1['supplierid'].",'".$_POST['date']."',".$row['materialid'].",".$_POST['quantity'].")";
														
														try {  
															$res = mysql_query($query1);
														 
															if($res === FALSE) { 
																die(mysql_error()); // TODO: better error handling
															}
														} 
														catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
													
														$quant = $_POST['quantity'] + $row['quantity'];
														$query2 = "UPDATE neev.rawmaterial SET quantity=".$quant.
														",cost=".$_POST['cost'].
														" WHERE materialid=".$row['materialid'];
														" WHERE materialid=".$row['materialid'];
												
															//echo '<script type="text/javascript">alert("' . $query2 . '")</script>';
												
														try {  
															$res = mysql_query($query2);
															if($res === FALSE) { 
																die(mysql_error()); // TODO: better error handling
															} else {
																echo '<script type="text/javascript">alert("Raw Material Entry Added")</script>';
															}
														} 
														catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
													}
												}
												echo '<meta http-equiv="refresh" content="0">';
											}
										  ?>
											
                                        </div>
                                    </div>
								</div>
								</br>
							<div class="panel panel-default templatemo-content-widget white-bg">
                             <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#update_product" class="collapsed">Product</a>
                                </h4>   
                                    <div id="update_product" class="panel-collapse collapse">
                                        <div class="panel-body">
											<form action="" method="post">
											<table class="table">	
											<tr>
											 <td>Date: </td> 
											<td><input type="date" name="date" value="" required/></td>
											</tr>
											<tr></tr>
											<tr>
											 <td>Product: </td> 
											 <td><select name="product" value="">
													<?php
														$query = "SELECT type FROM neev.product";
														try {
															$res = mysql_query($query);
															if($res === FALSE) { 
																die(mysql_error()); // TODO: better error handling
															}
														}	
														catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
														if (mysql_num_rows($res) > 0 ) {
															while($row = mysql_fetch_array($res)) { ?>
																<option><?php echo $row['type']; ?></option>
															<?php 
															}	
														}	
													?>
												 </select></td>
											</tr>
											<tr></tr>
											<tr>
											<td>Quantity: </td> 
											<td><input type="text" name="quantity" value="" onkeypress="return isNumberKey(event)" required /></td>
											</tr>
											<tr></tr>
											<tr>
											<td>Production price: </td> 
											<td><input type="text" name="pcost" value="" onkeypress="return isNumberKey(event)" required /></td>
											</tr>
											<tr></tr>
											<tr>
											<td>Selling price: </td> 
											<td><input type="text" name="scost" value="" onkeypress="return isNumberKey(event)" required /></td>
											</tr>
											<tr></tr>
											</table>
											</br> </br>
											<input type="submit" class="btn btn-default" data-dismiss="modal" value="Cancel" />
											<input type="submit" class="btn btn-default btn-primary" name="update_product" value="Update" />
											
											
											</form>
											
											<?php
											if(!empty($_POST['update_product'])) {
											
												$query1 = "SELECT pid,quantity FROM neev.product WHERE type='".$_POST['product']."'"; 
												
												try {  
													$res = mysql_query($query1);
													if($res === FALSE) { 
														die(mysql_error()); // TODO: better error handling
													}
												} 
												catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
												if (mysql_num_rows($res) == 1 ) {
							
													$row = mysql_fetch_array($res);
													
													$query4 = "INSERT INTO neev.productinv (date, pid, quantity) VALUES ('".$_POST['date']."',".$row['pid'].",".$_POST['quantity'].")";
												
													try {  
														$res = mysql_query($query4); 
														if($res === FALSE) { 
															die(mysql_error()); // TODO: better error handling
														} else {
															echo '<script type="text/javascript">alert("Product inventory updated successfully.")</script>';
														}
													
													} 
													catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

													$quant = $row['quantity'] + $_POST['quantity'];
													$query2 = "UPDATE neev.product SET date='".$_POST['date'].
													"',quantity=".$quant.
													",prodprice=".$_POST['pcost'].
													",sellprice=".$_POST['scost'].
													" WHERE pid=".$row['pid'];
													//echo '<script type="text/javascript">alert("' . $query2 . '")</script>';
													try {  
														$res = mysql_query($query2); 
														if($res === FALSE) { 
															die(mysql_error()); // TODO: better error handling
														}
													} 
													catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
												}
												echo '<meta http-equiv="refresh" content="0">';
											}
										  ?>
											
                                        </div>
                                    </div>
									</div>
								</br>

						</div>
						</div>
                  </div><!-- /.update-pane -->

				  
                </div><!-- /.tab-content -->
      </div>
    </div>
    
    <!-- JS -->
    <script src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
	<script src="js/bootstrap.min.js"></script> 
    <script src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <script src="https://www.google.com/jsapi"></script> <!-- Google Chart -->
    <script>
      /* Google Chart 
      -------------------------------------------------------------------*/
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart); 
      
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

          // Create the data table.
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Topping');
          data.addColumn('number', 'Slices');
          data.addRows([
            ['Mushrooms', 3],
            ['Onions', 1],
            ['Olives', 1],
            ['Zucchini', 1],
            ['Pepperoni', 2]
          ]);

          // Set chart options
          var options = {'title':'How Much Pizza I Ate Last Night'};

          // Instantiate and draw our chart, passing in some options.
          var pieChart = new google.visualization.PieChart(document.getElementById('pie_chart_div'));
          pieChart.draw(data, options);

          var barChart = new google.visualization.BarChart(document.getElementById('bar_chart_div'));
          barChart.draw(data, options);
      }

      $(document).ready(function(){
        if($.browser.mozilla) {
          //refresh page on browser resize
          // http://www.sitepoint.com/jquery-refresh-page-browser-resize/
          $(window).bind('resize', function(e)
          {
            if (window.RT) clearTimeout(window.RT);
            window.RT = setTimeout(function()
            {
              this.location.reload(false); /* false to get page from cache */
            }, 200);
          });      
        } else {
          $(window).resize(function(){
            drawChart();
          });  
        }   
      });
      
    </script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->

  </body>
</html>