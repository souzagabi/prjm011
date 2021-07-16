<?php 
	session_start();
	require_once("vendor/autoload.php");

	use \Slim\Slim;
	use \PRJM011\Page;
	use \PRJM011\PageAdmin;
	use \PRJM011\PageUser;
	use \PRJM011\PageCliente;
	
	use \PRJM011\Model\Metodo;
	use \PRJM011\Model\User;
	use \PRJM011\Model\Person;
	use \PRJM011\Model\Cliente;
	

	include_once("./config/php/funcao.php");

	date_default_timezone_set('America/Sao_Paulo');

	$app = new Slim();

	$app->config('debug', true);

/*======================================================================================*/
/*										Rotas do Cliente									*/
/*======================================================================================*/

	$app->get('/cliente', function() 
	{
		
		User::verifyLogin();
		
		$company["nome"]	= NULL;
		$company["cliente"]	= NULL;
		
		$msg = ["state"=>'VAZIO', "msg"=> 'VAZIO'];		
		
		if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
			$mess = explode(':', $_GET["msg"]);
			$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
			$_GET["msg"] = '';
		} 

		// if ((isset($_GET["date_save"]) && $_GET["date_save"] != '')) {
		// 	$gget = Metodo::convertDateToDataBase(["date_save"=>$_GET["date_save"]]);

		// 	foreach ($gget as $key => $value) {
		// 		$_GET[$key] = $value;
		// 	}
		// } 
		// if ( (isset($_GET["date_fim"]) && $_GET["date_fim"] != '')) 
		// {
		// 	$gget = Metodo::convertDateToDataBase(["date_fim"=>$_GET["date_fim"]]);

		// 	foreach ($gget as $key => $value) {
		// 		$_GET[$key] = $value;
		// 	}
		// } 

		// foreach ($_GET as $key => $value) {
		// 	$company[$key] = $value;
		// }
		// $company["clientes"]	= "clientes";
		// $clientes = Metodo::selectRegister($company, "Cliente");
		$clientes = [];
		$page = new PageCliente();
		$page->setTpl("cliente", array(
			":Clientes"=>$clientes
		));
	});

	$app->get('/cliente/create', function() 
	{
		User::verifyLogin();
		$classification = cliente::listClassification();
		
		$msg = ["state"=>'VAZIO', "msg"=> 'VAZIO'];
				
		if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
			$mess = explode(':', $_GET["msg"]);
			$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
			$_GET["msg"] = '';
		} 
		
		for ($i=0; $i < 200 ; $i++) 
		{ 
			$j[$i] = $i;
		}
		$date = explode(" ",date('d-m-Y H:i:s'));
		$dt["date"] = $date[0];
		$dt1["hour"] =$date[1];


		$page = new Pagecliente();

		$page->setTpl("cliente-create", array(
			"j"	=>$j,
			"date"	=>$dt,
			"hour"	=>$dt1,
			"classifications" =>$classification,
			"msg" =>$msg,
		));
	});

	$app->post('/cliente/create', function() 
	{
		User::verifyLogin();
		
		$cliente = new cliente();

		$ppost = Metodo::convertDateToDataBase(["daydate"=>$_POST["daydate"]]);

		foreach ($ppost as $key => $value) {
			$_POST[$key] = $value;
		}
		$_POST["user_id"] = $_SESSION["User"]["user_id"];
		
		if (isset($_FILES['image']) && $_FILES['image'] != '') {
			$photo = $_FILES['image']['tmp_name'];
			$tamanho = $_FILES['image']['size'];
			$tipo = $_FILES['image']['type'];
			$nome = $_FILES['image']['name'];

			$fp = fopen($photo, "rb");
			$conteudo = fread($fp, $tamanho);
			$_POST["photo"] = base64_encode($conteudo);

			fclose($fp);
		
		} else {
			$_POST["photo"] = '';
		}
		$cliente->setData($_POST);
		
		$msg = $cliente->save();
				
		header("Location: /cliente/create?msg=".$msg);
		exit;
	});

	$app->get("/cliente/:cliente_id/delete", function ($cliente_id){
		User::verifyLogin();
		$cliente = new cliente();
		$cliente->getById($cliente_id);
		
		$user_id["user_id"] = $_SESSION["User"]["user_id"];
		$cliente->setdata($user_id);
		
		$msg = $cliente->delete();
		
		header("Location: /cliente?msg=".$msg);
		exit;
	});

	$app->get('/cliente/:cliente_id', function($cliente_id) 
	{
		$dir = 'image';
		$classifications = cliente::listClassification();
		
		$cliente = new cliente();
		$cliente->getById($cliente_id);
		
		User::verifyLogin();
		if(!is_dir($dir))
			mkdir($dir, 777);
		
		if ($cliente->getphoto()) {
			$photo = $cliente->getphoto();
			$person_id = $cliente->getperson_id();
			
			$bs64_code = 'data:image/jpg;base64,'.$photo;
			converter_base64_para_imagem($bs64_code, $dir, $person_id);
		}
		
		for ($i=0; $i < 200 ; $i++) 
		{ 
			$j[$i] = $i;
		}

		$page = new Pagecliente();
		
		$page ->setTpl("cliente-update", array(
			"cliente"		=>$cliente->getValues(),
			"j"				=>$j,
			"classifications"=>$classifications
		));
		
	});

	$app->post("/cliente/:person_id", function ($person_id)
	{
		User::verifyLogin();
			
		$cliente = new cliente();
		$cliente->getById($person_id);
		if (isset($_POST)) {
			$ppost = Metodo::convertDateToDataBase(["daydate"=>$_POST["daydate"], "dt_save"=>$_POST["dt_save"]]);
			foreach ($ppost as $key => $value) {
				$_POST[$key] = $value;
			}
			$_POST["user_id"] = $_SESSION["User"]["user_id"];
		}
		if (isset($_FILES['image']) && $_FILES['image'] != '') {
			$photo = $_FILES['image']['tmp_name'];
			$tamanho = $_FILES['image']['size'];
			$tipo = $_FILES['image']['type'];
			$nome = $_FILES['image']['name'];

			$fp = fopen($photo, "rb");
			$conteudo = fread($fp, $tamanho);
			$_POST["photo"] = base64_encode($conteudo);

			fclose($fp);
		}
		$cliente->setData($_POST);
		
		$msg = $cliente->update();
		
		header("Location: /cliente?msg=".$msg);
		exit;
	});

/*======================================================================================*/
/*										Rotas do Admin									*/
/*======================================================================================*/

	$app->get('/admin', function() {

		User::verifyLogin();
		if ($_SESSION["User"]["inadmin"] == '1') {
			$users = User::listAll();

			$msg = ["state"=>'VAZIO', "msg"=> 'VAZIO'];		
			
			if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
				$mess = explode(':', $_GET["msg"]);
				$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
				$_GET["msg"] = '';
			} 

			$page = new PageUser();
			
			$page->setTpl("users", array(
				"users"=> $users,
				"msg"=>$msg
			));
		} else {
			header("Location: /cliente?pg=1&limit=10");
			exit;
		}
	});

	$app->get('/admin/login', function() {
		
		$msg = ["state"=>'VAZIO', "msg"=> 'VAZIO'];
		
		if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
			$mess = explode(':', $_GET["msg"]);
			$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
		}

		$page = new PageAdmin([
			"header"=> false,
			"footer"=> false

		]);
		$page->setTpl("login", array(
			"msg"=>$msg
		));
		
	});

	$app->post('/admin/login', function() {
		
		User::login($_POST["login"], $_POST["senha"]);
		
		header("Location: /cliente");
		exit;
		
	});

	$app->get('/admin/logout', function() {
		
		User::logout();
		header("Location: /admin/login");
		exit;
	});

	$app->get("/admin/forgot", function(){
		$msg = ["state"=>'VAZIO', "msg"=> 'VAZIO'];
		
		if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
			$mess = explode(':', $_GET["msg"]);
			$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
		}

		$page = new PageAdmin([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("forgot", array(
			"msg"=>$msg
		));
	});

	$app->post("/admin/forgot", function(){
		$msg = ["state"=>'VAZIO', "msg"=> 'VAZIO'];
		
		if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
			$mess = explode(':', $_GET["msg"]);
			$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
		}
		
		$user = User::getForgot($_POST["email"]);
		header("Location: /admin/forgot/sent");
		exit;
	});

	$app->get("/admin/forgot/sent", function(){
		
		$msg = ["state"=>'VAZIO', "msg"=> 'VAZIO'];
		
		if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
			$mess = explode(':', $_GET["msg"]);
			$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
		}

		$page = new PageAdmin([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("forgot-sent",array(
			"msg"=>$msg
		));
	});

	$app->get("/admin/forgot/reset", function(){

		$user = User::validForgotDecrypt($_GET["code"]);
		$page = new PageAdmin([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("forgot-reset", array(
			"name"=>$user["nome"],
			"code"=>$_GET["code"]
		));
	});

	$app->post("/admin/forgot/reset", function(){
		
		$_POST['password'] = password_hash($_POST["password"], PASSWORD_DEFAULT, [
			"cost"=>12
			]);
		$forgot = User::validForgotDecrypt($_POST["code"]);
		User::setForgotUsed($forgot["recovery_id"]);
		$user= new User();
		$user->get((int)$forgot["user_id"]);
		$user->setPassword($_POST["password"]);

		$page = new PageAdmin([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("forgot-reset-success");
	});


/*======================================================================================*/
/*										Rotas do Users									*/
/*======================================================================================*/

	$app->get('/users', function() {
		
		User::verifyLogin();
		if ($_SESSION["User"]["inadmin"] == '1') {
			$users = User::listAll();
			
			$msg= '';
			
			if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
				$mess = explode(':', $_GET["msg"]);
				$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
			} else {
				$msg = ["state"=>'', "msg"=> ''];
			}

			$page = new PageUser();
			$page->setTpl("users", array(
				"users"=> $users,
				"msg"=>$msg
			));
		} else {
			header("Location: /cliente?pg=1&limit=10");
			exit;
		}
	});

	$app->get('/users/create', function() {
		
		User::verifyLogin();
		if ($_SESSION["User"]["inadmin"] == '1') {
			$msg = ["state"=>'VAZIO', "msg"=> 'VAZIO'];
		
			if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
				$mess = explode(':', $_GET["msg"]);
				$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
				$_GET["msg"] = '';
			}
			$page = new PageUser();
			$page->setTpl("users-create", array(
				"msg"=>$msg
			));
		} else {
			header("Location: /cliente?pg=1&limit=10");
			exit;
		}
	});
	
	$app->post("/users/create", function (){
		User::verifyLogin();

		$user = new User();

		$date = explode(" ",date('d-m-Y H:i'));
		$dt["daydate"] = $date[0];
		$dt1["hour"] =$date[1];
		$ppost = Metodo::convertDateToDataBase(["daydate"=>$date[0]]);

		foreach ($ppost as $key => $value) {
			$_POST[$key] = $value;
		}

		$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;

		$_POST["situation"] = '0';
		$_POST["photo"] = '';
		$_POST["classification_id"] = '4';
	
		$_POST['pass'] = password_hash($_POST["pass"], PASSWORD_DEFAULT, [
			"cost"=>12
			]);

		$user->setData($_POST);
		
		$msg = $user->save();

		header("Location: /users?msg=$msg");
			exit;
	});

	$app->get("/users/:person_id/delete", function ($person_id){
		User::verifyLogin();
		if ($_SESSION["User"]["inadmin"] == '1') {
			$user = new User();
			$user->get((int)$person_id);

			$msg = $user->delete();
			header("Location: /users?msg=$msg");
			exit;
		} else {
			header("Location: /cliente?pg=1&limit=10");
			exit;
		}
	});

	$app->get("/users/:person_id", function($person_id) {
		User::verifyLogin();
		$user = new User();
 
		$user->get((int)$person_id);
			
		$page = new PageUser();
		
		$page ->setTpl("users-update", array(
			"user"=>$user->getValues()
		));
	});
	
	$app->post("/users/:person_id", function ($person_id){
		User::verifyLogin();
		$user = new User();
		$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;
		$_POST['pass'] = password_hash($_POST["pass"], PASSWORD_DEFAULT, [
			"cost"=>12
			]);
		$user->get((int)$person_id);
		$user->setData($_POST);
		$msg = $user->update();
		
		header("Location: /users?msg=".$msg);
		exit;
		
	});
	
	$app->run();

?>
	

