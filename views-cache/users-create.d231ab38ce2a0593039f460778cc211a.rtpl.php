<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Usuários
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/users">Usuários</a></li>
    <li class="active"><a href="/admin/users/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div id="msgDanger" name="msgDanger"  class="alert-danger box box-danger" style="display: none;">
    <div>
      <div id="msgError" name="msgError" class="msgError"></div>
    </div>
  </div>
  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Novo Usuário</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/users/create" method="post">
          <div class="box-body">
            <div class="col col-md-4">
              <div class="form-group">
                <label for="nome">Nome</label><strong class="obrigatorio"> *</strong>
                <input type="text" class="form-control" name="nome" id="nome" onkeyup="convertLowToUpper(nome)" autofocus="autofocus" required>
              </div>
            </div>
            <div class="col col-md-4">
              <div class="form-group">
                <label for="email">Email</label><strong class="obrigatorio"> *</strong>
                <input type="text" class="form-control" name="email" id="email" required>
              </div>
            </div>
            <div class="col col-md-3">
              <label for="inadmin">Acesso ao Sistema</label>
              <div class="checkbox">
                  <input type="checkbox" name="inadmin" value="1"> Acesso de Administrador
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="col col-md-2">
              <div class="form-group">
                <label for="nrocelular">Telefone</label>
                <input type="text" class="form-control" name="nrocelular" id="nrocelular">
              </div>
            </div>
            <div class="col col-md-2">
              <div class="form-group">
                <label for="login">Login</label><strong class="obrigatorio"> *</strong>
                <input type="text" class="form-control" id="login" name="login" placeholder="Digite o login" required>
              </div>
            </div>
            <div class="col col-md-3">
              <div class="form-group">
                <label for="senha">Senha</label><strong class="obrigatorio"> *</strong>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha" required>
              </div>
            </div>
            <div class="col col-md-3">
              <div class="form-group">
                <label for="confirmasenha">Confirma a Senha</label><strong class="obrigatorio"> *</strong>
                <input type="password" class="form-control" id="confirmasenha" onChange="verifyConfPassWord(senha,confirmasenha,msgDanger)" placeholder="Digite a senha novamente" required>
              </div>
            </div>
            <div class="col col-md-2">
              <div class="form-group">
                <label for="classificacao_id">Classificação</label><strong class="obrigatorio"> *</strong>
                <select class="form-control" name="classificacao_id" id="classificacao_id" required>
                  <option value="">Selecione...</option>
                  <?php $counter1=-1;  if( isset($classificacoes) && ( is_array($classificacoes) || $classificacoes instanceof Traversable ) && sizeof($classificacoes) ) foreach( $classificacoes as $key1 => $value1 ){ $counter1++; ?>
                  <option value="<?php echo htmlspecialchars( $value1["classificacao_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            
          </div>
         
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" id="btnSubmit" class="btn btn-success"  style="display: none;">Cadastrar</button>
            <a href="/users?limit=10" class="btn btn-warning">Voltar</a>
            <div class=" pull-right">
              <strong class="obrigatorio"> *</strong> Campos obrigatórios.
            </div>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
