<?php
include('../control.php');	


if(isset($_GET['u']) && (isset($_GET['e']))){
$user_Id = $_GET['u'];
$user_email = $_GET['e'];
}
else{
$user_email =NULL;
$user_Id =NULL;
	
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DRS|Login</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![
		endif]-->
	
		<style>
.brandlogo {
  border-radius: 50%;
  position: center;
  background-color: #1B4F72;
  min-width: 50px;
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
  z-index: 2;
}
	
.error {
	width: 100%; 
	margin: 0px auto; 
	padding: 10px; 
	border: 1px solid #a94442; 
	color: #a94442; 
	background: #f2dede; 
	border-radius: 5px; 
	text-align: left;
}

.success{
	width: 100%; 
	margin: 0px auto; 
	padding: 10px; 
	border: 1px solid green; 
	color: green; 
	background: #f2f2f2; 
	border-radius: 5px; 
	text-align: left;
}



</style>
		
    </head>
    <body>

<?php
// define variables and set to empty values

$usernameErr = $passwordErr ="";
$username= $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "<small>Username is required</small>";
  } else {
    $username = test_input($_POST["username"]);
  }
  
  
   if (empty($_POST["password"])) {
    $passwordErr = "<small>password is required</small>";
  } else {
    $password = test_input($_POST["password"]);
  }

}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="container">
			<center><img  class="brandlogo" src="../images/ditlogo.jpg" alt="logo" width="auto" height="150px"></center>
	
	
	<div class="row">
		<div class="col-md-6  col-md-offset-3">
			<div class="panel panel-primary">
										<div class="panel-heading" align="center">
											<b>DIT RENTALS SOLUTION [DRS]</b>
										</div>
										<div class="panel-body">
											<form method="post"  action="" >
												
													
															<h6>
															<?php echo display_error(); ?>
															<?php echo comments_sent_report(); ?>
															</h6>									
													
												<div class="row">
														<div class="col-md-12 col-md-offset-0">
															<div class="form-group">
																<label>Please input the correct username inorder to reset your pasword</label>
																<input class="form-control"  type="email"  placeholder="your email" name="email"  value="<?php echo $user_email ; ?>">
															</div>
														</div>
												</div>
												<div class="row">
														<div class="col-md-12 col-md-offset-0">
															<div class="form-group">
															<input type="hidden" class="form-control"  name="userID" value="<?php echo $user_Id ; ?>" >
																<button type="submit" name="password_reset_request" class="btn btn-primary btn-lg btn-block">SUBMIT</button>
															</div>
														</div>
												</div>
											</form>
										</div>
				
                  
										 <div class="panel-footer" align="center">
														<b>Copyright &copy; DRS 2020-<?php echo date("Y"); ?></b>
														
										</div>
                                <!-- /.panel-body -->
		</div>
                            
                            <!-- /.panel -->
		</div>     
    </div>  
</div>



        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

    </body>
</html>