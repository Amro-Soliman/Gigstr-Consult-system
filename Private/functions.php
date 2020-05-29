<?php
// This script is the base script for all functions that is
// included in most pages in this projct.  
session_start();
include_once('../Classes/db.php');
include_once('register.php');
$db = new DB;
function request_is_get() {
	return $_SERVER['REQUEST_METHOD'] === 'GET';
}
function request_is_post() {
	return $_SERVER['REQUEST_METHOD'] === 'POST';
}
function redirect_to($new_location) {
	header( "Location: $new_location" );
	exit;
  }
 
function request_ip_matches_session() {
	// return false if either value is not set
	if(!isset($_SESSION['ip']) || !isset($_SERVER['REMOTE_ADDR'])) {
		return false;
	}
	if($_SESSION['ip'] === $_SERVER['REMOTE_ADDR']) {
		return true;
	} else {
		return false;
	}
}
// Does the request user agent match the stored value?
function request_user_agent_matches_session() {
	// return false if either value is not set
	if(!isset($_SESSION['user_agent']) || !isset($_SERVER['HTTP_USER_AGENT'])) {
		return false;
	}
	if($_SESSION['user_agent'] === $_SERVER['HTTP_USER_AGENT']) {
		return true;
	} else {
		return false;
	}
}
// Has too much time passed since the last login?
function last_login_is_recent() {
	$max_elapsed = 60 * 60 * 24; // 1 day
	// return false if value is not set
	if(!isset($_SESSION['last_login'])) {
		return false;
	}
	if(($_SESSION['last_login'] + $max_elapsed) >= time()) {
		return true;
	} else {
		return false;
	}
}
// Should the session be considered valid?
function is_session_valid() {
	$check_ip = true;
	$check_user_agent = true;
	$check_last_login = true;
	if($check_ip && !request_ip_matches_session()) {
		return false;
	}
	if($check_user_agent && !request_user_agent_matches_session()) {
		return false;
	}
	if($check_last_login && !last_login_is_recent()) {
		return false;
	}
	return true;
}
// If session is not valid, end and redirect to login page.
function confirm_session_is_valid() {
	if(!is_session_valid()) {
		end_session();
		// Note that header redirection requires output buffering 
		// to be turned on or requires nothing has been output 
		// (not even whitespace).
		header("Location: err.php");
		exit;
	}
}
function end_session() {
	// Use both for compatibility with all browsers
	// and all versions of PHP.
	session_unset();
  session_destroy();
}
function admin_logged_in(){
	return (isset($_SESSION['adminId']));
}
// Is user logged in already?
function user_logged_in() {
	return (isset($_SESSION['userId']));
}
// If user is not logged in, end and redirect to login page.
//function confirm_user_logged_in() {
	//if(!user_logged_in()) {
	//	end_session();
		// Note that header redirection requires output buffering 
		// to be turned on or requires nothing has been output 
		// (not even whitespace).
	//	header("Location: err.php");
		//exit;
	//}
//}
// Actions to preform after every successful login
function after_successful_login() {
	// Regenerate session ID to invalidate the old one.
	// Super important to prevent session hijacking/fixation.
	session_regenerate_id(true);
	
	// Save these values in the session, even when checks aren't enabled 
	
}
	
function email_exists($email){
	$db = new DB;
	$stmt = $db->pdo->prepare("SELECT email FROM users WHERE email = '$email';");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
		$emailExists = ($rowcount > 0);
		if($emailExists){
			return TRUE;
		}else{
			return FALSE;
		}
}
function booking_exists($gigstr_id, $gig_id){
	$db = new DB;
	$stmt = $db->pdo->prepare("SELECT gigstr_id FROM gigsPersons WHERE gigstr_id = '$gigstr_id' && shift_id = $gig_id;");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
		$emailExists = ($rowcount > 0);
		if($emailExists){
			return TRUE;
		}else{
			return FALSE;
		}
}

function username_exists($userName){
	$db = new DB;
	$stmt = $db->pdo->prepare("SELECT userName FROM clients WHERE userName = '$userName';");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
		$emailExists = ($rowcount > 0);
		if($emailExists){
			return TRUE;
		}else{
			return FALSE;
		}
}
function oNumber_exists($oNumber){
	$db = new DB;
	$stmt = $db->pdo->prepare("SELECT oNumber FROM clients WHERE oNumber = '$oNumber';");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
		$emailExists = ($rowcount > 0);
		if($emailExists){
			return TRUE;
		}else{
			return FALSE;
		}
}
function get_gigstr_profile_picture($id){
	$db = new DB;
	$stmt = $db->pdo->prepare("SELECT file_name FROM clients WHERE client_id = '$id';");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
		$emailExists = ($rowcount > 0);
		if($emailExists){
			$clientId = $stmt->fetchColumn();		}else{
			return FALSE;
		}
}
function get_pdf_reports_by_client_id($id){
	$db = new DB;
	$stmt = $db->pdo->prepare("SELECT id, PDF_reports FROM files WHERE gig_id = '$id';");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
		$emailExists = ($rowcount > 0);
		if($emailExists){
		$result=	$stmt->fetchAll(PDO::FETCH_ASSOC);
			}else{
			return FALSE;
		}
		return $result;
}
function get_offers_by_client_id($id){
	$db = new DB;
	$stmt = $db->pdo->prepare("SELECT id, offer FROM offers WHERE gig_id = '$id';");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
		$emailExists = ($rowcount > 0);
		if($emailExists){
		$result=	$stmt->fetchAll(PDO::FETCH_ASSOC);
			}else{
			return FALSE;
		}
		return $result;
}

function get_user_by_id($id){
	$db = new DB;
	$stmt = $db->pdo->query("SELECT firstName, lastName FROM users WHERE id = $id;");
	$stmt->execute();
	$rowcount = $stmt->rowCount();
	$userExists = ($rowcount > 0);
	if($userExists){
	$result =	$stmt->fetch(PDO::FETCH_ASSOC);
		
		$output = $result['firstName'] . " " . $result['lastName'];
		
	}
		return $output;
	}

		function get_client_by_id($id){
		$db = new DB;
		$stmt = $db->pdo->query("SELECT firstName, lastName, companyName, companyAdress, tel, email, id FROM clients WHERE id = $id;");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
		$userExists = ($rowcount > 0);
		if($userExists){
		$result =	$stmt->fetch(PDO::FETCH_ASSOC);
	}
			
			return $result;
		}
		function get_gigstr_by_id($id){
			$db = new DB;
			$stmt = $db->pdo->query("SELECT name, tel, email, id, city,description, file_name FROM gigstrs WHERE id = $id;");
			$stmt->execute();
			$rowcount = $stmt->rowCount();
			$userExists = ($rowcount > 0);
			if($userExists){
			$result =	$stmt->fetch(PDO::FETCH_ASSOC);
			if($result){
				return $result;
		}else{
			$result =  '';
		}
		
			}

			}
			function get_gigstrs_by_id($id){
				$db = new DB;
				$stmt = $db->pdo->query("SELECT name, tel, email, id, city,description, file_name FROM gigstrs WHERE id = $id;");
				$stmt->execute();
				$rowcount = $stmt->rowCount();
				$userExists = ($rowcount > 0);
				if($userExists){
				$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
				if($result){
					return $result;
			}else{
				$result =  '';
			}
			
				}
	
				}
			
	
	function get_admin_by_id($id){
		$db = new DB;
		$stmt = $db->pdo->query("SELECT firstName, lastName FROM admins WHERE id = $id;");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
		$adminExists = ($rowcount > 0);
		if($adminExists){
		$result =	$stmt->fetch(PDO::FETCH_ASSOC);
			
	
			$output = $result['firstName'] . " " . $result['lastName'];
			
		}
			return $output;
		}
	
function get_tickets_by_user_id($id){
	$db = new DB;
		$stmt = $db->pdo->query("SELECT * FROM tickets WHERE ticket_holder = $id;");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
		$ticketExists = ($rowcount > 0);
		if($ticketExists){
		$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
			
	
		return $result;
		}
			
		}
	
 function find_user_by_email($email){
	$db = new DB;
	$stmt = $db->pdo->query("SELECT * FROM users WHERE email = '$email' LIMIT 1;");
	$stmt->execute();
	$rowcount = $stmt->rowCount();
		$userExists = ($rowcount > 0);
		if($userExists){
		$user =	$stmt->fetchAll(PDO::FETCH_ASSOC);
			
	
		return $user;
 }
}

function find_client_by_email($email){
	$db = new DB;
	$stmt = $db->pdo->query("SELECT * FROM clients WHERE email = '$email' LIMIT 1;");
	$stmt->execute();
	$rowcount = $stmt->rowCount();
		$userExists = ($rowcount > 0);
		if($userExists){
		$user =	$stmt->fetch(PDO::FETCH_ASSOC);
			
	
		return $user;
 }
}
function find_client_by_username($userName){
	$db = new DB;
	$stmt = $db->pdo->query("SELECT * FROM clients WHERE userName = '$userName' LIMIT 1;");
	$stmt->execute();
	$rowcount = $stmt->rowCount();
		$userExists = ($rowcount > 0);
		if($userExists){
		$user =	$stmt->fetch(PDO::FETCH_ASSOC);
			
	
		return $user;
 }
}

function loginClients($userName, $password) {
	$db = new DB;
	$stmt = $db->pdo->prepare("SELECT id FROM clients WHERE userName = ? AND password = ? ;");
	$stmt->execute(array($userName, $password));
	$rowcount = $stmt->rowCount();
	$userLoggedIn = ($rowcount == 1);
		if ($userLoggedIn) {
		 $clientId = $stmt->fetchColumn();
		
		if($clientId){
			$_SESSION['clientId'] = $clientId;
			return $clientId;
	}
}
} 

function login($email, $password) {
	$db = new DB;
	$stmt = $db->pdo->prepare("SELECT id FROM users WHERE email = ? AND password = ? ;");
	$stmt->execute(array($email, $password));
	$rowcount = $stmt->rowCount();
	$userLoggedIn = ($rowcount == 1);
		if ($userLoggedIn) {
		 $userId = $stmt->fetchColumn();
		
		if($userId){
			$_SESSION['userId'] = $userId;
			return $userId;
	}
}
}  

function get_all_clients(){	
	$db = new DB;
	$stmt = $db->pdo->query("SELECT * FROM clients ORDER BY id DESC; ");
	$stmt->execute();
	$rowcount = $stmt->rowCount();
	$userExists = ($rowcount > 0);
	if($userExists){
	$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
		
return $result;		
	}
}
function get_all_gigstrs(){	
	$db = new DB;
	$stmt = $db->pdo->query("SELECT * FROM gigstrs ORDER BY id DESC; ");
	$stmt->execute();
	$rowcount = $stmt->rowCount();
	$userExists = ($rowcount > 0);
	if($userExists){
	$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
		
return $result;		
	}
}


function add_client($firstName, $lastName, $email, $tel, $client_id) {
$db = new DB;

$sql = "INSERT INTO contacts (firstName, lastName, email, tel, client_id)
VALUES ('$firstName', '$lastName', '$email', '$tel', '$client_id' )";
$stmt = $db->pdo->prepare($sql);
$stmt->execute();
if($stmt){
	redirect_to('../Staff/clientProfile.php?id=' . $client_id );
}else{
        echo 'error';
	}
}
function add_like_unlike($gigstr_id,$client_id,$type){
	$db = new DB;
	$stmt = $db->pdo->query("SELECT COUNT(*) AS cntpost FROM like_unlike WHERE gigstr_id= $gigstr_id and client_id= $client_id;");
	$stmt->execute();

		$result =	$stmt->fetch(PDO::FETCH_ASSOC);
		$count = $result['cntpost'];
		if($count == 0){
			$insertquery = "INSERT INTO like_unlike(gigstr_id,client_id,type) values('$gigstr_id','$client_id','$type')";
			$stmt = $db->pdo->prepare($insertquery);
			$stmt->execute();
		}else {
			$updatequery = "UPDATE like_unlike SET type= $type  where gigstr_id= $gigstr_id and client_id= $client_id";
			$stmt = $db->pdo->prepare($updatequery);
			$stmt->execute();
		}

	


}
function like_unlike_exists($gigstr_id, $client_id){
	$db = new DB;
	$stmt = $db->pdo->prepare("SELECT type FROM like_unlike WHERE gigstr_id = '$gigstr_id' and client_id = $client_id;");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
		if($stmt){
			$result =	$stmt->fetchColumn();
		}return $result;
		}


function add_shift($name, $place, $shiftDate, $start_at, $finish_at,  $gigstrNr,$hours, $gig_id, $client_id) {
	$db = new DB;
	
	$sql = "INSERT INTO shifts (name, place, shift_date, start_at, finish_at, gigstrNr, hours, gig_id, client_ID)
	VALUES ('$name', '$place', '$shiftDate', '$start_at', '$finish_at', '$gigstrNr', '$hours' ,'$gig_id', '$client_id')";
	$stmt = $db->pdo->prepare($sql);
	$stmt->execute();
	if($stmt){
		redirect_to('../Staff/clientProfile.php?id=' . $client_id );	
	}else{
			echo 'error';
		}
	}
	
function add_comment($comment, $gigstr_id, $name) {
	$db = new DB;
	
	$sql = "INSERT INTO comments (comment, gigstr_id, name)
	VALUES ('$comment', '$gigstr_id', '$name' )";
	$stmt = $db->pdo->prepare($sql);
	$stmt->execute();
	if($stmt){
		redirect_to('../Staff/gigstrProfile.php?id=' . $gigstr_id );
	}else{
			echo 'error';
		}
	}
	function add_pdf($gigId, $PDF) {
		$db = new DB;
		
		$sql = "INSERT INTO  files (PDF_reports, gig_id)
		VALUES('$PDF', '$gigId' )";
		$stmt = $db->pdo->prepare($sql);
		// $stmt->bindParam(':PDF', $PDF, PDO::PARAM_STR);    
		// $stmt->bindParam(':gigId', $gigId, PDO::PARAM_INT);      
		$stmt->execute();
		var_dump($stmt);
		if($stmt){
			header("Location: $_SERVER[HTTP_REFERER]");

			echo 'yes';

		//	redirect_to('../Staff/gigstrProfile.php?id=' . $gigstr_id );
		}else{
				echo 'error';
			}
		}
		function add_offers($gigId, $report) {
			$db = new DB;
			
			$sql = "INSERT INTO   offers  (offer,gig_id) 
			VALUES('$report', '$gigId' )";
			$stmt = $db->pdo->prepare($sql);
			// $stmt->bindParam(':PDF', $PDF, PDO::PARAM_STR);    
			// $stmt->bindParam(':gigId', $gigId, PDO::PARAM_INT);      
			$stmt->execute();
			var_dump($stmt);
			if($stmt){
				header("Location: $_SERVER[HTTP_REFERER]");
	
				echo 'yes';
	
			//	redirect_to('../Staff/gigstrProfile.php?id=' . $gigstr_id );
			}else{
					echo 'error';
				}
			}
		function change_status($gigId, $status) {
			$db = new DB;
			
			$sql = "UPDATE  services SET status = '$status' WHERE gig_id = $gigId";
			$stmt = $db->pdo->prepare($sql);
			// $stmt->bindParam(':PDF', $PDF, PDO::PARAM_STR);    
			// $stmt->bindParam(':gigId', $gigId, PDO::PARAM_INT);      
			$stmt->execute();
			var_dump($stmt);
			if($stmt){
			header("Location: $_SERVER[HTTP_REFERER]");
	
				echo 'yes';
	
			//	redirect_to('../Staff/gigstrProfile.php?id=' . $gigstr_id );
			}else{
					echo 'error';
				}
			}
	function add_gig_bokning($gigstr_id, $gig_id, $client, $shift,$shift_date) {
		$db = new DB;
		
		$sql = "INSERT INTO gigsPersons ( gigstr_id, shift_id, client_id,  shift_date)
		VALUES ('$gigstr_id', '$gig_id', '$client',  '$shift_date' )";
		$stmt = $db->pdo->prepare($sql);
		$stmt->execute();
		if($stmt){
		$_SESSION['gigId'] = $gig_id;
		$_SESSION['client'] = $client;
		// $_SESSION['shiftId'] = $shift;



			redirect_to('../Staff/gigstrBokning.php?gigId=' .$_SESSION['gigId'].'&client='.$_SESSION['client']. '&shiftId='.$_SESSION['shiftID'] );
		}else{
				echo 'error';
			}
		}
	
	

function get_contacts_by_client_id($id){
	$db = new DB;
	$stmt = $db->pdo->query("SELECT firstName, lastName, tel, email, id FROM contacts WHERE client_id = $id;");
	$stmt->execute();
	$rowcount = $stmt->rowCount();
	$userExists = ($rowcount > 0);
	if($userExists){
	$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
}else{
	$result = NULL;
}
		
		return $result;
	}
	function get_comments_by_gigstr_id($id){
		$db = new DB;
		$stmt = $db->pdo->query("SELECT comment, name FROM comments WHERE gigstr_id = $id;");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
		$userExists = ($rowcount > 0);
		if($userExists){
		$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
	}else{
		$result = NULL;
	}
			
			return $result;
		}
		function get_gigs_by_client_id($id){
			$db = new DB;
			$stmt = $db->pdo->query("SELECT id, gigName,  client_id FROM gigs WHERE client_id = $id;");
			$stmt->execute();
			$rowcount = $stmt->rowCount();
			$userExists = ($rowcount > 0);
			if($userExists){
			$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
		}else{
			$result = NULL;
		}
			
		return $result;
	}
	function get_liked_gigstrs_by_client_id($id){
		$db = new DB;
		$stmt = $db->pdo->query("SELECT gigstr_id FROM like_unlike WHERE client_id = $id and type = 1;");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
		$userExists = ($rowcount > 0);
		if($userExists){
		$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
	}else{
		$result = NULL;
	}
		
	return $result;
}
		function get_shifts_by_gig_id($id){
			$db = new DB;
			$stmt = $db->pdo->query("SELECT id, name, place, gigstrNr, start_at, shift_date, finish_at, gig_id, gigstrNr FROM shifts WHERE gig_id = $id  ;");
			$stmt->execute();
			$rowcount = $stmt->rowCount();
			$userExists = ($rowcount > 0);
			if($userExists){
			$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
		}else{
			$result = NULL;
		}
				
				return $result;
			}
// 			SELECT *
// FROM shifts
// WHERE MONTH(shift_date) = MONTH(CURRENT_DATE())
			function get_shifts_by_client_id($id){
				$db = new DB;
				$stmt = $db->pdo->query("SELECT id, name, place, gigstrNr, start_at, shift_date, finish_at, gig_id, gigstrNr FROM shifts WHERE client_id = $id;");
				$stmt->execute();
				$rowcount = $stmt->rowCount();
				$userExists = ($rowcount > 0);
				if($userExists){
				$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
			}else{
				$result = NULL;
			}
					
					return $result;
				}
			function get_persons_worked_for_client_by_shift_id($id){
				$db = new DB;
				$stmt = $db->pdo->query("SELECT DISTINCT  gigstr_id FROM gigsPersons WHERE client_id = $id AND CURDATE() > shift_date; ");
				$stmt->execute();
				$rowcount = $stmt->rowCount();
				$userExists = ($rowcount > 0);
				if($userExists){
				$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
			}else{
				$result = NULL;
			}
					
					return $result;
				}
				// function get_persons_worked_for_client_by_shift_id($id){
				// 	$db = new DB;
				// 	$stmt = $db->pdo->query("SELECT DISTINCT a.gigstr_id
				// 	from gigsPersons a
				// 	where (
				// 	  select count(*)
				// 	  from gigsPersons b
				// 	  where a.client_id =  19
				// 	  and  case 
				// 	       when a.shift_date < b.shift_date
				// 	       then a.id < b.id
				// 	       end
				// 	) + 1 = 1
				// 	 ");
				// 	$stmt->execute();
				// 	$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
			
						
				// 	}



// 					select DISTINCT a.gigstr_id
// from gigsPersons a
// where (
//   select count(*)
//   from gigsPersons b
//   where a.client_id = $id
//   and  case 
//        when a.`shift_date` < b.`shift_date`
//        then a.id < b.id
//        end
// ) + 1 = 1

			function get_services_by_gig_id($id){
				$db = new DB;
				$stmt = $db->pdo->query("SELECT name, status FROM services WHERE gig_id = $id;");
				$stmt->execute();
				$rowcount = $stmt->rowCount();
				$userExists = ($rowcount > 0);
				if($userExists){
				$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
			}else{
				$result = NULL;
			}
					
					return $result;
				}
			function get_shift_persons_by_gig_id($shiftId){
				$db = new DB;
				$stmt = $db->pdo->query("SELECT gigstr_id FROM gigsPersons WHERE shift_id = $shiftId;");
				$stmt->execute();
				$rowcount = $stmt->rowCount();
				$userExists = ($rowcount > 0);
				if($userExists){
				$result =	$stmt->fetchAll(PDO::FETCH_ASSOC);
				
					return $result;

				
			}else{
				//$result = null;
			$result = array('result' => '0');
				
			}
					
					return $result;
				
			}
		
	
	function Search($companyName) {
		$db = new DB;
	$stmt = $db->pdo->query("SELECT id, companyName FROM clients WHERE companyName LIKE '%$companyName%' LIMIT 5;");
	$stmt->execute();
	$rowcount = $stmt->rowCount();
	$companyExists = ($rowcount > 0);
	if($companyExists){
	$result =	$stmt->fetchAll();
		return $result;
	}
	}
	function searchGigstrs($name) {
		$db = new DB;
	$stmt = $db->pdo->query("SELECT id, name, file_name FROM gigstrs WHERE name LIKE '%$name%'  LIMIT 5;");
	$stmt->execute();
	$rowcount = $stmt->rowCount();
	$companyExists = ($rowcount > 0);
	if($companyExists){
	$result =	$stmt->fetchAll();
		//if($result){
	return $result;
	}
	}
	//return $result;

	//}
	
	function removeContact($id) {
		$db = new DB;
		$stmt = $db->pdo->query("DELETE  FROM contacts WHERE id = $id;");
		$stmt->execute();
		if($stmt) {
	
			return true;
		}else{
			return false;
		}
		
	}
	function removeShift($shiftId) {
		$db = new DB;
		$stmt = $db->pdo->query("DELETE  FROM shifts WHERE id = $shiftId;");
		$stmt->execute();
		if($stmt) {
	
			return true;
		}else{
			return false;
		}
		
	}
	function removeGigstr($gigstrid, $shiftid) {
		$db = new DB;
		$stmt = $db->pdo->query("DELETE FROM gigsPersons WHERE gigstr_id = $gigstrid && shift_id = $shiftid;");
		$stmt->execute();
		if($stmt) {
	
			return true;
		}else{
			return false;
		}
		
	}
	function removeOffer($gig_id, $id) {
		$db = new DB;
		$stmt = $db->pdo->query("DELETE  FROM offers WHERE gig_id = $gig_id && id = $id;");
		$stmt->execute();
		if($stmt) {
	
			return true;
		}else{
			return false;
		}
		
	}
	function removeReport($gig_id, $id) {
		$db = new DB;
		$stmt = $db->pdo->query("DELETE  FROM files WHERE gig_id = $gig_id && id = $id;");
		$stmt->execute();
		if($stmt) {
	
			return true;
		}else{
			return false;
		}
		
	}
	
	function addClient($firstName,$lastName, $email, $password, $companyName, $companyAdress, $tel, $userName, $oNumber ) {
		$db = new DB;

		$hash = password_hash($password, PASSWORD_DEFAULT);
	$sql = "INSERT INTO clients (firstName, lastName, email, password, companyName, companyAdress, tel, userName, oNumber)
	VALUES ('$firstName', '$lastName', '$email', '$hash', '$companyName', '$companyAdress', '$tel', '$userName', '$oNumber' )";
	$stmt = $db->pdo->prepare($sql);
	$stmt->execute();
	}
	
	function addGigstr($name, $email,  $description, $tel, $city, $fileName ) {
		$db = new DB;

 	$sql = "INSERT INTO gigstrs (name, email, description,  tel,  city, file_name)
	VALUES ('$name', '$email', '$description',  '$tel', '$city', '$fileName'  )";
	$stmt = $db->pdo->prepare($sql);
	$stmt->execute();
	if($stmt){
		redirect_to('../Staff/gigstrsList.php');
	}
	}
	function addService($name, $gig_id ) {
		$db = new DB;

 	$sql = "INSERT INTO services (name, gig_id)
	VALUES ('$name' , '$gig_id' )";
	$stmt = $db->pdo->prepare($sql);
	$stmt->execute();
	if($stmt){
			header("Location: $_SERVER[HTTP_REFERER]");
	}
	}
	
	function addGig($gigName, $client_id) {
		$db = new DB;
		//$datee = date('Y-m-d', strtotime($date)	);
  
 	$sql = "INSERT INTO gigs (gigName, client_id)
	VALUES ('$gigName', '$client_id'  )";
	$stmt = $db->pdo->prepare($sql);
	$stmt->execute();
	if($stmt){
		redirect_to('../Staff/clientProfile.php?id=' . $client_id );
	}
	}
	
	
	function updateClient($firstName, $lastName, $email, $tel, $id) {
		$db = new DB;

		$sql = "UPDATE clients SET firstName=?, lastName=?, email=?, tel=? WHERE id=?";
$stmt= $db->pdo->prepare($sql);
$stmt->execute([$firstName, $lastName, $email, $tel, $id]);
if($stmt){
	redirect_to('../Staff/clientProfile.php?id=' . $id );
}else{
        echo 'error';
	}
}
function find_company_by_oNumber($oNumber){
	$db = new DB;
	$stmt = $db->pdo->query("SELECT * FROM clients WHERE oNumber = '$oNumber' LIMIT 1;");
	$stmt->execute();
	$rowcount = $stmt->rowCount();
		$userExists = ($rowcount > 0);
		if($userExists){
		$user =	$stmt->fetch(PDO::FETCH_ASSOC);
			
	
		return $user;
 }
}

	function get_last_shift_date_per_client_by_shift_id($gigId) {
		$db = new DB;
		$stmt = $db->pdo->query("SELECT shift_date FROM shifts  WHERE gig_id = $gigId GROUP BY shift_date ORDER BY shift_date DESC  ;");
		$stmt->execute();
		$rowcount = $stmt->rowCount();
			$userExists = ($rowcount > 0);
			if($userExists){
			$user =	$stmt->fetchColumn();
				
			}else{
				$user = '';
			}
			return $user;

	}
?>

<!-- HÄR FÅR JAG DET SISTA DATUMET I ETT SPECIFIKT GIG -->

<!-- SELECT  shift_date FROM shifts  WHERE client_id = 19 GROUP BY shift_date ORDER BY shift_date DESC LIMIT 1 -->





<!-- SELECT * FROM shifts	 WHERE shift_date > CURDATE() LIMIT 1 -->




<!-- SELECT shift_date FROM shifts	 WHERE shift_date > CURDATE()  GROUP BY shift_date DESC LIMIT 1 -->
<!-- SELECT shift_date, gig_id FROM shifts  WHERE client_id = 19 AND gig_id = 48 GROUP BY shift_date ORDER BY shift_date DESC LIMIT 1 -->