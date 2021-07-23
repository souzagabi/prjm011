<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Editar de Usuários
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div id="msg-success" class="box box-success" style="display: none;">
        <div>
          <div id="msgSuccess" class="alert-success"></div>
        </div>
      </div>
  		<div id="msgDanger" name="msgDanger"  class="alert-danger box box-danger" style="display: none;">
        <div>
          <div id="msgError" name="msgError" class="msgError"></div>
        </div>
      </div>
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Usuário</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        
        <form role="form" action="/users/<?php echo htmlspecialchars( $user["pessoa_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="box-body">
              <div class="col col-md-4">
                <div class="form-group">
                  <label for="nome">Nome</label><strong class="obrigatorio"> *</strong>
                  <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars( $user["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Digite o nome" required>
                </div>
              </div>
             <div class="col col-md-4">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars( $user["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Digite o Email">
                </div>
              </div>
              <div class="col col-md-3">
                <label for="inadmin">Acesso ao Sistema</label>
                <div class="checkbox">
                    <input type="checkbox" name="inadmin" value="1" <?php if( $user["inadmin"] == 1 ){ ?>checked<?php } ?>> Acesso de Administrador
                </div>
              </div>
            </div>
            <div class="box-body">  
              <div class="col col-md-2">
                <div class="form-group">
                  <label for="nrocelular">Telefone</label><strong class="obrigatorio"> *</strong>
                  <input type="text" class="form-control" id="nrocelular" name="nrocelular" value="<?php echo htmlspecialchars( $user["nrocelular"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Digite o telefone" required>
                </div>
              </div>
              <div class="col col-md-2">
                <div class="form-group">
                  <label for="login">Login</label><strong class="obrigatorio"> *</strong>
                  <input type="text" class="form-control" id="login" name="login" value="<?php echo htmlspecialchars( $user["login"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Digite o login" required>
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
                  <label for="situacao">Situação</label>
                  <select class="form-control" name="situacao" id="situacao">
                    <option value="0"<?php if( $user["situacao"] == 0 ){ ?>selected<?php } ?>>ATIVO</option>
                    <option value="1"<?php if( $user["situacao"] == 1 ){ ?>selected<?php } ?>>INATIVO</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" id="btnSubmit" class="btn btn-success" style="display: none;">Atualizar Usuário&nbsp;&nbsp;<i class="fa fa-save"></i></button>
              <a href="/users?limit=10" class="btn btn-warning">Voltar&nbsp;&nbsp;<i class="fa fa-undo"></i></a>

            </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
