<!DOCTYPE html>
<html lang="en">
	<?php
		require("config.php"); 
		$submitted_username = '';    
	?>
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
	<style type="text/css">
		body { background-color: #ffffff; }
	</style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	
	  <!-- JS -->
    <script src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <script src="https://www.google.com/jsapi"></script> <!-- Google Chart -->
	<script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
	<script type='text/javascript'>
			function refreshCaptcha(){
				var img = document.images['captchaimg'];
				img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
			}
		</script>
	
  </head>
  <body>  
    
        <div class="templatemo-top-nav-container">
          <div class="row">
            
              
				<table>
				<tr>
				<td><img src="images/neev_logo.jpg" alt="Profile Photo" class="img-responsive"> </td>
                
                <td valign="center-right" style="font-size: 30px;">
				<div class="container">
				<button type="button" class="btn btn-info btn-lg pull-right" style="color: #0F5606; float: right" data-toggle="modal" data-target="#login">Login</button>
				<button type="button" class="btn btn-info btn-lg pull-right" style="color: #0F5606; float: right" data-toggle="modal" data-target="#register">Register</button>
				  <!-- Modal -->
				  <div class="modal fade" id="login" role="dialog">
				  <form action="" method="post">
					<div class="modal-dialog modal-sm">
					  <!-- Modal content-->
					  <div class="modal-content">
							<div class="modal-body" style="font-size: 20px;">
							 Id: </br> 
							<input type="text" name="id" value="" />
							</br> </br>
							  Password: </br>
							<input type="password" name="password" value="" />  </br></br>
							<input type="submit" class="btn btn-default" name="login" value="Login" />
							</div>
					  </div>
					</div>
					</form>
				  </div>  
				</div>
				
				<!-- Modal -->
				  <div class="modal fade" id="register" role="dialog">
				  <form action="" method="post">
					<div class="modal-dialog modal-lg">
					  <!-- Modal content-->
					  <div class="modal-content">
							<div class="modal-body" style="font-size: 20px;">
								<table width="400" align="center" cellpadding="5" cellspacing="1">
									<tr>
									<td valign="top">Name: </td>
									<td><input type="text" name="name" value="" /><br /> <br /></td>
									
									</tr>
									<tr>
									<td valign="top">Email-id: </td>
									<td ><input type="email" name="email" value="" /><br /><br /> </td>
									</tr>
									<tr>
									<td valign="top">Mobile: </td>
									<td><input type="text" name="mobile" value="" /> <br /><br /></td>
									</tr>
									<tr>
									<td valign="top">Password: </td>
									<td><input type="password" name="password" value="" /> <br /><br /></td>
									</tr>
									<tr>
									<td valign="top">Confirm Password: </td>
									<td><input type="password" name="repassword" value="" /> <br /><br /></td>
									</tr>
									<tr>
										  <td valign="top"> Validation code:</td>
										  <td><img src="captcha.php?rand=<?php echo rand();?>" id='captchaimg'><br />
											<label for='message'>Enter the code above here :</label>
											<input id="captcha_code" name="captcha_code" type="text">
											<br/>
											Click <a href='javascript: refreshCaptcha();'>here</a> to refresh.</td>
									</tr>
									 </table>
									<input type="submit" class="btn btn-danger square-btn-adjust" name="register" value="Register" />
							</div>
					  </div>
					</div>
					</form>
				  </div>  
				</div>

			  </td>
				</tr>
				</table>
            		<?php
						if(!empty($_POST['login'])){ 
							$query = " 
								SELECT 
									Id, 
									password
								FROM register 
								WHERE 
									Id = :id
							"; 
							$query_params = array( 
								':id' => $_POST['id'] 
							); 
							
							try{ 
								$stmt = $db->prepare($query); 
								$result = $stmt->execute($query_params); 
							} 
							catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
							$login_ok = false; 
							$row = $stmt->fetch(); 
							if($row){ 
								if($_POST['password'] === $row['password']){
									$login_ok = true;
								} 
							} 

							if($login_ok){ 	
								unset($row['password']); 
								$_SESSION['id'] = $row['Id'];
								echo("<script>location.href = 'home1.php';</script>");
								die("Redirecting to: home1.php"); 
							} 
							else{ 
								print("Login Failed."); 
								$submitted_username = htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8'); 
							} 
						}
				?>
			
			<img src="images/ngo1.jpg">
			  
			
			

			
			<br />
			<br />
			<p style="font-family:Brush Script MT; font-size: 45px; color: #0F5606;">“Love is not patronizing and charity isn't about pity, it is about love. Charity and love are the same -- with charity you give love, so don't just give money but reach out your hand instead.”
			</p>
			<p style="font-family:Brush Script MT; font-size: 45px; color: #0F5606;">- Mother Teresa</p>
	
          </div>
        </div>

  </body>
</html>