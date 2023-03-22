<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'fms');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 
$comments_sent = array();
$comments_failed = array();
$logout_messages	= array();
$login_messages	= array();

class FarmRents{

public function getData($sqlQuery) {
		global $db;
		$result = mysqli_query($db, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}

	function numRows($query) {
		global $db;
		$result  = mysqli_query($db,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}		
	
public function getFarmDetails($farmID){
	global $db;
		$sql ="SELECT * FROM farms WHERE farmID= '$farmID' ";
		$result = mysqli_query($db, $sql);
		$farm = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $farm;
	}
	
	
public function getFarms($farmToken){
	global $db;
		$sql ="SELECT * FROM farms WHERE farmToken= '$farmToken' ";
		$result = mysqli_query($db, $sql);
		$farms = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $farms;
	}
	
	
	
public function getFarmData(){
	global $db;
		$sql ="SELECT * FROM farms WHERE status='renting'";
		return  $this->getData($sql);
	}

	
public function getBookings(){
	global $db;
		$sql ="SELECT * FROM bookings";
		$result = mysqli_query($db, $sql);
		$bookings = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $bookings;
	}
	
	
public function getTenantDetails($userID){
	global $db;
		$sql ="SELECT * FROM users WHERE userID= '$userID'";
		$result = mysqli_query($db, $sql);
		$tenant = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $tenant;
	}

public function getTenantData($userID){
	global $db;
		$sql ="SELECT * FROM bookings,invoice_items 
		WHERE bookings.bookingID = invoice_items.bookingID
		 AND bookings.userID= '$userID'
		";
		return  $this->getData($sql);
	}

public function getBlockDetails($blockID){
	global $db;
		$sql ="SELECT * FROM blocks WHERE blockID= '$blockID' ";
		$result = mysqli_query($db, $sql);
		$block = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $block;
	}
	
public function getBlocks($blockToken){
	global $db;
		$sql ="SELECT * FROM blocks WHERE blockToken= '$blockToken' ";
		$result = mysqli_query($db, $sql);
		$blocks = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $blocks;
	}
	
	

public function getBlockFarmDetails($farmID){
	global $db;
		$sql ="SELECT * FROM blocks WHERE farmID='$farmID' ";
		$result = mysqli_query($db, $sql);
		$blocks = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $blocks;
	}	
	
public function getBlockFarmData($farmID){
	global $db;
		$sql ="SELECT * FROM blocks WHERE farmID= '$farmID' ";
		return  $this->getData($sql);
	}
	
	
public function getBookingDetails($bookingID){
	global $db;
		$sql ="SELECT * FROM bookings WHERE bookingID= '$bookingID' ";
		$result = mysqli_query($db, $sql);
		$booking = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $booking;
	}
public function getBookingBlockDetails($blockID){
	global $db;
		$sql ="SELECT * FROM bookings WHERE blockID= '$blockID' ";
		$result = mysqli_query($db, $sql);
		$bookings = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $bookings;
	}
	
public function getInvoiceDetails($invoiceID){
	global $db;
		$sql ="SELECT * FROM invoice_items WHERE invoiceID= '$invoiceID'";
		$result = mysqli_query($db, $sql);
		$invoice = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $invoice;
	}
public function getInvoiceData($userID){
	global $db;
		$sql ="SELECT * FROM invoice_items WHERE userID= '$userID'";
		$result = mysqli_query($db, $sql);
		return  $this->getData($sql);
	}
	
public function getInvoiceDatas($bookingID){
	global $db;
		$sql ="SELECT * FROM invoice_items WHERE bookingID= '$bookingID'";
		$result = mysqli_query($db, $sql);
		return  $this->getData($sql);
	}
	
public function getMyInvoices($invoiceID,$userID ){
	global $db;
		$sql ="SELECT * FROM invoice_items WHERE invoiceID= '$invoiceID' and userID='$userID'";
		return  $this->getData($sql);
	}	

	public function getUserData($userID){
	global $db;
		$sql ="SELECT * FROM users WHERE userID= '$userID' ";
		$result = mysqli_query($db, $sql);
		$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $user;
	}
	
public function getMaxRent($farmID){
	global $db;
		$sql ="select MAX(rent) from blocks where farmID='$farmID'";
		$result = mysqli_query($db, $sql);
		$maxRent = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $maxRent;
	}
public function getMinRent($farmID){
	global $db;
		$sql ="select MIN(rent) from blocks where farmID='$farmID'";
		$result = mysqli_query($db, $sql);
		$minRent = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $minRent;
	}
	
public function getPaymentDetails($payID){
	global $db;
		$sql ="SELECT * FROM payments WHERE payID= '$payID' ";
		$result = mysqli_query($db, $sql);
		$payments = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $payments;
	}
	
public function getPaymentData($payID){
	global $db;
		$sql ="SELECT * FROM payments WHERE payID= '$payID' ";
		return  $this->getData($sql);
	}
	
	
	
public function getPaymentTenantDetails($userID){
	global $db;
		$sql ="SELECT * FROM payments WHERE userID= '$userID' ";
		$result = mysqli_query($db, $sql);
		$payments = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $payments;
	}
	
public function getPaymentTenantData($userID){
	global $db;
		$sql ="SELECT * FROM payments WHERE userID= '$userID' ";
		return  $this->getData($sql);
	}
	
public function getPayments($payID){
	global $db;
		$sql ="SELECT * FROM payments WHERE payID= '$payID' ";
		$result = mysqli_query($db, $sql);
		$payments = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $payments;
	}

public function getPaymentInvoiceData($invoiceID){
	global $db;
		$sql ="SELECT * FROM payments WHERE invoiceID= '$invoiceID' AND pay_status='received'";
		return  $this->getData($sql);
	}


}


// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);	
	
	session_start();
	$_SESSION['logout']  = "You are now logged Out";
	$logout_messages = $_SESSION['logout'];
	
	header("location: ../home/login.php");  
}


// call the register() function if register is clicked
if (isset($_POST['register'])) {
	register();
}


// call the user_booking() function if user_booking is clicked
if (isset($_POST['user_booking'])) {
	user_booking();
}

// call the login() function if register_btn is clicked
if (isset($_POST['login'])) {
	login();
}

// call the password_reset_request() function if password_reset_request is clicked
if (isset($_POST['password_reset_request'])) {
	password_reset_request();
}

// call the password_reset() function if password_reset is clicked
if (isset($_POST['password_reset'])) {
	password_reset();
}


if (isset($_POST['update_profile'])) {
	 update_profile();
	}
	
	
	
// call the add_farm() function if add_farm is clicked
if (isset($_POST['add_farm'])) {
	add_farm();
}


// call the add_block() function if add_block is clicked
if (isset($_POST['add_block'])) {
	add_block();
}


// call the book_block() function if book_block is clicked
if (isset($_POST['book_block'])) {
	book_block();
}


// call the add_payment() function if add_payment is clicked
if (isset($_POST['add_payment'])) {
	add_payment();
}

// call the add_payment_status() function if add_payment_status is clicked
if (isset($_POST['add_payment_status'])) {
	add_payment_status();
}

// call the add_tenant() function if add_tenant is clicked
if (isset($_POST['add_tenant'])) {
	add_tenant();
}

// call the send_comment() function if contact is clicked
if (isset($_POST['send_comment'])) {
	send_comment();
}


function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

function isLoggedOut()
{
	if (isset($_SESSION['logout'])) {
		return true;
	}else{
		return false;
	}
}

// ...
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

function isLandlord()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'landlord' ) {
		return true;
	}else{
		return false;
	}
}



function isTenant()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'tenant' ) {
		return true;
	}else{
		return false;
	}
}


// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors,$comments_sent,$comments_failed;


	// receive all input values from the form. 
    // Call the e() function defined below to escape form values
	$fname    =  e($_POST['fname']);
	$mname       =  e($_POST['mname']);
	$lname  =  e($_POST['lname']);
	$dob  =  e($_POST['dob']);
	$phone    =  e($_POST['phone']);
	$gender       =  e($_POST['gender']);
	$email  =  e($_POST['email']);
	$password1  =  e($_POST['password']);
    $repassword  =  e($_POST['repassword']);
	$role  =  e($_POST['role']);
	
	$region  =  e($_POST['region']);
	$district  =  e($_POST['district']);
	$council  =  e($_POST['council']);
	$ward  =  e($_POST['ward']);
	$village  =  e($_POST['village']);
	$street  =  e($_POST['street']);
	$added_by  =  e($_POST['added_by']);
	
	// form validation: ensure that the form is correctly filled
	if (empty($fname)) { 
		array_push($errors, "fname is required"); 
	}
	if (empty($lname)) { 
		array_push($errors, "lname is required"); 
	}
	if (empty($dob)) { 
		array_push($errors, "dob is required"); 
	}
	if (empty($phone)) { 
		array_push($errors, "phone is required"); 
	}
	if (empty($gender)) { 
		array_push($errors, "gender is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "email is required"); 
	}
	if (empty($password1)) { 
		array_push($errors, "password is required"); 
	}
	
	if (empty($repassword)) { 
		array_push($errors, "repassword is required"); 
	}
	if ($password1 != $repassword) {
		array_push($errors, "The two passwords do not match");
	}
	if (empty($role)) { 
		array_push($errors, "role is required"); 
	}
	
	if (empty($region)) { 
		array_push($errors, "region is required"); 
	}
	if (empty($district)) { 
		array_push($errors, "district is required"); 
	}
	if (empty($council)) { 
		array_push($errors, "council is required"); 
	}
	if (empty($ward)) { 
		array_push($errors, "ward is required"); 
	}
	
	if (empty($street)) { 
		array_push($errors, "street is required"); 
	}
	
$names = ucwords(strtolower($fname.'-'.$lname));

$target_dir = "../ProfilePictures/";

$target_file1 = $target_dir . basename($_FILES["photo"]["name"]);


$uploadOk1 = 1;


$arrayVar1=explode(".", $_FILES["photo"]["name"]);
$extension1 = end($arrayVar1); // return file extension

$length = 10;
$token = bin2hex(openssl_random_pseudo_bytes($length));


$filename1 = 'DP-'.$names.'-'.$token.'.'.$extension1;

// Check if file already exists
	
if (file_exists($filename1)) {
  echo "<font color='red'> <br>Sorry, file already exists.</font>";
  $uploadOk1 = 0;
}


// Allow certain file formats
if(
$extension1 != "jpg" && 
$extension1 != "png" && 
$extension1 != "jpeg" &&
$extension1 != "JPG" && 
$extension1 != "PNG" && 
$extension1 != "JPEG" &&
!empty($extension1)
)
{

array_push($errors, "Sorry, only jpg, jpeg & png files are allowed");
  $uploadOk1 = 0;
}


// Check file size
$limit = 2 * 1048576;
$filesize1 =$_FILES['photo']['size'];


// check file size is above limit of 2MB
if($filesize1 > $limit)  {
 
	$filesizeMb= $filesize1/1048576; 
	
	/*
	echo "<br>File Size:<b> ".round($filesizeMb,2)."</b> MB,<br><font color='red'> <b><i>File size is above limit of 2MB</i></b></font>";
	*/
array_push($errors, "File Size: ".round($filesizeMb,2)." MB, <i>File size is above limit of 2MB</i>");	

	$uploadOk1 = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk1 == 0) {
 	array_push($errors, "Sorry, your file was not uploaded."); 
// if everything is ok, try to upload file

} 


else {	

		if(!empty($_FILES["photo"]["name"])&& count($errors) == 0 )
		{
			if (move_uploaded_file($_FILES["photo"]["tmp_name"],"../ProfilePictures/".$filename1)) {
		
			array_push($comments_sent, "The file <b><i>".$_FILES["photo"]["name"]. "</i></b> has been uploaded.");
			
			$filename1 = 'DP-'.$names.'-'.$token.'.'.$extension1;
			$uploadOk1 = 1;
			}
			else{
				array_push($errors, "Sorry,file not uploaded. !!! Please check file size limit.");
				
				$filename1 = "";
				$uploadOk1 = 0;
			}
		}
		else{
			
			array_push($errors, "file ".$_FILES["photo"]["name"]." not uploaded!");
		}			
}


	// register user if there are no errors in the form
if ($uploadOk1 == 1 && count($errors) == 0 ){	
$password = md5($password1);//encrypt the password before saving in the database

$query = "INSERT INTO users(
	fname,
	mname, 
	lname, 
	dob,
	phone,
	gender, 
	email,
	password,
	role,
	photo,
	added_by,
	token
		
	)VALUES(
	'$fname',
	'$mname',
	'$lname',
	'$dob',
	'$phone',
	'$gender',
	'$email',
	'$password',
	'$role',
	'$filename1',
	'$added_by',
	'$token'
	
			)";
			
$sql = mysqli_query($db, $query);

$userID = mysqli_insert_id($db);

				if($userID)
					{
						$query2 = "INSERT INTO addresses(
							userID,
							region, 
							district, 
							council,
							ward,
							village, 
							street
								
							)VALUES(
							'$userID',
							'$region',
							'$district',
							'$council',
							'$ward',
							'$village',
							'$street'
									)";
									
						$sql2 = mysqli_query($db, $query2);

									if($sql2)
									{
										array_push($comments_sent, "Address Added Successfully.");
									}
									else
									{
										array_push($comments_failed, "Address failed to be Added!!!");
									}	
							
						$query3 = "INSERT INTO contacts(
							userID,
							phone, 
							personalEmail
								
							)VALUES(
							'$userID',
							'$phone',
							'$email'
									)";
									
						$sql3 = mysqli_query($db, $query3);

									if($sql3)
									{
										array_push($comments_sent, "Contact Added Successfully.");
									}
									else
									{
										array_push($comments_failed, "Contact failed to be Added!!!");
									}		
					}
			if($sql)
				{
				
				array_push($comments_sent, "User Added Successfully.  \t \t Click <a href='../home/login.php?u=".$email."&p=".$password1."' > HERE </a> to login.");

				}
				else
				{
					array_push($comments_failed, "FAILED to Add User, Please check and try again!!");
						
				}


		}
		
}



	
// LOGIN USER
	function login()
	{
	global $db, $errors,$comments_sent,$comments_failed;

		// grab form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);
        
        
        
		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		$length = 10;
		$sessionToken = bin2hex(openssl_random_pseudo_bytes($length));

								//CHECK IF ACCOUNT IS ACTIVATED	
		$user_check_query = "SELECT * FROM users WHERE email='$username'  LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$numRows = mysqli_num_rows($result);
		
						if ($numRows ==0){
							  array_push($errors, "Account does not exist.<a href='../home/signup.php?u=".$username."&p=".$password."' > REGISTER NOW </a> ");
							}
							
							
		$user = mysqli_fetch_assoc($result);
		if($user){
		  $acstatus = $user['status'];
		  $userID = $user['userID'];
							if ($acstatus !== 'active' ){
							  array_push($errors, "Account is not Activated");
							}

		  }
		$password = md5($password);
		// attempt login if no errors on form
		if (count($errors) == 0) {
			

			$query = "SELECT * FROM users WHERE email='$username'  AND password='$password'  LIMIT 1";
			
			$results = mysqli_query($db, $query);

				if (mysqli_num_rows($results)>0) 
				{ // user found
						
						$logged_in_user = mysqli_fetch_assoc($results);
		
						if ($logged_in_user['role'] == 'admin' ) 
						{
							$_SESSION['user'] = $logged_in_user;
							$_SESSION['success']  = "You are now logged in";
							header("location: ../admin/adminHome.php");
			
						}
						else if ($logged_in_user['role'] == 'landlord')
							{
								$_SESSION['user'] = $logged_in_user;
								$_SESSION['success']  = "You are now logged in";
								header("location: ../landlord/landlordHome.php");
							}
						else if ($logged_in_user['role'] == 'tenant')
							{
								$_SESSION['user'] = $logged_in_user;
								$_SESSION['success']  = "You are now logged in";
								header("location: ../tenant/tenantHome.php");
							}
						else
								{
									array_push($errors, "you dont have appropriate credentials for our system. Please contact System Admin");
								}
				}
				else
					{
						array_push($errors, "Wrong username / password combination");
					}
		}
	}



//UPDATE USER PHOTO 
function update_profile(){
global $db, $errors,$comments_sent,$comments_failed;

$userID = e($_POST['userID']);
$usernames = e($_POST['usernames']);
$usernames = strtolower($usernames);



$target_dir = "../ProfilePictures/";
$target_file1 = $target_dir . basename($_FILES["photo"]["name"]);
$uploadOk1 = 1;
$arrayVar1=explode(".", $_FILES["photo"]["name"]);
$extension1 = end($arrayVar1); // return file extension

$length = 10;
$token = bin2hex(openssl_random_pseudo_bytes($length));


$filename1 = 'DP-'.$usernames.'-'.$token.'.'.$extension1;

// Check if file already exists
	
if (file_exists($filename1)) {
  echo "<font color='red'> <br>Sorry, file already exists.</font>";
  $uploadOk1 = 0;
}


// Allow certain file formats
if(
$extension1 != "jpg" && 
$extension1 != "png" && 
$extension1 != "jpeg" &&
$extension1 != "JPG" && 
$extension1 != "PNG" && 
$extension1 != "JPEG" &&
!empty($extension1)
)
{

array_push($errors, "Sorry, only jpg, jpeg & png files are allowed");
  $uploadOk1 = 0;
}


// Check file size
$limit = 2 * 1048576;
$filesize1 =$_FILES['photo']['size'];


// check file size is above limit of 2MB
if($filesize1 > $limit)  {
 
	$filesizeMb= $filesize1/1048576; 
	
	/*
	echo "<br>File Size:<b> ".round($filesizeMb,2)."</b> MB,<br><font color='red'> <b><i>File size is above limit of 2MB</i></b></font>";
	*/
array_push($errors, "File Size: ".round($filesizeMb,2)." MB, <i>File size is above limit of 2MB</i>");	

	$uploadOk1 = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk1 == 0) {
 	array_push($errors, "Sorry, your file was not uploaded."); 
// if everything is ok, try to upload file

} 


else {	

		if(!empty($_FILES["photo"]["name"])&& count($errors) == 0 )
		{
			if (move_uploaded_file($_FILES["photo"]["tmp_name"],"../ProfilePictures/".$filename1)) {
		
			array_push($comments_sent, "The file <b><i>".$_FILES["photo"]["name"]. "</i></b> has been uploaded.");
			
			$filename1 = 'DP-'.$usernames.'-'.$token.'.'.$extension1;
			$uploadOk1 = 1;
			}
			else{
				array_push($errors, "Sorry,file not uploaded. !!! Please check file size limit.");
				
				$filename1 = "";
				$uploadOk1 = 0;
			}
		}
		else{
			
			array_push($errors, "file ".$_FILES["photo"]["name"]." not uploaded!");
		}			
}


	// register user if there are no errors in the form
if ($uploadOk1 == 1 && count($errors) == 0 ){
	
	
		$query ="UPDATE users SET photo ='$filename1' WHERE userID ='$userID' ";
		$sql = mysqli_query($db, $query);
		if($sql)
				{
				
				array_push($comments_sent, "Profile Updated Successfully");
				
				}
				else
				{
					array_push($comments_failed, "FAILED to Update profile, Please check and try again!!");
						
				}

			
	}
}


//PASSWORD RESET REQUEST 
function password_reset_request(){
global $db, $errors,$comments_sent,$comments_failed;

$userID = e($_POST['userID']);
$userEmail = e($_POST['email']);


	
	if (empty($email)) { 
		array_push($errors, "email is required"); 
	}
	


$userValues = $FarmRents-> getUserData($userID);
$email =	$userValues['email'];

if ($userEmail <>$email) { 
		array_push($errors, "Account Not Exists"); 
}

	// register user if there are no errors in the form
if (count($errors) == 0){

$length = 10;
$token = bin2hex(openssl_random_pseudo_bytes($length));
	
$query2 = "INSERT INTO password_resets(
							userID,
							email,
							token
							)VALUES(
							'$userID',
							'$email',
							'$token'
									)";
									
						$sql2 = mysqli_query($db, $query2);

									if($sql2)
									{
	array_push($comments_sent, "<script>alert('Password reset sent successfully');</script>");
	
	array_push($comments_sent, "<script language='javascript'>window.location.href = '../home/reset_password.php?u=".$userID."&e=".$email." &t=".$token."  '</script>");
									}
									else
									{
										array_push($comments_failed, "Password Reset Request failed.Try again Later !!!");
									}

			
	}
}


//RESET PASSWORD 
function password_reset(){
global $db, $errors,$comments_sent,$comments_failed;

$userID = e($_POST['userID']);
$userEmail = e($_POST['email']);


	
	if (empty($email)) { 
		array_push($errors, "email is required"); 
	}
	


$userValues = $FarmRents-> getUserData($userID);
$email =	$userValues['email'];

if ($userEmail <>$email) { 
		array_push($errors, "Account Not Exists"); 
}

	// register user if there are no errors in the form
if (count($errors) == 0){


		$query ="UPDATE users SET photo ='$filename1' WHERE userID ='$userID' ";
		$sql = mysqli_query($db, $query);
		if($sql)
				{
				
				array_push($comments_sent, "Profile Updated Successfully");
				
				}
				else
				{
					array_push($comments_failed, "FAILED to Update profile, Please check and try again!!");
						
				}

			
	}
}






// send_comment US
function send_comment(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors,$comments_sent,$comments_failed;

	// receive all input values from the form. 
    // Call the e() function defined below to escape form values
	$fname    =  e($_POST['fname']);
	$lname  =  e($_POST['lname']);
	$phone    =  e($_POST['phone']);
	$email  =  e($_POST['email']);
	$gender       =  e($_POST['gender']);
	$address  =  e($_POST['address']);
	$message  =  e($_POST['message']);
	
	
	// form validation: ensure that the form is correctly filled
	if (empty($fname)) { 
		array_push($errors, "fname is required"); 
	}
	if (empty($lname)) { 
		array_push($errors, "lname is required"); 
	}
	if (empty($phone)) { 
		array_push($errors, "phone is required"); 
	}
	
	if (empty($email)) { 
		array_push($errors, "email is required"); 
	}
	if (empty($gender)) { 
		array_push($errors, "gender is required"); 
	}
	
	
	if (empty($address)) { 
		array_push($errors, "address is required"); 
	}
	
	if (empty($message)) { 
		array_push($errors, "message is required"); 
	}
	
	
$target_dir = "../CustomerComments/";

$target_file1 = $target_dir . basename($_FILES["doc"]["name"]);


$uploadOk1 = 1;


$arrayVar1=explode(".", $_FILES["doc"]["name"]);
$extension1 = end($arrayVar1); // return file extension

$length = 4;
$token = bin2hex(openssl_random_pseudo_bytes($length));

$fileName = strtolower($fname.'-'.$lname);

//rename the Attachement file

$filename1 = 'Customer-'.$fileName.'-'.$token.'.'.$extension1;


// Allow certain file formats
if(
$extension1 != "jpg" && 
$extension1 != "png" &&
$extension1 != "jpeg" &&
$extension1 != "pdf" &&
$extension1 != "JPG" && 
$extension1 != "PNG" && 
$extension1 != "JPEG" &&
$extension1 != "PDF" &&
!empty($extension1)
)
{

array_push($errors, "Sorry, only jpg, jpeg & png files are allowed");
  $uploadOk1 = 0;
}


// Check file size
$limit = 2 * 1048576;
$filesize1 =$_FILES['doc']['size'];


// check file size is above limit of 2MB
if($filesize1 > $limit)  {
 
	$filesizeMb= $filesize1/1048576; 
	
	/*
	echo "<br>File Size:<b> ".round($filesizeMb,2)."</b> MB,<br><font color='red'> <b><i>File size is above limit of 2MB</i></b></font>";
	*/
array_push($errors, "File Size: ".round($filesizeMb,2)." MB, <i>File size is above limit of 2MB</i>");	

	$uploadOk1 = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk1 == 0) {
 	array_push($errors, "Sorry, your file was not uploaded."); 
// if everything is ok, try to upload file

} 


else {	

		if(!empty($_FILES["doc"]["name"])&& count($errors) == 0 )
		{
			if (move_uploaded_file($_FILES["doc"]["tmp_name"],"../CustomerComments/".$filename1)) {
				
				array_push($comments_sent, "The file <b><i>".$_FILES["doc"]["name"]. "</i></b> has been uploaded.");
				
			$filename1 = 'Customer-'.$fileName.'-'.$token.'.'.$extension1;
			$uploadOk1 = 1;
			}
			else{
				
				array_push($errors, "Sorry,file not uploaded. !!! Please check file size limit.");
				$filename1 =NULL;
				$uploadOk1 = 0;
			}
		}
		else{
			array_push($errors, "file ".$_FILES["doc"]["name"]." not uploaded!");
			$uploadOk1 = 0;
			$filename1 =NULL;
		}			
}

$length = 10;
$token = bin2hex(openssl_random_pseudo_bytes($length));

	// register user if there are no errors in the form
if ($uploadOk1 == 1 && count($errors) == 0 ){	

$query = "INSERT INTO customer_comments(
	fname,
	lname, 
	phone,
	email,
	gender, 
	address,
	message,
	token,
	doc
		
	)VALUES(
	'$fname',
	'$lname',
	'$phone',
	'$email',
	'$gender',
	'$address',
	'$message',
	'$token',
	'$filename1'
			)";
			
$sql = mysqli_query($db, $query);

			if($sql)
				{
					array_push($comments_sent, "Message Sent Succesfuly");
				}
				else
				{
					array_push($comments_failed, "Message sent failed");
				}
		}
		
}


// ADD FARM
function add_farm(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors,$comments_sent,$comments_failed;


	// receive all input values from the form. 
    // Call the e() function defined below to escape form values
	$farmNo    =  e($_POST['farmNo']);
	$farmName  =  e($_POST['farmName']);
	
	$description  = e($_POST['description']);
	$added_by  = e($_POST['added_by']);
	$category  = e($_POST['category']);
	$ownerID =  e($_POST['ownerID']);
	$region  =  e($_POST['region']);
	$district  =  e($_POST['district']);
	$council  =  e($_POST['council']);
	$ward  =  e($_POST['ward']);
	$village  =  e($_POST['village']);
	$street  =  e($_POST['street']);
	
	// form validation: ensure that the form is correctly filled
	if (empty($farmNo)) { 
		array_push($errors, "FarmNo is required"); 
	}
	
	if (empty($farmName)) { 
		array_push($errors, "farmName is required"); 
	}
	
	if (empty($description)) { 
		array_push($errors, "description is required"); 
	}
	if (empty($category)) { 
		array_push($errors, "category is required"); 
	}
	if (empty($region)) { 
		array_push($errors, "region is required"); 
	}
	if (empty($district)) { 
		array_push($errors, "district is required"); 
	}
	if (empty($council)) { 
		array_push($errors, "council is required"); 
	}
	if (empty($ward)) { 
		array_push($errors, "ward is required"); 
	}
	
	if (empty($street)) { 
		array_push($errors, "street is required"); 
	}
		if (empty($ownerID)) { 
		array_push($errors, "OwnerID is required");  
	}

$owner_query = "SELECT * FROM users WHERE userID='$ownerID'  LIMIT 1";
$result = mysqli_query($db, $owner_query);
$numRows = mysqli_num_rows($result);
while($owner = mysqli_fetch_assoc($result)){
	
$ownerNames =  $owner['fname'].'_'.$owner['lname'];
	
}
	
$target_dir = "../FarmPictures/";

$target_file1 = $target_dir . basename($_FILES["doc"]["name"]);


$uploadOk1 = 1;


$arrayVar1=explode(".", $_FILES["doc"]["name"]);
$extension1 = end($arrayVar1); // return file extension

$length = 4;
$token = bin2hex(openssl_random_pseudo_bytes($length));

$fileName = strtolower($farmName.'-'.$ownerNames);

//rename the Attachement file

$filename1 = 'Farm-'.$fileName.'-'.$token.'.'.$extension1;


// Allow certain file formats
if(
$extension1 != "jpg" && 
$extension1 != "png" && 
$extension1 != "jpeg" &&
$extension1 != "JPG" && 
$extension1 != "PNG" && 
$extension1 != "JPEG" &&
!empty($extension1)
)
{

array_push($errors, "Sorry, only jpg, jpeg & png files are allowed");
  $uploadOk1 = 0;
}


// Check file size
$limit = 2 * 1048576;
$filesize1 =$_FILES['doc']['size'];


// check file size is above limit of 2MB
if($filesize1 > $limit)  {
 
	$filesizeMb= $filesize1/1048576; 
	
	/*
	echo "<br>File Size:<b> ".round($filesizeMb,2)."</b> MB,<br><font color='red'> <b><i>File size is above limit of 2MB</i></b></font>";
	*/
array_push($errors, "File Size: ".round($filesizeMb,2)." MB, <i>File size is above limit of 2MB</i>");	

	$uploadOk1 = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk1 == 0) {
 	array_push($errors, "Sorry, your file was not uploaded."); 
// if everything is ok, try to upload file

} 


else {	

		if(!empty($_FILES["doc"]["name"])&& count($errors) == 0 )
		{
			if (move_uploaded_file($_FILES["doc"]["tmp_name"],"../FarmPictures/".$filename1)) {
				
				array_push($comments_sent, "The file <b><i>".$_FILES["doc"]["name"]. "</i></b> has been uploaded.");
				
			$filename1 = 'Farm-'.$fileName.'-'.$token.'.'.$extension1;
			$uploadOk1 = 1;
			}
			else{
				
				array_push($errors, "Sorry,file not uploaded. !!! Please check file size limit.");
				$filename1 = NULL;
				$uploadOk1 = 0;
			}
		}
		else{
			array_push($errors, "file ".$_FILES["doc"]["name"]." not uploaded!");
			$uploadOk1 = 0;
			$filename1 =NULL;
		}			
}



	// register user if there are no errors in the form
if ($uploadOk1 == 1 && count($errors) == 0 ){

$query = "INSERT INTO farms(
			farmNo,
			farmName, 
			ownerID,
			description,
			category,
			farmPicture,
			farmToken,
			added_by
				
			)VALUES(
			'$farmNo',
			'$farmName',
			'$ownerID',
			'$description',
			'$category',
			'$filename1',
			'$token',
			'$added_by'
					)";
			
			$sql = mysqli_query($db, $query);

			$farmID = mysqli_insert_id($db);
			if($sql)
			{
				array_push($comments_sent, "Farm Added Succesfuly");
			}
			else
			{
				array_push($comments_failed, "FAILED to Add Farm, Please try again!!");
			}

			if($farmID)
					{
						$query2 = "INSERT INTO addresses(
							farmID,
							region, 
							district, 
							council,
							ward,
							village, 
							street
								
							)VALUES(
							'$farmID',
							'$region',
							'$district',
							'$council',
							'$ward',
							'$village',
							'$street'
									)";
									
						$sql2 = mysqli_query($db, $query2);

									if($sql2)
									{
										array_push($comments_sent, "Address Added Successfully.");
									}
									else
									{
										array_push($comments_failed, "Address failed to be Added!!!");
									}	
								
					}
		}
		
}

// ADD block
function add_block(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors,$comments_sent,$comments_failed;

	// receive all input values from the form. 
    // Call the e() function defined below to escape form values
	$farmID    =  e($_POST['farmID']);
	$blockNo  =  e($_POST['blockNo']);
	$description  = e($_POST['description']);
	$size   =  e($_POST['size']);
	$rent  = e($_POST['rent']);
	$category  = e($_POST['category']);
	$added_by  = e($_POST['added_by']);
	
	
	// form validation: ensure that the form is correctly filled
	if (empty($blockNo)) { 
		array_push($errors, "blockNo is required"); 
	}
	if (empty($description)) { 
		array_push($errors, "description is required"); 
	}	
	
	if (empty($size)) { 
		array_push($errors, "size is required"); 
	}
	
	if (empty($rent)) { 
		array_push($errors, "rent is required"); 
	}	
	
	if (empty($category)) { 
		array_push($errors, "category is required"); 
	}



$farmquery = "SELECT * FROM farms WHERE farmID='$farmID'  LIMIT 1";
$result = mysqli_query($db, $farmquery);
$numRows = mysqli_num_rows($result);
while($farm = mysqli_fetch_assoc($result)){
	
$farmName = $farm['farmName'];
$ownerID = $farm['ownerID'];	


$target_dir = "../BlockPictures/";

$target_file1 = $target_dir . basename($_FILES["doc"]["name"]);
$uploadOk1 = 1;

$arrayVar1=explode(".", $_FILES["doc"]["name"]);
$extension1 = end($arrayVar1); // return file extension

$length = 4;
$token = bin2hex(openssl_random_pseudo_bytes($length));

$fileName = strtolower($farmName.'-'.$farmID.'-'.$blockNo);

//rename the Attachement file

$filename1 = 'Block-'.$fileName.'-'.$token.'.'.$extension1;


// Allow certain file formats
if(
$extension1 != "jpg" && 
$extension1 != "png" && 
$extension1 != "jpeg" &&
$extension1 != "JPG" && 
$extension1 != "PNG" && 
$extension1 != "JPEG" &&
!empty($extension1)
)
{

array_push($errors, "Sorry, only jpg, jpeg & png files are allowed");
  $uploadOk1 = 0;
}


// Check file size
$limit = 2 * 1048576;
$filesize1 =$_FILES['doc']['size'];


// check file size is above limit of 2MB
if($filesize1 > $limit)  {
 
	$filesizeMb= $filesize1/1048576; 
	
	/*
	echo "<br>File Size:<b> ".round($filesizeMb,2)."</b> MB,<br><font color='red'> <b><i>File size is above limit of 2MB</i></b></font>";
	*/
array_push($errors, "File Size: ".round($filesizeMb,2)." MB, <i>File size is above limit of 2MB</i>");	

	$uploadOk1 = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk1 == 0) {
 	array_push($errors, "Sorry, your file was not uploaded."); 
// if everything is ok, try to upload file

} 


else {	

		if(!empty($_FILES["doc"]["name"])&& count($errors) == 0 )
		{
			if (move_uploaded_file($_FILES["doc"]["tmp_name"],"../BlockPictures/".$filename1)) {
				
				array_push($comments_sent, "The file <b><i>".$_FILES["doc"]["name"]. "</i></b> has been uploaded.");
				
			$filename1 = 'Block-'.$fileName.'-'.$token.'.'.$extension1;
			$uploadOk1 = 1;
			}
			else{
				
				array_push($errors, "Sorry,file not uploaded. !!! Please check file size limit.");
				$filename1 =NULL;
				$uploadOk1 = 0;
			}
		}
		else{
			array_push($errors, "file ".$_FILES["doc"]["name"]." not uploaded!");
			$uploadOk1 = 0;
			$filename1 = NULL;
		}			
}


	// register user if there are no errors in the form
if ($uploadOk1 == 1 && count($errors) == 0 ){	
		
$query = "INSERT INTO blocks(
	farmID,
	ownerID,
	blockNo,
	description,
	size,
	rent,
	category,
	blockPicture,
	blockToken,
	added_by
		
	)VALUES(
	'$farmID',
	'$ownerID',
	'$blockNo',
	'$description',
	'$size',
	'$rent',
	'$category',
	'$filename1',
	'$token',
	'$added_by'
	
			)";
		
$sql = mysqli_query($db, $query);
				if($sql)
				{
					array_push($comments_sent, "Block Added Succesfuly");
				}
				else
				{
					array_push($comments_failed, "FAILED to Add Block, Please try again!!");
				}

		}
		
}

}


// BOOK RROM
function book_block(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors,$comments_sent,$comments_failed;

	// receive all input values from the form. 
    // Call the e() function defined below to escape form values
	$userID     =  e($_POST['userID']);
	$farmID     =  e($_POST['farmID']);
	$blockID        =  e($_POST['blockID']);
	$startDate   =  e($_POST['startDate']);
	$endDate  =  e($_POST['endDate']);
	$rent       =  e($_POST['rent']);
	$accres       =  e($_POST['accres']);
	$totalRent       =  e($_POST['totalRent']);
	

	// form validation: ensure that the form is correctly filled
	if (empty($userID)) { 
		array_push($errors, "userID is required"); 
	}
	if (empty($farmID)) { 
		array_push($errors, "farmID is required"); 
	}
	if (empty($blockID)) { 
		array_push($errors, "blockID is required"); 
	}
	
	if (empty($startDate)) { 
		array_push($errors, "startDate status is required"); 
	}
	if (empty($endDate)) { 
		array_push($errors, "endDate status is required"); 
	}

	if (empty($accres)) { 
			array_push($errors, "accres is required"); 
		}
		
	if (empty($totalRent)) { 
			array_push($errors, "totalRent is required"); 
		}


$startDate = date("Y-m-d, H:i:s", strtotime($startDate));
$endDate = date("Y-m-d, H:i:s", strtotime($endDate));


$farmquery = "SELECT * FROM farms WHERE farmID='$farmID'  LIMIT 1";
$result = mysqli_query($db, $farmquery);
$numRows = mysqli_num_rows($result);
while($farm = mysqli_fetch_assoc($result)){
	
$farmName = $farm['farmName'];
$ownerID = $farm['ownerID'];
}


if (count($errors) == 0 )
	{	

		$query = "INSERT INTO bookings(
			userID,
			ownerID,
			farmID,
			blockID, 
			startDate,
			endDate
			
			)VALUES(
			'$userID',
			'$ownerID',
			'$farmID',
			'$blockID',
			'$startDate',
			'$endDate'
			
					)";
				
		$sql = mysqli_query($db, $query);

		$bookingID = mysqli_insert_id($db);


		if($sql)
			{

							echo "<script>alert('block Booked Successfully');</script>";
							
			}
			else
			{
							echo "<script>alert('FAILED to Book block, Please check and try again!!');</script>";
								
			}
		if($bookingID)
			{
$WHT = 0.1;
$subTotal = $WHT * $totalRent;


$total_rent_before_tax = $totalRent;
$tax_rate = $WHT;
$total = $total_rent_before_tax + $subTotal;


				$query2 = "INSERT INTO invoice_items (
				bookingID,
				blockID,
				farmID,
				ownerID,
				userID,
				rent,
				accres,
				total_rent_before_tax,
				tax_rate,
				totalRent
				)
				VALUES(
				'$bookingID',
				'$blockID',
				'$farmID',
				'$ownerID',
				'$userID',
				'$rent',
				'$accres',
				'$total_rent_before_tax',
				'$tax_rate',
				'$total'
				)";
				$sql2 = mysqli_query($db, $query2);

											if($sql2)
											{
												array_push($comments_sent, "Invoice Generated Succesfuly");
											}
											else
											{
												array_push($comments_failed, "Invoice failed to be generated!!!");
											}
				$query ="UPDATE blocks SET blockStatus ='booked' WHERE blockID ='$blockID' ";
				$sql = mysqli_query($db, $query);
			}

	}
			

}

//ADD PAYMENT 
function add_payment(){
global $db, $errors,$comments_sent,$comments_failed;

$userID = e($_POST['userID']);
$blockID = e($_POST['blockID']);
$bookingID = e($_POST['bookingID']);
$invoiceID = e($_POST['invoiceID']);
$farmID = e($_POST['farmID']);
$paid = e($_POST['paid']);
$usernames = e($_POST['usernames']);
$usernames = strtolower($usernames);



$target_dir = "../Receipts/";
$target_file1 = $target_dir . basename($_FILES["receipt"]["name"]);
$uploadOk1 = 1;
$arrayVar1=explode(".", $_FILES["receipt"]["name"]);
$extension1 = end($arrayVar1); // return file extension

$length = 10;
$token = bin2hex(openssl_random_pseudo_bytes($length));


$filename1 = 'Receipt-'.$usernames.'-'.$token.'.'.$extension1;

// Check if file already exists
	
if (file_exists($filename1)) {
  echo "<font color='red'> <br>Sorry, file already exists.</font>";
  $uploadOk1 = 0;
}


// Allow certain file formats
if(
$extension1 != "jpg" && 
$extension1 != "png" && 
$extension1 != "jpeg" &&
$extension1 != "pdf" &&
$extension1 != "JPG" && 
$extension1 != "PNG" && 
$extension1 != "JPEG" &&
!empty($extension1)
)
{

array_push($errors, "Sorry, only jpg, jpeg & png files are allowed");
  $uploadOk1 = 0;
}


// Check file size
$limit = 2 * 1048576;
$filesize1 =$_FILES['receipt']['size'];


// check file size is above limit of 2MB
if($filesize1 > $limit)  {
 
	$filesizeMb= $filesize1/1048576; 
	
	/*
	echo "<br>File Size:<b> ".round($filesizeMb,2)."</b> MB,<br><font color='red'> <b><i>File size is above limit of 2MB</i></b></font>";
	*/
array_push($errors, "File Size: ".round($filesizeMb,2)." MB, <i>File size is above limit of 2MB</i>");	

	$uploadOk1 = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk1 == 0) {
 	array_push($errors, "Sorry, your file was not uploaded."); 
// if everything is ok, try to upload file

} 


else {	

		if(!empty($_FILES["receipt"]["name"])&& count($errors) == 0 )
		{
			if (move_uploaded_file($_FILES["receipt"]["tmp_name"],"../Receipts/".$filename1)) {
		
			array_push($comments_sent, "The file <b><i>".$_FILES["receipt"]["name"]. "</i></b> has been uploaded.");
			
			$filename1 = 'Receipt-'.$usernames.'-'.$token.'.'.$extension1;
			$uploadOk1 = 1;
			}
			else{
				array_push($errors, "Sorry,file not uploaded. !!! Please check file size limit.");
				
				$filename1 = "";
				$uploadOk1 = 0;
			}
		}
		else{
			
			array_push($errors, "file ".$_FILES["receipt"]["name"]." not uploaded!");
		}			
}

$farmquery = "SELECT * FROM farms WHERE farmID='$farmID'  LIMIT 1";
$result = mysqli_query($db, $farmquery);
$numRows = mysqli_num_rows($result);
while($farm = mysqli_fetch_assoc($result)){
	
$farmName = $farm['farmName'];
$ownerID = $farm['ownerID'];
}

	// register user if there are no errors in the form
if ($uploadOk1 == 1 && count($errors) == 0 ){
	
		$query = "INSERT INTO payments (
				invoiceID,
				bookingID,
				blockID,
				farmID,
				ownerID,
				userID,				
				paid,
				receipt
				)
				VALUES(
				'$invoiceID',
				'$bookingID',
				'$blockID',
				'$farmID',
				'$ownerID',
				'$userID',
				'$paid',
				'$filename1'
				)";
				$sql = mysqli_query($db, $query);
		
		if($sql)
				{
				
				array_push($comments_sent, "Payment Added Successfully");
				
				}
				else
				{
					array_push($comments_failed, "FAILED to add Payment. Please check and try again!!");
						
				}

	}
}



//ADD PAYMENT STATUS
function add_payment_status()
{
	global $db, $errors,$comments_sent,$comments_failed;

	$userID = e($_POST['userID']);
	$blockID = e($_POST['blockID']);
	$bookingID = e($_POST['bookingID']);
	$invoiceID = e($_POST['invoiceID']);
	$farmID = e($_POST['farmID']);
	$payID = e($_POST['payID']);

	$paid = e($_POST['paid']);
	$invoice_status = e($_POST['invoice_status']);
	$payment_status = e($_POST['payment_status']);

	$usernames = e($_POST['usernames']);
	$usernames = strtolower($usernames);


	//FILE UPLOADING STARTS HERE
	$target_dir = "../Receipts/";
	$target_file1 = $target_dir . basename($_FILES["receipt"]["name"]);
	$uploadOk1 = 1;
	$arrayVar1=explode(".", $_FILES["receipt"]["name"]);
	$extension1 = end($arrayVar1); // return file extension

	$length = 10;
	$token = bin2hex(openssl_random_pseudo_bytes($length));


	$filename1 = 'Receipt-'.$usernames.'-'.$token.'.'.$extension1;

	// Check if file already exists
	if (file_exists($filename1)) {
	  echo "<font color='red'> <br>Sorry, file already exists.</font>";
	  $uploadOk1 = 0;
	}


	// Allow certain file formats
	if(
	$extension1 != "jpg" && 
	$extension1 != "png" && 
	$extension1 != "jpeg" &&
	$extension1 != "pdf" &&
	$extension1 != "JPG" && 
	$extension1 != "PNG" && 
	$extension1 != "JPEG" &&
	!empty($extension1)
	)
	{
	  array_push($errors, "Sorry, only jpg, jpeg & png files are allowed");
	  $uploadOk1 = 0;
	}


	// Check file size
	$limit = 2 * 1048576;
	$filesize1 =$_FILES['receipt']['size'];


	// check file size is above limit of 2MB
	if($filesize1 > $limit)
	{
	 
		$filesizeMb= $filesize1/1048576; 
		
		/*
		echo "<br>File Size:<b> ".round($filesizeMb,2)."</b> MB,<br><font color='red'> <b><i>File size is above limit of 2MB</i></b></font>";
		*/
		array_push($errors, "File Size: ".round($filesizeMb,2)." MB, <i>File size is above limit of 2MB</i>");	

		$uploadOk1 = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk1 == 0)
	{
		array_push($errors, "Sorry, your file was not uploaded."); 
		// if everything is ok, try to upload file
	} 
	else 
	{
		if(!empty($_FILES["receipt"]["name"])&& count($errors) == 0 )
		{
			if (move_uploaded_file($_FILES["receipt"]["tmp_name"],$target_dir.$filename1)) 
			{
				array_push($comments_sent, "The file <b><i>".$_FILES["receipt"]["name"]. "</i></b> has been uploaded.");
				
				$filename1 = 'Receipt-'.$usernames.'-'.$token.'.'.$extension1;
				$uploadOk1 = 1;
			}
			else
			{
				array_push($errors, "Sorry,file not uploaded. !!! Please check file size limit.");
				
				$filename1 = "";
				$uploadOk1 = 0;
			}
		}
		else
		{
			
			array_push($errors, "file ".$_FILES["receipt"]["name"]." not uploaded!");
		}			
	}

$farmquery = "SELECT * FROM farms WHERE farmID='$farmID'  LIMIT 1";
$result = mysqli_query($db, $farmquery);
$numRows = mysqli_num_rows($result);
while($farm = mysqli_fetch_assoc($result)){
	
$farmName = $farm['farmName'];
$ownerID = $farm['ownerID'];
}

	// register user if there are no errors in the form
	if ($uploadOk1 == 1 && count($errors) == 0 )
	{
	
		$query = "INSERT INTO receipts(
				payID,
				invoiceID,
				bookingID,
				blockID,
				farmID,
				ownerID,
				userID,			
				paid,
				receipt,
				token
				)
				VALUES(
				'$payID',
				'$invoiceID',
				'$bookingID',
				'$blockID',
				'$farmID',
				'$ownerID',
				'$userID',
				'$paid',
				'$filename1',
				'$token'
				)";
				$sql = mysqli_query($db, $query);
		
		if($sql)
				{
				
				array_push($comments_sent, "Payment Receipts Added Successfully");
				
				}
				else
				{
					array_push($comments_failed, "FAILED to add Payment Receipt. Please check and try again!!");
						
				}
		if($invoice_status == 'paid')
		{
			
			$query3 ="UPDATE payments SET pay_status ='$payment_status' WHERE payID='$payID' AND invoiceID ='$invoiceID'";
			$sql3 = mysqli_query($db, $query3);
			if($sql3)
			{
				$sql = "SELECT * FROM payments where invoiceID='$invoiceID' AND userID='$userID' AND pay_status='received'";
				$result = $db->query($sql);
				while($row = $result->fetch_assoc()) 
				{
					$invoice = new FarmRents();
					$pay_status	= $row['pay_status'];
						
					if($pay_status <>'received')
					{
						$paymentValues = $invoice->getPaymentInvoiceData($invoiceID);
					}else
					{
						$paymentValues = $invoice->getPaymentData($payID);
					}
					$count = 0;
					foreach($paymentValues as $paymentValue)
					{	
						$paidAmount = $paymentValue["paid"];
						$TotalPaid[$count]= $paidAmount;
						$sumPaid = array_sum($TotalPaid);
						
						$count++;
					}
				}
			
			
			
					$query1 ="UPDATE invoice_items SET status ='$invoice_status',paid ='$sumPaid'  WHERE invoiceID ='$invoiceID' AND userID='$userID' ";
					$sql1 = mysqli_query($db, $query1);
							if($sql1)
							{
							
							array_push($comments_sent, "Invoice Status updated Successfully");
							
							}
							else
							{
								array_push($comments_failed, "FAILED to update Invoice status!!");
									
							}
					
					
					$query2 ="UPDATE blocks SET blockStatus ='taken' WHERE blockID='$blockID' AND farmID ='$farmID'";
					$sql2 = mysqli_query($db, $query2);
					
					if($sql2)
							{
							
							array_push($comments_sent, "Block Status updated Successfully");
							
							}
							else
							{
								array_push($comments_failed, "FAILED to update Block status!!");
									
							}
					
			array_push($comments_sent, "Pay_status updated Successfully");
			}
			else
			{
				array_push($comments_failed, "FAILED to update Pay_status!!");
					
			}
		}
		else
		{
			$query3 ="UPDATE payments SET pay_status ='$payment_status' WHERE payID='$payID' AND invoiceID ='$invoiceID'";
			$sql3 = mysqli_query($db, $query3);
			
			if($sql3)
			{
				$sql = "SELECT * FROM payments where invoiceID='$invoiceID' AND userID='$userID' AND pay_status='received'";
				$result = $db->query($sql);
				while($row = $result->fetch_assoc()) 
				{
					$invoice = new FarmRents();
					$pay_status	= $row['pay_status'];
						
					if($pay_status <>'received')
					{
						$paymentValues = $invoice->getPaymentInvoiceData($invoiceID);
					}else
					{
						$paymentValues = $invoice->getPaymentData($payID);
					}
					$count = 0;
					foreach($paymentValues as $paymentValue)
					{	
						$paidAmount = $paymentValue["paid"];
						$TotalPaid[$count]= $paidAmount;
						$sumPaid = array_sum($TotalPaid);
						
						$count++;
					}
				}
			
				$query1 ="UPDATE invoice_items SET status ='$invoice_status',paid ='$sumPaid'  WHERE invoiceID ='$invoiceID' AND userID='$userID' ";
				$sql1 = mysqli_query($db, $query1);
						if($sql1)
						{
						
						array_push($comments_sent, "Invoice Status updated Successfully");
						
						}
						else
						{
							array_push($comments_failed, "FAILED to update Invoice status!!");
								
						}
					
				array_push($comments_sent, "Pay_status updated Successfully");
			}
			else
			{
				array_push($comments_failed, "FAILED to update Pay_status!!");
					
			}
		}
	}
}



// USER BOOKING FORM
function user_booking(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors,$comments_sent,$comments_failed;


	// receive all input values from the form. 
    // Call the e() function defined below to escape form values
	$fname    =  e($_POST['fname']);
	$mname       =  e($_POST['mname']);
	$lname  =  e($_POST['lname']);
	$dob  =  e($_POST['dob']);
	$phone    =  e($_POST['phone']);
	$gender       =  e($_POST['gender']);
	$email  =  e($_POST['email']);
	$password1  =  e($_POST['password']);
    $repassword  =  e($_POST['repassword']);
	$role  =  e($_POST['role']);
	$region  =  e($_POST['region']);
	$district  =  e($_POST['district']);
	$council  =  e($_POST['council']);
	$ward  =  e($_POST['ward']);
	$village  =  e($_POST['village']);
	$street  =  e($_POST['street']);
	$added_by  =  e($_POST['added_by']);
	
	$userID     =  e($_POST['userID']);
	$farmID     =  e($_POST['farmID']);
	$blockID        =  e($_POST['blockID']);
	$startDate   =  e($_POST['startDate']);
	$endDate  =  e($_POST['endDate']);
	$rent       =  e($_POST['rent']);
	$accres       =  e($_POST['accres']);
	$totalRent       =  e($_POST['totalRent']);
	
	// form validation: ensure that the form is correctly filled
	if (empty($fname)) { 
		array_push($errors, "fname is required"); 
	}
	if (empty($lname)) { 
		array_push($errors, "lname is required"); 
	}
	if (empty($dob)) { 
		array_push($errors, "dob is required"); 
	}
	if (empty($phone)) { 
		array_push($errors, "phone is required"); 
	}
	if (empty($gender)) { 
		array_push($errors, "gender is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "email is required"); 
	}
	if (empty($password1)) { 
		array_push($errors, "password is required"); 
	}
	
	if (empty($repassword)) { 
		array_push($errors, "repassword is required"); 
	}
	if ($password1 != $repassword) {
		array_push($errors, "The two passwords do not match");
	}
	if (empty($role)) { 
		array_push($errors, "role is required"); 
	}
	
	if (empty($region)) { 
		array_push($errors, "region is required"); 
	}
	if (empty($district)) { 
		array_push($errors, "district is required"); 
	}
	if (empty($council)) { 
		array_push($errors, "council is required"); 
	}
	if (empty($ward)) { 
		array_push($errors, "ward is required"); 
	}
	
	if (empty($street)) { 
		array_push($errors, "street is required"); 
	}
	
	
	
	// form validation: ensure that the form is correctly filled
	if (empty($userID)) { 
		array_push($errors, "userID is required"); 
	}
	
	if (empty($farmID)) { 
		array_push($errors, "farmID is required"); 
	}
	if (empty($blockID)) { 
		array_push($errors, "blockID is required"); 
	}
	
	if (empty($startDate)) { 
		array_push($errors, "startDate status is required"); 
	}
	if (empty($endDate)) { 
		array_push($errors, "endDate status is required"); 
	}

	if (empty($accres)) { 
			array_push($errors, "accres is required"); 
		}

	if (empty($totalRent)) { 
			array_push($errors, "totalRent is required"); 
		}


$startDate = date("Y-m-d, H:i:s", strtotime($startDate));
$endDate = date("Y-m-d, H:i:s", strtotime($endDate));


$names = ucwords(strtolower($fname.'-'.$lname));

$target_dir = "../ProfilePictures/";

$target_file1 = $target_dir . basename($_FILES["photo"]["name"]);


$uploadOk1 = 1;


$arrayVar1=explode(".", $_FILES["photo"]["name"]);
$extension1 = end($arrayVar1); // return file extension

$length = 10;
$token = bin2hex(openssl_random_pseudo_bytes($length));


$filename1 = 'DP-'.$names.'-'.$token.'.'.$extension1;

// Check if file already exists
	
if (file_exists($filename1)) {
  echo "<font color='red'> <br>Sorry, file already exists.</font>";
  $uploadOk1 = 0;
}


// Allow certain file formats
if(
$extension1 != "jpg" && 
$extension1 != "png" && 
$extension1 != "jpeg" &&
$extension1 != "JPG" && 
$extension1 != "PNG" && 
$extension1 != "JPEG" &&
!empty($extension1)
)
{

array_push($errors, "Sorry, only jpg, jpeg & png files are allowed");
  $uploadOk1 = 0;
}


// Check file size
$limit = 2 * 1048576;
$filesize1 =$_FILES['photo']['size'];


// check file size is above limit of 2MB
if($filesize1 > $limit)  {
 
	$filesizeMb= $filesize1/1048576; 
	
	/*
	echo "<br>File Size:<b> ".round($filesizeMb,2)."</b> MB,<br><font color='red'> <b><i>File size is above limit of 2MB</i></b></font>";
	*/
array_push($errors, "File Size: ".round($filesizeMb,2)." MB, <i>File size is above limit of 2MB</i>");	

	$uploadOk1 = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk1 == 0) {
 	array_push($errors, "Sorry, your file was not uploaded."); 
// if everything is ok, try to upload file

} 


else {	

		if(!empty($_FILES["photo"]["name"])&& count($errors) == 0 )
		{
			if (move_uploaded_file($_FILES["photo"]["tmp_name"],"../ProfilePictures/".$filename1)) {
		
			array_push($comments_sent, "The file <b><i>".$_FILES["photo"]["name"]. "</i></b> has been uploaded.");
			
			$filename1 = 'DP-'.$names.'-'.$token.'.'.$extension1;
			$uploadOk1 = 1;
			}
			else{
				array_push($errors, "Sorry,file not uploaded. !!! Please check file size limit.");
				
				$filename1 = "";
				$uploadOk1 = 0;
			}
		}
		else{
			
			array_push($errors, "file ".$_FILES["photo"]["name"]." not uploaded!");
		}			
}

$farmquery = "SELECT * FROM farms WHERE farmID='$farmID'  LIMIT 1";
$result = mysqli_query($db, $farmquery);
$numRows = mysqli_num_rows($result);
while($farm = mysqli_fetch_assoc($result)){
	
$farmName = $farm['farmName'];
$ownerID = $farm['ownerID'];
}

	// register user if there are no errors in the form
if ($uploadOk1 == 1 && count($errors) == 0 ){	
$password = md5($password1);//encrypt the password before saving in the database

$query1 = "INSERT INTO users(
	fname,
	mname, 
	lname, 
	dob,
	phone,
	gender, 
	email,
	password,
	role,
	photo,
	added_by,
	token
		
	)VALUES(
	'$fname',
	'$mname',
	'$lname',
	'$dob',
	'$phone',
	'$gender',
	'$email',
	'$password',
	'$role',
	'$filename1',
	'$added_by',
	'$token'
	
			)";
			
$sql1 = mysqli_query($db, $query1);

$userID = mysqli_insert_id($db);

				if($userID)
				{
						$query2 = "INSERT INTO addresses(
							userID,
							region, 
							district, 
							council,
							ward,
							village, 
							street
								
							)VALUES(
							'$userID',
							'$region',
							'$district',
							'$council',
							'$ward',
							'$village',
							'$street'
									)";
									
						$sql2 = mysqli_query($db, $query2);

									if($sql2)
									{
										array_push($comments_sent, "Address Added Successfully.");
									}
									else
									{
										array_push($comments_failed, "Address failed to be Added!!!");
									}	
							
							
					}
		if($sql1)
				{
						
						array_push($comments_sent, "User Added Successfully.  \t \t Click <a href='../home/login.php?u=".$email."&p=".$password1."' > HERE </a> to login.");

				}
				else
						{
							array_push($comments_failed, "FAILED to Add User, Please check and try again!!");
								
						}



$query3 = "INSERT INTO bookings(
			userID,
			farmID,
			ownerID,
			blockID, 
			startDate,
			endDate
			
			)VALUES(
			'$userID',
			'$farmID',
			'$ownerID',
			'$blockID',
			'$startDate',
			'$endDate'
			
					)";
				
		$sql3 = mysqli_query($db, $query3);

		$bookingID = mysqli_insert_id($db);
			
			if($bookingID)
			{
				$WHT = 0.1;
				$subTotal = $WHT * $totalRent;


				$total_rent_before_tax = $totalRent;
				$tax_rate = $WHT;
				$total = $total_rent_before_tax + $subTotal;
				$paid=NULL;
				$remainder= $total - $paid;

				$query4 = "INSERT INTO invoice_items (
				bookingID,
				blockID,
				farmID,
				ownerID,
				userID,
				rent,
				accres,
				total_rent_before_tax,
				tax_rate,
				totalRent
				)
				VALUES(
				'$bookingID',
				'$blockID',
				'$farmID',
				'$ownerID',
				'$userID',
				'$rent',
				'$accres',
				'$total_rent_before_tax',
				'$tax_rate',
				'$total'
				)";
				$sql4 = mysqli_query($db, $query4);

											if($sql4)
											{
												array_push($comments_sent, "Invoice Generated Succesfuly");
											}
											else
											{
												array_push($comments_failed, "Invoice failed to be generated!!!");
											}
				$query5 ="UPDATE blocks SET blockStatus ='booked' WHERE blockID ='$blockID' ";
				$sql5 = mysqli_query($db, $query5);


		    }
	if($sql3)
			{
				echo "<script>alert('Block Booked Successfully');</script>";
			}
			else
			{
				echo "<script>alert('FAILED to Book block, Please check and try again!!');</script>";
								
			}
		
    }
}






// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

//FUNCTION TO DISPLAY ERROR
function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

//FUNCTION TO DISPLAY LOG REPORT
function display_log_messages() {
	global $logout_messages, $login_messages;

	if (count($logout_messages) > 0){
		echo '<div class="error">';
			foreach ($logout_messages as $logout_message){
				echo $logout_message.'<br>';
			}
		echo '</div>';
	}
	
	else if(count($login_messages) > 0){
		echo '<div class="success">';
			foreach ($login_messages as $login_message){
				echo $login_message.'<br>';
			}
		echo '</div>';
	}
	
}


//FUNCTION TO DISPLAY COMMENT SENT
function comments_sent_report() {
	global $comments_sent , $comments_failed;

	if (count($comments_sent) > 0){
		echo '<div class="success">';
			foreach ($comments_sent as $comment_sent){
				echo $comment_sent.'<br>';
			}
		echo '</div>';
	}
	
	else if (count($comments_failed) > 0){
		echo '<div class="error">';
			foreach ($comments_failed as $comment_failed){
				echo $comment_failed.'<br>';
			}
		echo '</div>';
	}
}

