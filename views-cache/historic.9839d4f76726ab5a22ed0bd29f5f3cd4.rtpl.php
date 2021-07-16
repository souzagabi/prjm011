<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Histórico do Extintor
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="/fireexting">Extintores</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="col form-control top">
          <div class="row">
            <div class="col col-md-4">
              <form action="/historicE/create" method="get">
                <input type="submit" name="btnfireexting" class="btn btn-success" value="Cadastrar Histórico">
                <a href="/fireexting?pg=1" class="btn btn-warning">Voltar</a>
                <input type="text" name="fireexting_id" value="<?php if( $fireextings != NULL ){ ?><?php echo htmlspecialchars( $fireextings["0"]['fireexting_id'], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>" hidden>
              </form>
            </div>
         
          </div>
        </div>
      </div>
      <div id="msg<?php if( $msg["state"] == 'SUCCESS' ){ ?>-success<?php }else{ ?>-danger<?php } ?>" 
            class="box box-<?php if( $msg["state"] == 'SUCCESS' ){ ?>-success<?php }else{ ?>danger<?php } ?>" 
            <?php if( $msg["state"] != 'SUCCESS' && $msg["state"] != 'ERROR' ){ ?>readonly hidden<?php } ?>>
        <div class="msg"><input type="text" class="form-control msg-<?php if( $msg["state"] == 'SUCCESS'  ){ ?>success alert-success<?php }else{ ?>danger alert-danger<?php } ?>" name="msg" value="<?php echo htmlspecialchars( $msg["msg"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" ></div>
      </div>
      <div class="box box-primary" <?php if( $fireextings["0"]['historic_id'] == NULL ){ ?>hidden<?php } ?>>
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
                <li><a href="fireexting?pg=<?php echo htmlspecialchars( $i, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php if( $pgs["list"]["daydate"] ){ ?>&daydate=<?php echo htmlspecialchars( $pgs["list"]["daydate"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?><?php if( $pgs["list"]["date_fim"] ){ ?>&date_fim=<?php echo htmlspecialchars( $pgs["list"]["date_fim"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?><?php if( $pgs["list"]["limit"] ){ ?>&limit=<?php echo htmlspecialchars( $pgs["list"]["limit"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?><?php if( $pgs["list"]["search"] ){ ?>&search=<?php echo htmlspecialchars( $pgs["list"]["search"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>"><?php echo htmlspecialchars( $i++, ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
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
      <div class="box box-primary" <?php if( $fireextings["0"]['historic_id'] == NULL ){ ?>hidden<?php } ?>>
        <div class="box-body no-padding">
          <table class="table table-straped">
            <thead class="thead-dark">
              <tr class="alert-primary">
                <th>Local</th>
                <th>Tipo</th>
                <th>Peso</th>
                <th>Capacidade Extintor</th>
                <th>Data Recarga</th>
              </tr>
            </thead>
            <tbody>
              <?php if( $fireextings["0"]['historic_id'] != NULL ){ ?>
              <tr>
                <td><?php echo htmlspecialchars( $fireextings["0"]['location'], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $fireextings["0"]['tipe'], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $fireextings["0"]['weight'], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $fireextings["0"]['capacity'], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php echo htmlspecialchars( $fireextings["0"]['rechargedate'], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary" <?php if( $fireextings["0"]['historic_id'] == NULL ){ ?>hidden<?php } ?>>
        <div class="box-body no-padding">
          <table class="table table-straped">
            <thead class="thead-dark">
              <tr class="alert-warning">
                <th>Data</th>
                <th>Gatilho</th>
                <th>Mangote</th>
                <th>Difusor</th>
                <th>Pintura</th>
                <th>Teste Hidrostático</th>
                <th>Outros</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody>
              <?php if( $fireextings["0"]['historic_id'] != NULL ){ ?>
              <?php $counter1=-1;  if( isset($fireextings) && ( is_array($fireextings) || $fireextings instanceof Traversable ) && sizeof($fireextings) ) foreach( $fireextings as $key1 => $value1 ){ $counter1++; ?>
              <tr>
                <td><?php echo htmlspecialchars( $value1["daydate"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td><?php if( $value1["htrigger"] == 0 ){ ?>OK<?php }else{ ?>NÃO OK<?php } ?></td>
                <td><?php if( $value1["hose"] == 0 ){ ?>OK<?php }else{ ?>NÃO OK<?php } ?></td>
                <td><?php if( $value1["diffuser"] == 0 ){ ?>OK<?php }else{ ?>NÃO OK<?php } ?></td>
                <td><?php if( $value1["painting"] == 0 ){ ?>OK<?php }else{ ?>NÃO OK<?php } ?></td>
                <td><?php if( $value1["hydrostatic"] == 0 ){ ?>OK<?php }else{ ?>NÃO OK<?php } ?></td>
                <td><?php echo htmlspecialchars( $value1["hothers"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                <td>
                  <a href="/historicE/<?php if( $fireextings["0"]['historic_id'] ){ ?><?php echo htmlspecialchars( $value1["historic_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>" class="btn btn-primary btn-xs" title="Editar Histórico"><i class="fa fa-edit"></i></a>
                  <a href="/historicE/<?php if( $fireextings["0"]['historic_id'] ){ ?><?php echo htmlspecialchars( $value1["historic_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs" title="Excluir Histórico"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              <?php } ?><?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary" <?php if( $fireextings["0"]['historic_id'] == NULL ){ ?>hidden<?php } ?>>
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
                <li><a href="fireexting?pg=<?php echo htmlspecialchars( $i, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php if( $pgs["list"]["daydate"] ){ ?>&daydate=<?php echo htmlspecialchars( $pgs["list"]["daydate"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?><?php if( $pgs["list"]["date_fim"] ){ ?>&date_fim=<?php echo htmlspecialchars( $pgs["list"]["date_fim"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?><?php if( $pgs["list"]["limit"] ){ ?>&limit=<?php echo htmlspecialchars( $pgs["list"]["limit"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?><?php if( $pgs["list"]["search"] ){ ?>&search=<?php echo htmlspecialchars( $pgs["list"]["search"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>"><?php echo htmlspecialchars( $i++, ENT_COMPAT, 'UTF-8', FALSE ); ?></a></li>
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
    </section>
</div>
  