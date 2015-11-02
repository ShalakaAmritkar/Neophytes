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
            <li><a href="inv1.php"><i class="fa fa-database fa-fw"></i>Inventory</a></li>
            <li><a href="sales.php" class="active"><i class="fa fa-shopping-cart fa-fw"></i>Sales</a></li>
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
			    <li><a href="#place" data-toggle="tab">Place order</a></li>
                <li><a href="#return" data-toggle="tab">Return order</a></li>
                <li><a href="#custdetails" data-toggle="tab">Customer details</a></li>
				</ul> 
            </nav> 
          </div>
        </div>

		<!-- Modal HTML -->
			<div class="tab-content" >
			
				<div class="tab-pane active in" id="place" style="width: 80%; position: absolute" > <!-- /.place-pane -->
					<div class="panel panel-default templatemo-content-widget white-bg">
						<form action="" method="post">
							<input type="number" name="contactcust" placeholder="Enter Customer contact"  onkeypress="return isNumberKey(event);" required /> &nbsp;&nbsp;&nbsp;
							<input type="submit" name="submitcust" value="Search">
							<br /><br />
						</form>
					</div>
						<?php
							if(isset($_POST['submitcust']))
							{
								if(!isset($_SESSION)){
									session_start();
								}
								$_SESSION["custid"] = $_POST['contactcust'];
								if(!isset($_SESSION['billno']))
								{
									$query = "SELECT MAX(billno) FROM neev.bill";
										try {  
										$res = mysql_query($query);
										if($res === FALSE) { 
											die(mysql_error()); // TODO: better error handling
										}
									} 
									catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
									
									if (mysql_num_rows($res) == 1) {
										$bill = mysql_fetch_array($res);
										$billno = $bill[0];
										$billno++ ;
									} else {
										$billno = 1;
									}
									$_SESSION["billno"] = $billno;
								}
								//displaying customer details
								if(isset($_SESSION['custid']) AND isset($_SESSION['billno']))
{
								$query1 = "SELECT * FROM neev.customer WHERE custcontact='".$_SESSION['custid']."'"; 
												
									try {  
										$res = mysql_query($query1);
										if($res === FALSE) { 
											die(mysql_error()); // TODO: better error handling
										}
									} 
									catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 

									if (mysql_num_rows($res) > 0 ) 
									{
										$row = mysql_fetch_array($res); ?>
										<div class="panel panel-default templatemo-content-widget white-bg">
											<?php 
											$uname=$row['custname'];
											echo $row['custname']; ?> 
											<div class="pull-right"> <?php echo "Billno :".$_SESSION['billno']; ?> </div> <br />
											<?php echo $row['street']; ?> 
											<div class="pull-right"> <?php echo "Date :" . date("Y-m-d") . "<br>"; ?> </div> <br />
											<?php echo $row['city']; ?> <br /><br /><br />
											
											<!--Insert into BILL-->
											<?php
											try {
												$dt = date("Y-m-d");
												$b = $_SESSION['billno'];
												$custid = $_SESSION['custid'];
											$res = mysql_query("INSERT INTO neev.bill(billno,billdate,custid) VALUES('$b','$dt','$custid')");
												if($res === FALSE) 
												{ 
													die(mysql_error()); // TODO: better error handling
													}
												}	
											catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
											
									}
								}
									?>
											</div>
									<?php
									
							}
										?>
										<!--Add to cart -->
										<div class="panel panel-default templatemo-content-widget white-bg">
											<form method="POST" action="">
											<select name="productsdropdown" value="">
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
											</select>&nbsp; &nbsp;
											<input type="number" name="productqty" placeholder="Add Quantity" onkeypress="return isNumberKey(event);" required />
											<input type="submit" name="addproduct" value="Add Product">
											
										</div>
									</form>
									<?php
									if(isset($_POST['addproduct']))
									{
									$type = $_POST["productsdropdown"];
									$qty = $_POST["productqty"];
									
	
									$sth ="SELECT pid FROM neev.product WHERE type='$type' limit 1";
								
										try {
											$res=mysql_query($sth);
											$res= mysql_fetch_object($res);
											$result = $res->pid;
											
											$b = $_SESSION['billno'];
											
											$addToCart = mysql_query("INSERT INTO neev.order(pid,qty,bill_no) VALUES('$result','$qty','$b')");
											if($res === FALSE OR $addToCart === FALSE) 
											{ 
												die(mysql_error()); // TODO: better error handling
											}
										
											
										}	
										catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
										
						
									}
							
						?>
						
					
						<!-- order part-->
						
						<div class="panel panel-default templatemo-content-widget white-bg">
							<div class="panel-heading"><h2 class="text-uppercase"><?php if(isset($uname)){echo $uname;}?><br><?php if(isset($_SESSION['billno'])){echo "Bill No.:";echo $_SESSION['billno'];}?><center>My Cart</center></h2></div>
                    		<form action="" method="post">
								 <table class="table table-striped table-bordered">
									<thead>
									  <tr>
										<td></td>
										<td>Product</td>
										<td>Quantity</td>
										<td>Price</td>
										<td>Total</td>
									  </tr>
									</thead>
									<tbody>
									
									<?php
									if(isset($_SESSION['billno']))
									{
										$query = "SELECT * FROM neev.order,neev.product WHERE order.bill_no=".$_SESSION['billno']." AND neev.order.pid=neev.product.pid";
										try {
											$res = mysql_query($query);
											if($res === FALSE) { 
												die(mysql_error()); // TODO: better error handling
											}
										}	
										catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
										if (mysql_num_rows($res) > 0 ) {
											$total = 0;
											while($row = mysql_fetch_array($res)) 
											{?>
												<tr>
												
												<td><input type="checkbox" name="cart[]" value="<?php echo $row['pid']; ?>" style="align: center"/></td>
												<td><?php echo $row['type']; ?></td>
												<td><?php echo $row['qty']; ?></td>
												<td><?php echo $row['sellprice']; ?></td>
												<?php $tot = $row['qty']*$row['sellprice'];
														$total += $tot;
														?>
												<td><?php echo $row['qty']*$row['sellprice']; ?></td>
												</tr>
										<?php }
										
										}
									}
									?>                  
									</tbody>
								  </table>    
							</br> </br>
							
							
							
							<input type="submit" class="btn btn-default btn-primary" name="remove" value="Remove" />
						
						</form>
								
						</div>
							<?php
								if(!empty($_POST['remove'])){
									
									if (isset($_POST['cart'])) {
										$query2 = "DELETE FROM neev.order WHERE bill_no = ".$_SESSION['billno']." AND pid in ";
										$query2.="('".implode("','", array_values($_POST['cart']))."')";
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
								}
							?>
						
						
						<!--/.order part-->
						
						<!--Done button-->
						<form method="POST" action="" align="center">
						<input type="submit" class="btn btn-default btn-primary" name="done" value="Done" /> 
						</form>
						
							<?php
							if(isset($_POST['done']))
							{
								//insert total bill in bill table
							
											try { 
												if(isset($total)){
												$res = mysql_query("UPDATE neev.bill SET total='$total' WHERE billno=".$_SESSION['billno']."");
												if($res === FALSE) { 
													die(mysql_error()); // TODO: better error handling
												}
												}
											} 
											catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

								
								
								unset($_SESSION['custid']);
								unset($_SESSION['billno']);
								
								

								session_destroy();
							}
							
						?>	
						<!--/.Done Button-->
				</div>
			
			
						<!-- /.place-pane -->
				
				<div class="tab-pane" id="return" style="width: 80%; position: absolute" > <!-- /.return-pane -->
					<div class="panel panel-default templatemo-content-widget white-bg">
						<form action="" method="post">
							Search order:
							&nbsp; &nbsp;
							<input type="number" name="order" value="" onkeypress="return isNumberKey(event);" required />
							&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
							<input type="submit" class="btn btn-default btn-primary" name="search_order" value="Submit" />
						</form>
						<br /> <br />
						
						<?php
								if(!empty($_POST['search_order'])){ ?>
								<div class="panel-heading"><h2 class="text-uppercase">Order details</h2> </div>
								<form action="" method="post">
									<table class="table table-striped table-bordered">
										<thead>
										  <tr>
											<td></td>
											<td>Id</td>
											<td>Product</td>
											<td>Quantity</td>
										  </tr>
										</thead>
										<tbody>
										<?php
											$query = "SELECT pid,qty FROM neev.order WHERE bill_no=".$_POST['order']." AND cancel=0";
											
											try {
												$res = mysql_query($query);
												if($res === FALSE) { 
													//echo '<script type="text/javascript">alert("This is invalid bill number")</script>';
													die(mysql_error()); // TODO: better error handling
												}
											}	
											catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
											if (mysql_num_rows($res) > 0 ) {
												while($row = mysql_fetch_array($res)) {?>
													<tr>
													<td><input type="checkbox" name="order_ret[]" value="<?php echo $row['pid']; ?>" style="align: center"/></td>
													<td><?php echo $row['pid']; ?></td>
													<?php 
														$query = "SELECT type FROM neev.product WHERE pid=".$row['pid'];
														try {
															$res1 = mysql_query($query);
															if($res1 === FALSE) { 
																//echo '<script type="text/javascript">alert("This is invalid bill number")</script>';
																die(mysql_error()); // TODO: better error handling
															}
														}	
														catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
														if (mysql_num_rows($res1) > 0 ) {
															$row1 = mysql_fetch_array($res1);
														}
													?>
													<td><?php echo $row1['type']; ?></td>
													<td><?php echo $row['qty']; ?></td>
													</tr>
											<?php }
											}
											else {
												echo '<script type="text/javascript">alert("This is invalid bill number")</script>';
												//echo '<script type="text/javascript">alert("' . $query . '")</script>';
											}
										?>                  
										</tbody>
									    </table> 
										<br /><br />
										<input type="submit" class="btn btn-default btn-primary" name="remove" value="Remove" />
									</form>
								<?php } ?>
						
							
							<?php
								if(!empty($_POST['remove'])){
									if (isset($_POST['order_ret'])) {
										$query2 = "UPDATE neev.order SET cancel=TRUE WHERE pid in ";
										$query2.="('".implode("','", array_values($_POST['order_ret']))."')";
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

					</div>
				</div> <!-- /.return-pane -->

			    <div class="tab-pane" id="custdetails" style="width: 80%; position: absolute" > <!-- /.customer-pane -->
					<div class="panel panel-default templatemo-content-widget white-bg">
							<div class="panel-heading"><h2 class="text-uppercase">Customers</h2> </div>
                    		<form action="" method="post">
								 <table class="table table-striped table-bordered">
									<thead>
									  <tr>
										<td></td>
										<td>Name</td>
										<td>Address</td>
										<td>City</td>
										<td>Contact</td>
									  </tr>
									</thead>
									<tbody>
									<?php
										$query = "SELECT * FROM neev.customer";
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
												<td><input type="checkbox" name="cust[]" value="<?php echo $row['custcontact']; ?>" style="align: center"/></td>
												<td><?php echo $row['custname']; ?></td>
												<td><?php echo $row['street']; ?></td>
												<td><?php echo $row['city']; ?></td>
												<td><?php echo $row['custcontact']; ?></td>
												</tr>
										<?php }
										}
									?>                  
									</tbody>
								  </table>    
							</br> </br>
							<input type="button" class="btn square-btn-adjust btn-primary text-uppercase" name="add_customer" value="Add" data-toggle="modal" data-target="#add_customer"/>
							<input type="submit" class="btn btn-default btn-primary" name="remove_cust" value="Remove" />
						</form>
						
							<?php
								if(!empty($_POST['remove_cust'])){
									if (isset($_POST['cust'])) {
										$query2 = "DELETE FROM neev.customer WHERE custcontact in ";
										$query2.="('".implode("','", array_values($_POST['cust']))."')";
											try {  
												$res = mysql_query($query2);
												if($res === FALSE) { 
													die(mysql_error()); // TODO: better error handling
												}
											} 
											catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
									} else {
										echo '<script type="text/javascript">alert("Please select entries to Remove.")</script>';
									}
								echo '<meta http-equiv="refresh" content="0">';
							}
							?>
						
								<div id="add_customer" class="modal fade">
									<form action="" method="post">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">Add customer</h4>
											</div>
											<div class="modal-body">
												Customer name: </br> 
												<input type="text" id="cust_name_id" name="customer_name" value="" required />
												</br> </br>
												Customer address: </br> 
												<input type="text" id="cust_address_id" name="customer_address" value="" required />
												</br> </br>
												 City: </br> 
												<input type="text" id="cust_city_id" name="customer_city" value="" required />
												</br> </br>
												Contact: </br> 
												<input type="text" name="customer_contact" value="" id="cust_contact_id"  required/>
												</br> </br>											
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-default" data-dismiss="modal" value="Cancel" />
												<input type="submit" class="btn btn-default btn-primary" name="add_customer" value="Add" onclick="return ValidateMobNumber('cust_contact_id','cust_address_id','cust_city_id','cust_name_id')" />
											</div>
										</div>
									</div>
									</form>
									<?php
											if(!empty($_POST['add_customer'])){
												$query1 = "SELECT custname FROM neev.customer WHERE custcontact='".$_POST['customer_contact']."'";
												try {  
													$res = mysql_query($query1);
													if($res === FALSE) { 
														die(mysql_error()); // TODO: better error handling
													}
												} 
												catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
												if (mysql_num_rows($res) > 0 ) {
													echo "customer exists";	
												} else {
													$query2 = "INSERT INTO neev.customer (custname, street, city, custcontact) VALUES ('".$_POST['customer_name']."','".$_POST['customer_address']."','".$_POST['customer_city']."',".$_POST['customer_contact'].")" ;
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

				
                  </div><!-- /.customer-pane -->
			
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