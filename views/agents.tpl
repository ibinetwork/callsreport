<link rel="stylesheet" href="/admin/assets/callsreport/css/jquery-ui.css">
<link rel="stylesheet" href="/admin/assets/callsreport/css/jquery.datetimepicker.css">

<div class="fpbx-container" style="margin-top:20px;">

  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation">
      <a href="/admin/config.php?display=callsreport" role="tab"><?php echo _('Calls Report');?></a>
    </li>
    <li role="presentation" class="active">
      <a href="/admin/config.php?display=callsreport&action=agents" role="tab"><?php echo _('Agents Report');?></a>
    </li>
    <li role="presentation">
      <a href="/admin/config.php?display=callsreport&action=scheduling" role="tab"><?php echo _('Scheduling');?></a>
    </li>
  </ul>

  <div class="tab-content display">
    <div role="tabpanel" class="tab-pane active" style="padding-top: 15px;">
        <form class="form-inline" role="form" name="Procurar" method='post'>

          <div class="btn-group pull-right btn-action">
              <button type="submit" value="Procurar" id="Procurar" class="btn btn-primary">
              <i class="glyphicon glyphicon-search "></i> <?php echo _('Search');?></button>
              <?php //if($data_from_session): ?>
                <button type="submit" value="1" name="agents[limpar]" class="btn btn-default">
                <i class="glyphicon glyphicon-remove"></i> <?php echo _('Clean Filter');?></button>
              <?php //endif; ?>
          </div>

          <div class="form-group">
            <small><b><?php echo _('Of');?>:</b></small>
            <input type="text" name="agents[data_inicio]" value="<?php echo $data_inicio; ?>" class="input-sm form-control" style="width: 95px;font-weight:bolder !important;" placehold="Data inicial" />
            <input type="text" name="agents[hora_inicio]" value="<?php echo $hora_inicio; ?>" class="input-sm form-control" style="width: 60px;font-weight:bolder !important;" placehold="Hora inicial" />
          </div>

          <div class="form-group">
            <small><b><?php echo _('Until');?>:</b></small>
            <input type="text" name="agents[data_fim]" value="<?php echo $data_fim; ?>" class="input-sm form-control"  style="width: 95px;font-weight:bolder !important;" placehold="Data final"  />
            <input type="text" name="agents[hora_fim]" value="<?php echo $hora_fim; ?>" class="input-sm form-control" style="width: 60px;font-weight:bolder !important;" placehold="Hora final" />
          </div>

          <br />

          <small><b><?php echo _('Extensions')?>:</b></small>
          <div style="width:100%;height:192px;margin-top:8px;background-color:#f1f1f1;border-top:1px solid #fff;" class="busca_atendentes">
                <div class="col-xs-12" style="padding-left:15px;">
                </div>
                <div class="col-xs-5">
                  <select class="form-control" size="8" id="atendentes_1" multiple="multiple" name="calls[a_ramais][]" style="width:100%;height:150px;">
                      <?php foreach($ramais as $exten_number => $exten_name): ?>
                        <?php //if($selected_exten): ?>
                          <?php if(in_array($exten_number, $sel_atendentes) || in_array('ALL', $sel_atendentes) ):  ?>
                              <option selected value="<?php echo $exten_number; ?>"><?php echo _('Exten');?> <?php echo $exten_number; ?> (<?php echo $exten_name; ?>)</option>
                          <?php else: ?>
                              <option value="<?php echo $exten_number; ?>"><?php echo _('Exten');?> <?php echo $exten_number; ?> (<?php echo $exten_name; ?>)</option>
                          <?php endif; ?>
                        <?php //endif; ?>
                      <?php endforeach;?>
                  </select>
                </div>
                <div class="col-xs-2">
                  <button type="button" id="add_atendentes" class="btn btn-default btn-block">
                    <i class="glyphicon glyphicon-chevron-right"></i>
                  </button>
                  <button type="button" id="remove_atendentes" class="btn btn-default btn-block">
                    <i class="glyphicon glyphicon-chevron-left"></i>
                  </button>
                </div>
                <div class="col-xs-5">
                  <select class="form-control" size="8" id="atendentes_2" multiple="multiple" name="agents[b_atendentes][]" style="width:100%;height:150px;"> </select>
                </div>
          </div>
        </form>
    </div>
  </div>

  <div class="row" style="padding:18px 15px;"></div>
</div>


<table class="table table-striped table-hover table-responsive">
  <thead style="text-align:center;background-color:#f1f1f1;">
        <tr>
            <td rowspan="2">
              <br /><?php echo _('Agent');?>
            </td>
            <td colspan="3" style="border-left:1px solid #d2d2d2;"><?php echo _('Inbound');?></td>
            <td colspan="3" style="border-left:1px solid #d2d2d2;"><?php echo _('Outbound');?></td>
            <td colspan="3" style="border-left:1px solid #d2d2d2;"><?php echo _('Total');?></td>
        </tr>
        <tr>
            <td style="border-left:1px solid #d2d2d2;"><?php echo _('Answer');?></td>
            <td><?php echo _('No Answered');?></td>
            <td><?php echo _('Total');?></td>
            <td style="border-left:1px solid #d2d2d2;"><?php echo _('Answer');?></td>
            <td><?php echo _('No Answered');?></td>
            <td><?php echo _('Total');?></td>
            <td style="border-left:1px solid #d2d2d2;"><?php echo _('Answer');?></td>
            <td><?php echo _('No Answered');?></td>
            <td><?php echo _('Total');?></td>
        </tr>        
  </thead>
  
  <tbody>
      <?php if(count($results) > 0): ?>
        <?php foreach($results['report'] as $agent => $evento) : ?>
          <tr style="text-align:center;">
              <td>
                <b><?php echo $agent; ?></b><br />
                <?php if(isset($ramais[$agent])): ?>
                  <?php echo $ramais[$agent];?>
                <?php endif; ?>                

              </td>
              <td style="border-left:1px solid #d2d2d2;">
                <?php echo $evento['inbound']['answered']; ?>
              </td>
              <td>
                <?php echo $evento['inbound']['noanswered']; ?>
              </td>
              <td>
                <?php echo (isset($evento['inbound']['total']) ? $evento['inbound']['total'] : 0); ?>
              </td>

              <td style="border-left:1px solid #d2d2d2;">
                <?php echo $evento['outbound']['answered']; ?>
              </td>
              <td>
                <?php echo $evento['outbound']['noanswered']; ?>
              </td>
              <td>
                <?php echo (isset($evento['outbound']['total']) ? $evento['outbound']['total'] : 0); ?>
              </td>

              <td style="border-left:1px solid #d2d2d2;">
                <?php echo $evento['totals']['answered']; ?>
              </td>
              <td>
                <?php echo $evento['totals']['noanswered']; ?>
              </td>
              <td>
                <?php echo $evento['totals']['total']; ?>
              </td>              
          </tr>        
        <?php endforeach; ?>

        <tr style="text-align:center;background-color: #f9f9f9 !important; border:1px solid #696969 !important;">
            <td style="border-right:1px solid #d2d2d2;background-color:#f1f1f1;"><b>Totais</b></td>
            <td style="background-color:#f1f1f1;">
              <b><?php echo ($results['totals']['inbound']['answered'] ? $results['totals']['inbound']['answered'] : 0); ?></b>
            </td>
            <td style="background-color:#f1f1f1;">
              <b><?php echo ($results['totals']['inbound']['noanswered'] ? $results['totals']['inbound']['noanswered'] : 0) ; ?></b>
            </td>
            <td style="border-right:1px solid #d2d2d2;background-color:#f1f1f1;">
                <?php $in_noanswered = ($results['totals']['inbound']['noanswered'] ? $results['totals']['inbound']['noanswered'] : 0); ?>
                <?php $in_answered =  ($results['totals']['inbound']['answered'] ? $results['totals']['inbound']['answered'] : 0);?>
                <b><?php echo $in_noanswered + $in_answered; ?></b>
            </td>

            <td style="background-color:#f1f1f1;"><b>
              <?php echo ($results['totals']['outbound']['answered'] ? $results['totals']['outbound']['answered'] : 0); ?>
            </b></td>
            <td style="background-color:#f1f1f1;"><b>
              <?php echo ($results['totals']['outbound']['noanswered'] ? $results['totals']['outbound']['noanswered'] : 0); ?>
            </b></td>
            <td style="border-right:1px solid #d2d2d2;background-color:#f1f1f1;">
                <?php $out_noanswered = ($results['totals']['outbound']['noanswered'] ? $results['totals']['outbound']['noanswered'] : 0); ?>
                <?php $out_answered =  ($results['totals']['outbound']['answered'] ? $results['totals']['outbound']['answered'] : 0);?>              
                <b><?php echo ($out_noanswered + $out_answered); ?></b>
            </td>

            <td style="background-color:#f1f1f1;">
              <b><?php echo ($results['totals']['totals']['answered'] ? $results['totals']['totals']['answered'] : 0); ?></b>
            </td>            
            <td style="background-color:#f1f1f1;">
              <b><?php echo ($results['totals']['totals']['noanswered'] ? $results['totals']['totals']['noanswered'] : 0); ?></b>
            </td>
            <td style="background-color:#f1f1f1;">
              <b><?php echo $in_noanswered + $in_answered + $out_noanswered + $out_answered; ?></b>
            </td>            
        </tr>        

      <?php endif; ?>
  </tbody>
</table>

<hr />

<a href="/admin/config.php?display=callsreport&action=agents&pdf=1" class="btn btn-primary pull-right" target="_blank">
  <?php echo _('Export PDF');?>
</a>


<br />
<?php echo _('Total');?>: <b> <?php echo count($results); ?></b>

<div class="row">
  <div class="col-xs-10 col-sm-10" style="padding-left:0px;">
    <div style="float:left;margin: 0px 10px 0 0;">
      <?php echo $pagination['html']; ?>      
    </div>
  </div>
  <div class="col-xs-2 col-sm-2">
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
  </div>
</div>


<script src="/admin/assets/callsreport/js/jquery.datetimepicker.js"></script>
<script src="/admin/assets/callsreport/js/bootstrap-multiselect.js"></script>

<script type="text/javascript">

  $(document).ready(function() {

        jQuery("input[name='agents[data_inicio]']").datetimepicker({
          timepicker:false,
          format:'d/m/Y',
          lang:'pt'
        });

        jQuery("input[name='agents[data_fim]']").datetimepicker({
          timepicker:false,
          format:'d/m/Y',
          lang:'pt'
        });

        jQuery("input[name='agents[hora_inicio]']").datetimepicker({
          datepicker:false,
          format:'H:i',
          lang:'pt'
        });

        jQuery("input[name='agents[hora_fim]']").datetimepicker({
          datepicker:false,
          format:'H:i',
          lang:'pt'
        });

        $('select[name="num"]').change(function() {
          $('#form_num').submit();
        });

        $('.multiselect').multiselect({
            filterBehavior: 'both'
        });

        $('form').submit(function() {  
          $('#atendentes_2 option').each(function(i) {  
            $(this).attr("selected", "selected");  
          });
          $('#atendentes_1 option').each(function(i) {  
            $(this).attr("selected", "selected");  
          });          
        }); 


        $('#add_atendentes').click(function() {
          return $('#atendentes_1 option:selected').remove().appendTo('#atendentes_2');
        });

        $('#remove_atendentes').click(function() {
          return $('#atendentes_2 option:selected').remove().appendTo('#atendentes_1');
        });

        $('.alert-dismissable').hide();        
        $('#atendentes_1 option:selected').remove().appendTo('#atendentes_2');

  });

</script>