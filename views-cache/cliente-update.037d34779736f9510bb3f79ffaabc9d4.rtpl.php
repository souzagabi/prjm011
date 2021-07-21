<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="box box-success title" style="background-color: #d5f8da;">
    <h4>
      Edição de Cliente
    </h4>
  </div>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/cliente">Clientes</a></li>
    <li class="active"><a href="/cliente/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <!-- form start -->
        
        <form role="form" action="/cliente/<?php echo htmlspecialchars( $cliente["pessoa_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="col col-md-4">
              <div class="form-group">
                <label for="nome">Nome</label><strong class="obrigatorio"> *</strong>
                <input type="text" class="form-control" name="nome" id="nome" onkeyup="convertLowToUpper(nome)" value="<?php echo htmlspecialchars( $cliente["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" autofocus="autofocus" required>
              </div>
              
            </div>
            <div class="col col-md-2">
              <div class="form-group">
                <label for="nrocelular">Telefone</label>
                <input type="text" class="form-control" name="nrocelular" id="nrocelular" value="<?php echo htmlspecialchars( $cliente["nrocelular"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" maxlength="11" required>
              </div>
            </div>
            <div class="col col-md-2">
              <div class="form-group">
                <label for="classificacao_id">Classificação</label><strong class="obrigatorio"> *</strong>
                <select class="form-control" name="classificacao_id" id="classificacao_id" required>
                  <?php $counter1=-1;  if( isset($classificacoes) && ( is_array($classificacoes) || $classificacoes instanceof Traversable ) && sizeof($classificacoes) ) foreach( $classificacoes as $key1 => $value1 ){ $counter1++; ?>
                  <?php if( $value1["classificacao_id"] == 3 ){ ?>
                  <option value="<?php echo htmlspecialchars( $value1["classificacao_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col col-md-2">
              <div class="form-group">
                <?php if( $_SESSION['User']["inadmin"] == 1 ){ ?>
                <label for="situacao">Situação</label>
                <select class="form-control" name="situacao" id="situacao">
                  <option value="0"<?php if( $cliente["situacao"] == 0 ){ ?>selected<?php } ?>>ATIVO</option>
                  <option value="1"<?php if( $cliente["situacao"] == 1 ){ ?>selected<?php } ?>>INATIVO</option>
                </select>
                <?php } ?>
              </div>
            </div>
          </div>
         
          <!-- /.box-body -->
          <div class="box-footer">
            <input type="submit" id="compra" class="btn btn-success" value="Atualizar Visita">
            
            <a href="/cliente?limit=10" class="btn btn-warning">Voltar</a>
            
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
