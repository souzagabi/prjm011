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
		
		$company["nome"]		= NULL;
		$company["cliente"]		= NULL;
		$company["search"]		= NULL;
		$company["nrocelular"]	= NULL;
		
		
		$msg = ["state"=>'VAZIO', "msg"=> 'VAZIO'];		
		$msgW = ["state"=>'VAZIO', "msg"=> 'VAZIO'];		
		
		if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
			$mess = explode(':', $_GET["msg"]);
			$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
			$_GET["msg"] = '';
		} 
		
		foreach ($_GET as $key => $value) {
			$company[$key] = $value;
		}
		
		if (isset($_GET["search"])) {
			$company["search"] 		= "search";

		} 
		$company["cliente"]	= "cliente";
		
		$clientes = Metodo::selectRegister($company);
		
		if (isset($clientes[0][0]["MESSAGE"])) {
			$msgW = ["state"=>'WARNING', "msg"=> $clientes[0][0]["MESSAGE"]];
		}
		
		$page = new PageCliente();
		
		$page->setTpl("cliente", array(
			"clientes"=>$clientes[0],
			"pgs"=>$clientes[1],
			"msg"=>$msg,
			"msgW"=>$msgW
		));

	});

	$app->get('/cliente/create', function() 
	{
		User::verifyLogin();
		$classificacoes = Cliente::listClassification();
		
		$msg = ["state"=>'VAZIO', "msg"=> 'VAZIO'];
				
		if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
			$mess = explode(':', $_GET["msg"]);
			$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
			$_GET["msg"] = '';
		} 
		
		$page = new PageCliente();

		$page->setTpl("cliente-create", array(
			"classificacoes" =>$classificacoes,
			"msg" =>$msg,
		));
	});

	$app->post('/cliente/create', function() 
	{
		User::verifyLogin();
		
		$cliente = new Cliente();

		$_POST["usuario_id"] = $_SESSION["User"]["usuario_id"];
		
		$cliente->setData($_POST);
		
		$msg = $cliente->save();
				
		header("Location: /cliente/create?msg=".$msg);
		exit;
	});

	$app->get("/cliente/:cliente_id/delete", function ($cliente_id){
		User::verifyLogin();
		$cliente = new Cliente();
		$cliente->get($cliente_id);
		
		$usuario_id["usuario_id"] = $_SESSION["User"]["usuario_id"];
		$cliente->setdata($usuario_id);
		
		$msg = $cliente->delete();
		
		header("Location: /cliente?msg=".$msg);
		exit;
	});

	$app->get('/cliente/:cliente_id', function($cliente_id) 
	{
		User::verifyLogin();
		$classificacoes = Cliente::listClassification();
		
		$cliente = new Cliente();
		$cliente->get($cliente_id);
		
		
		$page = new PageCliente();
		
		$page ->setTpl("cliente-update", array(
			"cliente"		=>$cliente->getValues(),
			"classificacoes"=>$classificacoes
		));
		
	});

	$app->post("/cliente/:pessoa_id", function ($pessoa_id)
	{
		User::verifyLogin();
			
		$cliente = new Cliente();
		$cliente->get($pessoa_id);

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

		$company["usuario"]		= NULL;

		if ($_SESSION["User"]["inadmin"] == '1') {
			
			$msg= '';
			
			if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
				$mess = explode(':', $_GET["msg"]);
				$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
			} else {
				$msg = ["state"=>'', "msg"=> ''];
			}
			$company["usuario"]		= 'usuario';

			$users = Metodo::selectRegister($company);
			
			$page = new PageUser();
			$page->setTpl("users", array(
				"users"=> $users[0],
				"pgs"=> $users[1],
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

		$company["usuario"]		= NULL;

		if ($_SESSION["User"]["inadmin"] == '1') {
			
			$msg= '';
			
			if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
				$mess = explode(':', $_GET["msg"]);
				$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
			} else {
				$msg = ["state"=>'', "msg"=> ''];
			}
			$company["usuario"]		= 'usuario';

			$users = Metodo::selectRegister($company);
			if (isset($users[0][0]["MESSAGE"])) {
				$msg = ["state"=>'WARNING', "msg"=> $users[0][0]["MESSAGE"]];
			}
			
			$page = new PageUser();
			$page->setTpl("users", array(
				"users"=> $users[0],
				"pgs"=> $users[1],
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
			
			$classificacoes = Cliente::listClassification();
			
			$msg = ["state"=>'VAZIO', "msg"=> 'VAZIO'];
		
			if ((isset($_GET["msg"]) && $_GET["msg"] != '')) {
				$mess = explode(':', $_GET["msg"]);
				$msg = ["state"=>$mess[0], "msg"=> $mess[1]];
				$_GET["msg"] = '';
			}
			$page = new PageUser();

			$page->setTpl("users-create", array(
				"classificacoes"=>$classificacoes,
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

		$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;
		$_POST["usuario_id"] = $_SESSION["User"]["usuario_id"]; 

		$_POST['senha'] = password_hash($_POST["senha"], PASSWORD_DEFAULT, [
			"cost"=>12
			]);

		$user->setData($_POST);
		
		$msg = $user->save();

		header("Location: /users?msg=$msg");
			exit;
	});

	$app->get("/users/:pessoa_id/delete", function ($pessoa_id){
		User::verifyLogin();
		if ($_SESSION["User"]["inadmin"] == '1') {
			$user = new User();
			$user->get((int)$pessoa_id);

			$msg = $user->delete();
			header("Location: /users?msg=$msg");
			exit;
		} else {
			header("Location: /cliente?pg=1&limit=10");
			exit;
		}
	});

	$app->get("/users/:pessoa_id", function($pessoa_id) {
		User::verifyLogin();
		$user = new User();
 
		$user->get((int)$pessoa_id);
			
		$page = new PageUser();
		
		$page ->setTpl("users-update", array(
			"user"=>$user->getValues()
		));
	});
	
	$app->post("/users/:pessoa_id", function ($pessoa_id){
		User::verifyLogin();
		$user = new User();
		$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;
		$_POST['senha'] = password_hash($_POST["senha"], PASSWORD_DEFAULT, [
			"cost"=>12
			]);
		$user->get((int)$pessoa_id);
		$user->setData($_POST);
		$msg = $user->update();
		
		header("Location: /users?msg=".$msg);
		exit;
		
	});
	
	$app->run();

?>
	