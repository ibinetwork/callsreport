<link rel="stylesheet" href="/admin/assets/callsreport/css/gnovit.css">
<link rel="stylesheet" href="/admin/assets/callsreport/css/jquery-ui.css">
<link rel="stylesheet" href="/admin/assets/callsreport/css/jquery.datetimepicker.css">

<div class="fpbx-container" style="margin-top:20px;">

  <?php echo $menus['top']; ?>
  
  <?php echo $menus['menu']; ?>

  <div class="tab-content display">
    <div role="tabpanel" class="tab-pane active" style="padding-top: 15px;">
        <form class="form-inline" role="form" name="Procurar" method='post'>

          <div class="btn-group pull-right btn-action">
              <button type="submit" value="Procurar" id="Procurar" class="btn btn-primary">
              <i class="glyphicon glyphicon-search "></i> <?php echo _('Search');?></button>
              <?php //if($data_from_session): ?>
                <button type="submit" value="1" name="ura[limpar]" class="btn btn-default">
                <i class="glyphicon glyphicon-remove"></i> <?php echo _('Clean Filter');?></button>
              <?php //endif; ?>
          </div>

          <div class="form-group">
            <small><b><?php echo _('Of');?>:</b></small>
            <input type="text" name="ura[data_inicio]" value="<?php echo $data_inicio; ?>" class="input-sm form-control" style="width: 95px;font-weight:bolder !important;" placehold="Data inicial" />
            <input type="text" name="ura[hora_inicio]" value="<?php echo $hora_inicio; ?>" class="input-sm form-control" style="width: 60px;font-weight:bolder !important;" placehold="Hora inicial" />
          </div>

          <div class="form-group">
            <small><b><?php echo _('Until');?>:</b></small>
            <input type="text" name="ura[data_fim]" value="<?php echo $data_fim; ?>" class="input-sm form-control"  style="width: 95px;font-weight:bolder !important;" placehold="Data final"  />
            <input type="text" name="ura[hora_fim]" value="<?php echo $hora_fim; ?>" class="input-sm form-control" style="width: 60px;font-weight:bolder !important;" placehold="Hora final" />
          </div>

          <div class="form-group">
            <small style="float:left;margin-top:8px;margin-right:4px;"><b><?php echo _('IVR');?>:</b></small>
            <select class="form-control" id="ura"  name="ura[ura]" style="float:right;">
                <?php foreach($ivrs as $ivr_id => $ivr): ?>
                    <?php if(in_array($ivr_id, $sel_ivr) || in_array('ALL', $sel_ivr) ):  ?>
                        <option selected value="<?php echo $ivr_id; ?>"><?php echo _('IVR');?> <?php echo $ivr; ?></option>
                    <?php else: ?>
                        <option value="<?php echo $ivr_id; ?>"><?php echo _('IVR');?> <?php echo $ivr; ?></option>
                    <?php endif; ?>

                <?php endforeach;?>
            </select>
          </div>          

          <br />
        </form>
    </div>
  </div>

  <div class="row" style="padding:18px 15px;"></div>

  <?php if(count($results['result']) > 0): ?>

    <div class="row" style="margin-left:5px;">
      <h2><?php echo _('Queue'); ?>: <?php echo $results['ura'];?> </h2>
    </div>

    <div class="row" style="border:1px solid #d2d2d2;margin:0 5px;text-align:center;">
      <div class="col-md-4" style="padding-top:10px;">
        <div id="grafico_ura_msg" > </div>
        <canvas id="grafico_ura" > </canvas>
      </div>
      <div class="col-md-8">
        <table class="table table-striped">
            <thead>
              <tr>
                <td><b><?php echo _('Choice'); ?></b></td>
                <td><b><?php echo _('Description'); ?></b></td>
                <td><b><?php echo _('Total'); ?></b></td>
              </tr>
            </thead>
            <tbody>
              <?php foreach($results['result'] as $res): ?>
              <tr>
                <td> <span class="label label-default" style="background-color:<?php echo $res['cor'];?>;margin-right:10px;"> </span>   # <?php echo $res['item']; ?></td>
                <td><?php echo $res['descricao']; ?></td>
                <td><b><?php echo $res['total']; ?></b></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
      </div>
    </div>
    <hr />
    <a href="/admin/config.php?display=callsreport&action=report&report=ura&pdf=1" class="btn btn-primary export-pdf pull-right" target="_blank">
      <?php echo _('Export PDF');?>
    </a>

  <?php else: ?>

    <div class="alert alert-info" style="padding:20px 10px;">
        <?php echo _('No data found'); ?>
    </div>

  <?php endif; ?>

<div class="row">
  <div class="col-xs-10 col-sm-10" style="padding-left:0px;">
    <div style="float:left;margin: 0px 10px 0 0;">
      <?php echo $pagination['html']; ?>      
    </div>
  </div>
<!--   <div class="col-xs-2 col-sm-2">
    <form method="post" id="form_num">
      <div class="input-group-btn pull-right" style="float:right;width:85px;">      
        <select class="form-control input-sm" style="margin-left:-47px;width:100px;float:left;height:30px;margin-top:24px;" name="num" value="<?php echo $num; ?>">
          <option <?php echo ($num == 10 ? 'selected' : '');?>>10</option>
          <option <?php echo ($num == 50 ? 'selected' : '');?>>50</option>
          <option <?php echo ($num == 100 ? 'selected' : '');?>>100</option>
          <option <?php echo ($num == 200 ? 'selected' : '');?>>200</option>
          <option <?php echo ($num == 300 ? 'selected' : '');?>>300</option>
          <option <?php echo ($num == 500 ? 'selected' : '');?>>500</option>
          <option <?php echo ($num == 1000 ? 'selected' : '');?>>1000</option>
        </select>
        <button class="btn btn-primary btn-sm" type="submit" style="margin-top:24px;height:30px;"> <i class="glyphicon glyphicon-th-list"> </i></button>
      </div>
    </form>    
  </div> -->
</div>


<script src="/admin/assets/callsreport/js/jquery.datetimepicker.js"></script>
<script src="/admin/assets/callsreport/js/bootstrap-multiselect.js"></script>
<script src="/admin/assets/callsreport/js/charts-2.0.1/Chart.min.js"></script>

<script type="text/javascript">

  var splayer = false;
  
	$(document).ready(function() {

        $('.alert-dismissable').hide();

        jQuery("input[name='ura[data_inicio]']").datetimepicker({
          timepicker:false,
          format:'d/m/Y',
          lang:'pt'
        });

        jQuery("input[name='ura[data_fim]']").datetimepicker({
          timepicker:false,
          format:'d/m/Y',
          lang:'pt'
        });

        jQuery("input[name='ura[hora_inicio]']").datetimepicker({
          datepicker:false,
          format:'H:i',
          lang:'pt'
        });

        jQuery("input[name='ura[hora_fim]']").datetimepicker({
          datepicker:false,
          format:'H:i',
          lang:'pt'
        });

      <?php if($results['result']): ?>

        <?php $labels = array(); ?>
        <?php $dados = array(); ?>
        <?php $colors = array(); ?>
        <?php $has_data = array(); ?>

        <?php foreach($results['result'] as $res): ?>
            <?php $colors[] = "'{$res['cor']}'"; ?>
            <?php $labels[] = "'{$res['item']} - {$res['descricao']}'"; ?>
            <?php $dados[] = $res['total']; ?>
            <?php if($res['total'] > 0): ?>
              <?php $has_data = true; ?>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if($has_data): ?>
          var data = {
              labels: [<?php echo implode(',', $labels); ?>],
              datasets: [
                  {
                      data: [<?php echo implode(',', $dados); ?>],
                      backgroundColor: [<?php echo implode(',', $colors); ?>],
                      hoverBackgroundColor: [<?php echo implode(',', $colors); ?>]
                  }]
          };

          var ctx = document.getElementById("grafico_ura").getContext("2d");
          var options = {
              scale: {
                  reverse: true,
                  ticks: {
                      beginAtZero: true
                  }
              },
              legend: {
                  display: false
              },
            }
          var myPieChart = new Chart(ctx,{
              type: 'pie',
              data: data,
              options: options
          });
          <?php else:  ?>

            $('#grafico_ura_msg').html('<div class="alert alert-info" style="margin-top:35px;"><?php echo _('No data found'); ?> </div>');
            $('.export-pdf').hide();
            
          <?php endif;  ?>

      <?php endif;  ?>



  });

</script>
