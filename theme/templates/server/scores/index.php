<?php
	include('../../server/cors.php');
	include('../../server/scores/controller.php');

	$method = $_SERVER['REQUEST_METHOD'];
	$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

	switch ($method) {
	  case 'PUT':
			$data=parse_str( file_get_contents( 'php://input' ), $_PUT );
			foreach ($_PUT as $key => $value){
					unset($_PUT[$key]);
					$_PUT[str_replace('amp;', '', $key)] = $value;
			}
			$_REQUEST = array_merge($_REQUEST, $_PUT);

			if(isset($request) && !empty($request) && $request[0] !== ''){
				$id = $request[0];
				ScoreCtrl::update($id,$_REQUEST);
			}else{
				ScoreCtrl::update($_REQUEST);
			}
	    break;
	  case 'POST':
			ScoreCtrl::create($_POST);
	  		// print_r($_POST);
	    break;
	  case 'GET':
	  	if(isset($request) && !empty($request) && $request[0] !== ''){
	  		$id = $request[0];
			ScoreCtrl::detail($id);
	  	}else{
			ScoreCtrl::read();
	  	}
	    break;
	  case 'DELETE':
	  	if(isset($request) && !empty($request) && $request[0] !== ''){
	  		$id = $request[0];
				ScoreCtrl::delete($id);
	  	}
	    break;
	  default:
	    print json_encode('Events Tabulating System v.0.1 developed by: John Edgar Francisco');
	    break;
	}
	exit();

?>

