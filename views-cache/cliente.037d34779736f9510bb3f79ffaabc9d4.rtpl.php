<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Clientes
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="/cliente">Clientes</a></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-primary">
      <div class="col form-control top">
        <div class="row">
          <div class="col col-md-4">
            <form action="/cliente/create" method="get">
              <input type="submit" name="cliente" class="btn btn-success" value="Cadastrar Cliente">
              <input type="text" name="cliente" value="cliente" hidden>
            </form>
          </div>
          
          <form action="/cliente" method="get" <?php if( !$clientes ){ ?>hidden<?php } ?>>
            <div class="col col-md-2"></div>
            <div class="col col-md-2"><label for="nome">Nome</label><input type="text" name="nome" id="nome" class="form-control"></div>
            <div class="col col-md-2"><label for="nrocelular">Telefone</label><input type="text" name="nrocelular" id="date_save" class="form-control" onChange="replaceSlash(date_save)"></div>
            <div class="col col-md-1"><label for="limit">Qtde</label>
              <select name="limit" id="limit" class="form-control">
                <option value="10" selected>10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
              </select>
            </div>
            <input type="submit" name="search" class="btn btn-primary" value="Pesquisar">
          </form>
        </div>
      </div>
    </div>
    <div id="msg<?php if( $msg["state"] == 'SUCCESS' ){ ?>-success<?php }else{ ?>-danger<?php } ?>" 
          class="box box-<?php if( $msg["state"] == 'SUCCESS' ){ ?>-success<?php }else{ ?>danger<?php } ?>" 
          <?php if( $msg["state"] != 'SUCCESS' && $msg["state"] != 'ERROR' && $msg["state"] != 'ERROR' ){ ?>readonly hidden<?php } ?>>
      <div class="msg"><input type="text" class="form-control msg-<?php if( $msg["state"] == 'SUCCESS'  ){ ?>success alert-success<?php }else{ ?>danger alert-danger<?php } ?>" name="msg" value="<?php echo htmlspecialchars( $msg["msg"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" ></div>
    </div>
    <div id="msg<?php if( $msgW["state"] == 'WARNING' ){ ?>-warning<?php } ?>" 
          class="box box-<?php if( $msgW["state"] == 'WARNING' ){ ?>-warning<?php } ?>" 
          <?php if( $msgW["state"] != 'WARNING' ){ ?>readonly hidden<?php } ?>>
      <div class="msg"><input type="text" class="form-control msg-<?php if( $msgW["state"] == 'WARNING'  ){ ?>warning alert-warning<?php } ?>" name="msgW" value="<?php echo htmlspecialchars( $msgW["msg"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" ></div>
    </div>
    <!--Paginação-->
    <div class="box box-primary" <?php if( !$pgs ){ ?>hidden<?php } ?>>
      <div class="row">
        <div class="col col-md-12">
          <nav aria-label="Page navigation">
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <?php $i = 1; ?>
              <?php $counter1=-1;  if( isset($pgs) && ( is_array($pgs) || $pgs instanceof Traversable ) && sizeof($pgs) ) foreach( $pgs as $key1 => $value1 ){ $counter1++; ?>
              
              <li><a href="cliente?pg=<?php echo htmlspecialchars( $i, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php if( $pgs["list"]["nome"] ){ ?>&nome=<?php echo htmlspecialchars( $pgs["list"]["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>"><?php echo htmlspecialchars( $i++, ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
              <?php } ?>
              <li>
                <a href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <!--Fim Paginação-->
    <div class="box box-primary" <?php if( !$clientes ){ ?>hidden<?php } ?>>
      <div class="box-body no-padding">
        <table class="table table-straped">
          <thead class="thead-dark">
            <tr class="alert-warning">
              <th>Código</th>
              <th>Nome</th>
              <th>Telefone</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>
            <?php if( $msgW["state"] != 'WARNING' ){ ?>
            <?php $counter1=-1;  if( isset($clientes) && ( is_array($clientes) || $clientes instanceof Traversable ) && sizeof($clientes) ) foreach( $clientes as $key1 => $value1 ){ $counter1++; ?>
            <tr>
              <th><?php echo htmlspecialchars( $value1["pessoa_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></th>
              <td><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td><?php echo htmlspecialchars( $value1["nrocelular"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              <td>
                <a href="/cliente/<?php echo htmlspecialchars( $value1["pessoa_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                <a href="/cliente/<?php echo htmlspecialchars( $value1["pessoa_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            <?php } ?>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <!--Paginação-->
    <div class="box box-primary" <?php if( !$pgs ){ ?>hidden<?php } ?>>
      <div class="row">
        <div class="col col-md-12">
          <nav aria-label="Page navigation">
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <?php $i = 1; ?>
              <?php $counter1=-1;  if( isset($pgs) && ( is_array($pgs) || $pgs instanceof Traversable ) && sizeof($pgs) ) foreach( $pgs as $key1 => $value1 ){ $counter1++; ?>
              <li><a href="cliente?pg=<?php echo htmlspecialchars( $i, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php if( $pgs["list"]["nome"] ){ ?>&nome=<?php echo htmlspecialchars( $pgs["list"]["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>"><?php echo htmlspecialchars( $i++, ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
              <?php } ?>
              <li>
                <a href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <!--Fim Paginação-->
  </section>
</div>
