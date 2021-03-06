<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="box box-success title" style="background-color: #d5f8da;">
    <h4>
      Cadastro de Clientes
    </h4>
  </div>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/cliente">Cliente</a></li>
    <li class="active"><a href="/cliente/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
      <div id="msg<?php if( $msg["state"] == 'SUCCESS' ){ ?>-success<?php }else{ ?>-danger<?php } ?>" 
          class="box box-<?php if( $msg["state"] == 'SUCCESS' ){ ?>-success<?php }else{ ?>danger<?php } ?>" 
          <?php if( $msg["state"] != 'SUCCESS' && $msg["state"] != 'ERROR' ){ ?>readonly hidden<?php } ?>>
          <div class="msg"><input type="text" class="form-control msg-<?php if( $msg["state"] == 'SUCCESS'  ){ ?>success alert-success<?php }else{ ?>danger alert-danger<?php } ?>" name="msg" value="<?php echo htmlspecialchars( $msg["msg"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" ></div>
      </div>
  		<div class="box box-success">
        <!-- form start -->
        
        <form role="form" action="/cliente/create" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="col col-md-4">
              <div class="form-group">
                <label for="nome">Nome</label><strong class="obrigatorio"> *</strong>
                <input type="text" class="form-control" name="nome" id="nome" onkeyup="convertLowToUpper(nome)" autofocus="autofocus" required>
              </div>
            </div>
            <div class="col col-md-2">
              <div class="form-group">
                <label for="nrocelular">Telefone</label><strong class="obrigatorio"> *</strong>
                <input type="text" class="form-control" name="nrocelular" id="nrocelular" maxlength="11" required>
              </div>
            </div>
            <div class="col col-md-2">
              <div class="form-group">
                <label for="classificacao_id">Classifica????o</label><strong class="obrigatorio"> *</strong>
                <select class="form-control" name="classificacao_id" id="classificacao_id" required>
                  <?php $counter1=-1;  if( isset($classificacoes) && ( is_array($classificacoes) || $classificacoes instanceof Traversable ) && sizeof($classificacoes) ) foreach( $classificacoes as $key1 => $value1 ){ $counter1++; ?>
                  <?php if( $value1["classificacao_id"] == 3 ){ ?>
                  <option value="<?php echo htmlspecialchars( $value1["classificacao_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" id="compra" class="btn btn-success" >Cadastrar Cliente&nbsp;&nbsp;<i class="fa fa-save"></i></button>
            
            <a href="/cliente?limit=10" class="btn btn-warning">Voltar&nbsp;&nbsp;<i class="fa fa-undo"></i></a>
            
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
