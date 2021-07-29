<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Lord | Lotérica</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../config/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../config/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../config/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="../../config/css/index.css">
  <link rel="shortcut icon" href="../../img/favicon.jpg" type="image/x-icon">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Lord</b> Lotérica
    <img src="../../image/admin2.png" class="img-circle" width="50px" height="50px" class="pull-right" alt="">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <img src="../../image/trevo2.png" width="50px" height="50px" class="pull-left" alt="">
    <img src="../../image/trevo2.png" width="50px" height="50px" class="pull-right" alt="">
    <p class="login-box-msg">Logar para começar sua sessão</p>
    <div id="msg<?php if( $msg["state"] == 'SUCCESS' ){ ?>-success<?php }else{ ?>-danger<?php } ?>" 
          class="box box-<?php if( $msg["state"] == 'SUCCESS' ){ ?>-success<?php }else{ ?>danger<?php } ?>" 
          <?php if( $msg["state"] != 'SUCCESS' && $msg["state"] != 'ERROR' ){ ?>readonly hidden<?php } ?>>
      <div class="msg"><input type="text" class="form-control msg-<?php if( $msg["state"] == 'SUCCESS'  ){ ?>success alert-success<?php }else{ ?>danger alert-danger<?php } ?>" name="msg" value="<?php echo htmlspecialchars( $msg["msg"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" ></div>
    </div>
  		
    <form action="/admin/login" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Login" name="login" autofocus>
        <span class="fa fa-user form-control-feedback"></i></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Digite a Senha" name="senha">
        <span class="fa fa-lock  form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <!-- /.col -->
        <div>
          <button type="submit" class="btn btn-primary form-control">Logar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../../config/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../config/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../config/plugins/iCheck/icheck.min.js"></script>
<script src="../../config/js/funcao.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
