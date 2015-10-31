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
			    <li><a href="#inv" data-toggle="tab">Rawmaterial Records</a></li>
                <li><a href="#sales" data-toggle="tab">Sales Records</a></li>
                <li><a href="#emp" data-toggle="tab">Product Records</a></li>
				</ul> 
            </nav> 
          </div>
        </div>

		<!-- Modal HTML -->
	
			<div class="tab-content" >
                  <div class="tab-pane active in" id="inv">   <!-- /.inv-pane -->
                     <div class="templatemo-content-container">
						<form action="" method="post">
						
						<b>Get Raw Material graph:</b>
						<br>
						<br>
						
						Select Raw material: 
						&nbsp; &nbsp; <select name="raw" value="">
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
						</select>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						<input type="submit" class="btn btn-default btn-primary" name="get_graph" value="Submit" />
						<br /><br /><br />
						</form>
						
						<?php
							if(!empty($_POST['get_graph'])){
								$query1 = "SELECT materialid FROM neev.rawmaterial WHERE materialname='".$_POST['raw']."'"; 
												
									try {  
										$res = mysql_query($query1);
										if($res === FALSE) { 
											die(mysql_error()); // TODO: better error handling
										}
									} 
									catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
									if (mysql_num_rows($res) == 1 ) {
										$row = mysql_fetch_array($res);
										$query1 = "SELECT supplierid,quantity FROM neev.rawmaterialorder WHERE materialid=".$row['materialid']; 
													
										try {  
											$res = mysql_query($query1);
											if($res === FALSE) { 
												die(mysql_error()); // TODO: better error handling
											}
										}
										catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
									
								
										include "libchart/libchart/classes/libchart.php";
										$chart = new VerticalBarChart(500, 250);

										
										if (mysql_num_rows($res) > 0 ) {
											$dataSet = new XYDataSet();
											while($row1 = mysql_fetch_array($res)) {
												$query1 = "SELECT suppliername FROM neev.supplier WHERE supplierid=".$row1['supplierid']; 
													
												try {  
													$res2 = mysql_query($query1);
													if($res2 === FALSE) { 
														die(mysql_error()); // TODO: better error handling
													}
												}
												catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
												$row2 = mysql_fetch_array($res2);
												$dataSet->addPoint(new Point($row2['suppliername'], $row1['quantity']));
											}
										
											$chart->setDataSet($dataSet);
								
											$chart->setTitle("Raw material". $_POST['raw']);
											$chart->render("generated/raw1.png"); ?>
											<img alt="Vertical bars chart" src="generated/raw1.png" style="border: 1px solid gray;"/>
											<br /><br /><br /><br />
										<?php }
									}
							}
						?>
				
				
				
				
				
				<form action="" method="post">
						<b>Get Raw material Table:</b>

							<table class="table">	
											<tr>
											 <td>From Date: </td> 
											<td><input type="date" name="to_date" value="" required/></td>
											</tr>
											<tr></tr>
											<tr>
											<td>To Date: </td> 
											<td><input type="date" name="from_date" value="" required/></td>
											</tr>
							</table>	


							Raw material: 
								&nbsp; &nbsp; <select name="raw1" value="">
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
							</select>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
							<input type="submit" class="btn btn-default btn-primary" name="get_raw" value="Submit" />
							<br /><br /><br />
				
			


		</form>
				<?php
					if(!empty($_POST['get_raw'])){
							$query1 = "SELECT materialid FROM neev.rawmaterial WHERE materialname='".$_POST['raw1']."'";	
								try {  
											$res = mysql_query($query1);
											if($res === FALSE) { 
												die(mysql_error()); // TODO: better error handling
											}
									} 
								catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
									
								if (mysql_num_rows($res) > 0 ) {
										
									$row = mysql_fetch_array($res);
										
								}
								$query2 = "SELECT * FROM neev.rawmaterialorder WHERE (date BETWEEN '".$_POST['to_date']."' AND '".$_POST['from_date']."') AND (materialid='".$row['materialid']."')";
								
								try {  
													$res2 = mysql_query($query2);
													if($res2 === FALSE) { 
														die(mysql_error()); // TODO: better error handling
													}
								} 
								catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
		
								
							if (mysql_num_rows($res2) > 0 ) { ?>
								
								<table class="table table-striped table-bordered">
									<thead>
									  <tr>
										<td>Date</td>
										<td>Quantity</td>
							
									  </tr>
									</thead>
									
									<?php		while($row = mysql_fetch_array($res2)) {?>
											
									<tbody>
												<tr>
												<td><?php echo $row['date']; ?></td>
												<td><?php echo $row['quantity']; ?></td>
												</tr>
									<?php
											} ?>
									</tbody>
								</table>
							<?php		
							}											
						}
				?>		
				
				
				
					
					</div>
				   </div ><!-- /.inv-pane -->
				      
	
                 <div class="tab-pane"  id="sales">   <!-- sales pane-->
				  <div class="templatemo-content-container">

						<?php
										$query1 = "SELECT pid, SUM(qty) as s FROM neev.order group by pid"; 
													
										try {  
											$res = mysql_query($query1);
											if($res === FALSE) { 
												die(mysql_error()); // TODO: better error handling
											}
										}
										catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
									
								
										include "libchart/libchart/classes/libchart.php";
										$chart = new VerticalBarChart(500, 250);

										
										if (mysql_num_rows($res) > 0 ) {
											$dataSet = new XYDataSet();
											while($row1 = mysql_fetch_array($res)) {
												$query1 = "SELECT type FROM neev.product WHERE pid=".$row1['pid']; 
													
												try {  
													$res2 = mysql_query($query1);
													if($res2 === FALSE) { 
														die(mysql_error()); // TODO: better error handling
													}
												}
												catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
												$row2 = mysql_fetch_array($res2);
												$dataSet->addPoint(new Point($row2['type'], $row1['s']));
											}
										
											$chart->setDataSet($dataSet);
								
											$chart->setTitle("Productwise sale");
											$chart->render("generated/prod1.png"); ?>
											<img alt="Vertical bars chart" src="generated/prod1.png" style="border: 1px solid gray;"/>
										<?php }
						?>
					</div><!-- end sales report -->
				</div><!-- /.sales-pane -->
				
				<div class="tab-pane"  id="emp">   <!-- emp pane-->
				<div class="templatemo-content-container">
				
			
				<form action="" method="post" >
							<b> Get Product Table <b/>:
							&nbsp; &nbsp;
							<br/>
							<br/>
							Select Date Range:
							<table class="table">	
											<tr>
											 <td>From Date: </td> 
											<td><input type="date" name="to_date1" value="" required/></td>
											</tr>
											<tr></tr>
											<tr>
											<td>To Date: </td> 
											<td><input type="date" name="from_date2" value="" required/></td>
											</tr>
							</table>	

							Select Product: 
								&nbsp; &nbsp; <select name="product" value="">
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
												 </select>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
							<input type="submit" class="btn btn-default btn-primary" name="get_product" value="Submit" />
							<br /><br /><br />				

		</form>
				<?php
					if(!empty($_POST['get_product'])){
							$query1 = "SELECT pid FROM neev.product WHERE type='".$_POST['product']."'";	
								try {  
											$res = mysql_query($query1);
											if($res === FALSE) { 
												die(mysql_error()); // TODO: better error handling
											}
									} 
								catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
									
								if (mysql_num_rows($res) > 0 ) {
										
									$row = mysql_fetch_array($res);
										
								}
								$query2 = "SELECT * FROM neev.productinv WHERE (date BETWEEN '".$_POST['to_date1']."' AND '".$_POST['from_date2']."') AND (pid='".$row['pid']."')";
								
								try {  
													$res2 = mysql_query($query2);
													if($res2 === FALSE) { 
														die(mysql_error()); // TODO: better error handling
													}
								} 
								catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
		
								
							if (mysql_num_rows($res2) > 0 ) { ?>
								
								<table class="table table-striped table-bordered">
									<thead>
									  <tr>
										<td>Date</td>
										<td>Quantity</td>
							
									  </tr>
									</thead>
									
									<?php		while($row = mysql_fetch_array($res2)) {?>
											
									<tbody>
												<tr>
												<td><?php echo $row['date']; ?></td>
												<td><?php echo $row['quantity']; ?></td>
												</tr>
									<?php
											} ?>
									</tbody>
								</table>
							<?php		
							}											
						}
				?>	
			</div>
				</div><!-- /.emp-pane -->
				
		</div>
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