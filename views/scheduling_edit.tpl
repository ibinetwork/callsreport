<link rel="stylesheet" href="/admin/assets/callsreport/css/jquery-ui.css">
<link rel="stylesheet" href="/admin/assets/callsreport/css/jquery.datetimepicker.css">

<div class="fpbx-container" style="margin-top:20px;">

  <?php echo $menus['top']; ?>

  <?php echo $menus['menu']; ?>

  <div class="tab-content display">
    <div role="tabpanel" class="tab-pane active" style="padding-top: 15px;">

    </div>

        <form name="scheduling" method="post">
          <input type="hidden" name="confirm_update" value="1" />
          <input type="hidden" name="scheduling[id]" value="<?php echo $scheduling['id'];?>" />

          <div class="form-group"  style="margin-top:6px;">
            <small><b><?php echo _('Description');?>:</b></small>
            <input type="text" name="scheduling[description]" placeholder="Breve descrição" value="<?php echo $scheduling['description']; ?>" class="form-control" />
          </div>   

          <div class="form-group"  style="margin-top:6px;">
            <small><b><?php echo _('Destination E-mails');?>:</b></small>
            <input type="text" name="scheduling[email]" placeholder="email1@empresa.com.br,email2@empresa.com.br" value="<?php echo $scheduling['email']; ?>"  class="form-control" />
          </div>   


          <div class="form-group"  style="margin-top:6px;">
            <small><b><?php echo _('Report Type');?>:</b></small>
            <select class="dropdown-toggle btn btn-default form-control input-sm" name="scheduling[type]">
                <option value="0" <?php echo ($scheduling['type'] == 0 ? 'selected' : ''); ?>><?php echo _('Calls Report');?></option>
                <option value="1" <?php echo ($scheduling['type'] == 1 ? 'selected' : ''); ?>><?php echo _('Agents Report');?></option>            
            <option value="2"><?php echo _('Queues Report');?></option>
            <option value="3"><?php echo _('Attended Report');?></option>
            <option value="4"><?php echo _('Returned Report');?></option>
            <option value="5"><?php echo _('Ivr Report');?></option>
            </select>
          </div>    

<!--
          <div class="form-group"  style="margin-top:6px;">
            <small><b>Tipo de Chamada:</b></small>
            <br />
            <select class="dropdown-toggle btn btn-default form-control input-sm multiselect" style="display:block;clear:both;" multiple="multiple" name="scheduling[direction]">
                <option value="0" <?php echo ($scheduling['direction'] == 0 ? 'selected' : ''); ?> selected>Originadas</option>
                <option value="1" <?php echo ($scheduling['direction'] == 0 ? 'selected' : ''); ?> selected>Recebidas</option>
            </select>
          </div>  
-->
          <div class="form-group box_exten"  style="margin-top:6px;">
            <small><b><?php echo _('Extensions');?>:</b></small>
            <div style="width:100%;height:192px;margin-top:8px;border-top:1px solid #fff;" class="busca_ramal">
                  <div class="col-xs-12" style="padding-left:15px;">
                    
                  </div>
                  <div class="col-xs-5" style="padding-left:0px;">
                    <select class="form-control" size="8" id="ramais_1" multiple="multiple" name="scheduling[a_ramais][]" style="width:100%;height:150px;">
                        <?php foreach($extens as $exten_number => $exten_name): ?>
                          <?php //if($selected_exten): ?>
                            <?php if(in_array($exten_number, $scheduling['extens']) || in_array('ALL', $scheduling['extens']) ):  ?>
                                <option selected value="<?php echo $exten_number; ?>">Ramal <?php echo $exten_number; ?> (<?php echo $exten_name; ?>)</option>
                            <?php else: ?>
                                <option value="<?php echo $exten_number; ?>">Ramal <?php echo $exten_number; ?> (<?php echo $exten_name; ?>)</option>
                            <?php endif; ?>
                          <?php //endif; ?>
                        <?php endforeach;?>
                    </select>
                  </div>
                  <div class="col-xs-2">
                    <button type="button" id="add_ramais" class="btn btn-default btn-block">
                      <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                    <button type="button" id="remove_ramais" class="btn btn-default btn-block">
                      <i class="glyphicon glyphicon-chevron-left"></i>
                    </button>
                  </div>
                  <div class="col-xs-5" style="padding-right:0px;">
                    <select class="form-control" size="8" id="ramais_2" multiple="multiple" name="scheduling[b_ramais][]"  style="width:100%;height:150px;"></select>
                  </div>
            </div>     
          </div>


      <div class="form-group box_queue"  style="margin-top:6px;display:none;">
        <small><b><?php echo _('Queues');?>:</b></small>
        <br />
        <select class="dropdown-toggle btn btn-default form-control input-sm" name="scheduling[queue]">
          <?php foreach($queues as $queue_id => $queue): ?>
              <?php if($queue_id == $scheduling['queue']):?>
                <option selected value="<?php echo $queue_id ?>"> <?php echo $queue ?> </option>
              <?php else: ?>
                <option value="<?php echo $queue_id ?>"> <?php echo $queue ?> </option>
              <?php endif; ?>                 
          <?php endforeach; ?>
        </select>
      </div>  

      <div class="form-group box_ivr"  style="margin-top:6px;display:none;">
        <small><b><?php echo _('Ivr');?>:</b></small>
        <br />
        <select class="dropdown-toggle btn btn-default form-control input-sm" name="scheduling[ivr]">
          <?php foreach($ivrs as $ivr_id => $ivr): ?>
              <?php if($ivr_id == $scheduling['ivr']):?>
                <option selected value="<?php echo $ivr_id ?>"> <?php echo $ivr ?> </option>
              <?php else: ?>
                <option value="<?php echo $ivr_id ?>"> <?php echo $ivr ?> </option>
              <?php endif; ?>            
          <?php endforeach; ?>
        </select>
      </div>            

          <div class="form-group"  style="margin-top:6px;">
            <small><b><?php echo _('Periodicity');?>:</b></small>
            <br />
            <select class="dropdown-toggle btn btn-default form-control input-sm" name="scheduling[periodicity]">
                <option value="0" <?php echo ($scheduling['periodicity'] == 0 ? 'selected' : ''); ?>><?php echo _('Monthly');?></option>
                <option value="1" <?php echo ($scheduling['periodicity'] == 1 ? 'selected' : ''); ?>><?php echo _('Weekly');?></option>
                <option value="2" <?php echo ($scheduling['periodicity'] == 2 ? 'selected' : ''); ?>><?php echo _('Daily');?></option>
                <option value="3" <?php echo ($scheduling['periodicity'] == 3 ? 'selected' : ''); ?>><?php echo _('Hourly');?></option>
            </select>
          </div>  

          <div class=" mensal">
            <div class="form-group"  style="margin-top:6px;" >
              <small><b><?php echo _('Day');?>:</b></small>
              <br />
              <input type="text" value="<?php echo $scheduling['day'];?>" class="form-control" name="scheduling[day]" />
            </div>  
            <div class="form-group"  style="margin-top:6px;" >
              <small><b><?php echo _('Hour');?>:</b></small>
              <br />
              <select class="form-control" name="scheduling[month_hour]">
                <option value="0" <?php echo ($scheduling['hour'] == 0 ? 'selected' : ''); ?>>00:00</option>
                <option value="1" <?php echo ($scheduling['hour'] == 1 ? 'selected' : ''); ?>>01:00</option>
                <option value="2" <?php echo ($schaduling['hour'] == 2 ? 'selected' : ''); ?>>02:00</option>
                <option value="3" <?php echo ($scheduling['hour'] == 3 ? 'selected' : ''); ?>>03:00</option>
                <option value="4" <?php echo ($scheduling['hour'] == 4 ? 'selected' : ''); ?>>04:00</option>
                <option value="5" <?php echo ($scheduling['hour'] == 5 ? 'selected' : ''); ?>>05:00</option>
                <option value="6" <?php echo ($scheduling['hour'] == 6 ? 'selected' : ''); ?>>06:00</option>
                <option value="7" <?php echo ($scheduling['hour'] == 7 ? 'selected' : ''); ?>>07:00</option>
                <option value="8" <?php echo ($scheduling['hour'] == 8 ? 'selected' : ''); ?>>08:00</option>
                <option value="9" <?php echo ($scheduling['hour'] == 9 ? 'selected' : ''); ?>>09:00</option>
                <option value="10" <?php echo ($scheduling['hour'] == 10 ? 'selected' : ''); ?>>10:00</option>
                <option value="11" <?php echo ($scheduling['hour'] == 11 ? 'selected' : ''); ?>>11:00</option>
                <option value="12" <?php echo ($scheduling['hour'] == 12 ? 'selected' : ''); ?>>12:00</option>
                <option value="13" <?php echo ($scheduling['hour'] == 13 ? 'selected' : ''); ?>>13:00</option>
                <option value="14" <?php echo ($scheduling['hour'] == 14 ? 'selected' : ''); ?>>14:00</option>
                <option value="15" <?php echo ($scheduling['hour'] == 15 ? 'selected' : ''); ?>>15:00</option>
                <option value="16" <?php echo ($scheduling['hour'] == 16 ? 'selected' : ''); ?>>16:00</option>
                <option value="17" <?php echo ($scheduling['hour'] == 17 ? 'selected' : ''); ?>>17:00</option>
                <option value="18" <?php echo ($scheduling['hour'] == 18 ? 'selected' : ''); ?>>18:00</option>
                <option value="19" <?php echo ($scheduling['hour'] == 19 ? 'selected' : ''); ?>>19:00</option>
                <option value="20" <?php echo ($scheduling['hour'] == 20 ? 'selected' : ''); ?>>20:00</option>
                <option value="21" <?php echo ($scheduling['hour'] == 21 ? 'selected' : ''); ?>>21:00</option>
                <option value="22" <?php echo ($scheduling['hour'] == 22 ? 'selected' : ''); ?>>22:00</option>
                <option value="23" <?php echo ($scheduling['hour'] == 23 ? 'selected' : ''); ?>>23:00</option>
                <option value="24" <?php echo ($scheduling['hour'] == 24 ? 'selected' : ''); ?>>24:00</option>
              </select>
            </div>
          </div>


          <div class="semanal" style="display:none">
            <div class="form-group"  style="margin-top:6px;" >
              <small><b><?php echo _('Week Day');?>:</b></small>
              <br />
              <select class="form-control" name="scheduling[week_day]">
                <option value="0" <?php echo ($scheduling['week_day'] == 0 ? 'selected' : ''); ?>>Domingo</option>
                <option value="1" <?php echo ($scheduling['week_day'] == 1 ? 'selected' : ''); ?>>Segunda-feira</option>
                <option value="2" <?php echo ($scheduling['week_day'] == 2 ? 'selected' : ''); ?>>Terça-feira</option>
                <option value="3" <?php echo ($scheduling['week_day'] == 3 ? 'selected' : ''); ?>>Quarta-feira</option>
                <option value="4" <?php echo ($scheduling['week_day'] == 4 ? 'selected' : ''); ?>>Quinta-feira</option>
                <option value="5" <?php echo ($scheduling['week_day'] == 5 ? 'selected' : ''); ?>>Sexta-feira</option>
                <option value="6" <?php echo ($scheduling['week_day'] == 6 ? 'selected' : ''); ?>>Sábado</option>
              </select>

            </div>  
            <div class="form-group"  style="margin-top:6px;" >
              <small><b><?php echo _('Hour');?>:</b></small>
              <br />
              <select class="form-control" name="scheduling[week_hour]">
                <option value="0" <?php echo ($scheduling['hour'] == 0 ? 'selected' : ''); ?>>00:00</option>
                <option value="1" <?php echo ($scheduling['hour'] == 1 ? 'selected' : ''); ?>>01:00</option>
                <option value="2" <?php echo ($scheduling['hour'] == 2 ? 'selected' : ''); ?>>02:00</option>
                <option value="3" <?php echo ($scheduling['hour'] == 3 ? 'selected' : ''); ?>>03:00</option>
                <option value="4" <?php echo ($scheduling['hour'] == 4 ? 'selected' : ''); ?>>04:00</option>
                <option value="5" <?php echo ($scheduling['hour'] == 5 ? 'selected' : ''); ?>>05:00</option>
                <option value="6" <?php echo ($scheduling['hour'] == 6 ? 'selected' : ''); ?>>06:00</option>
                <option value="7" <?php echo ($scheduling['hour'] == 7 ? 'selected' : ''); ?>>07:00</option>
                <option value="8" <?php echo ($scheduling['hour'] == 8 ? 'selected' : ''); ?>>08:00</option>
                <option value="9" <?php echo ($scheduling['hour'] == 9 ? 'selected' : ''); ?>>09:00</option>
                <option value="10" <?php echo ($scheduling['hour'] == 10 ? 'selected' : ''); ?>>10:00</option>
                <option value="11" <?php echo ($scheduling['hour'] == 11 ? 'selected' : ''); ?>>11:00</option>
                <option value="12" <?php echo ($scheduling['hour'] == 12 ? 'selected' : ''); ?>>12:00</option>
                <option value="13" <?php echo ($scheduling['hour'] == 13 ? 'selected' : ''); ?>>13:00</option>
                <option value="14" <?php echo ($scheduling['hour'] == 14 ? 'selected' : ''); ?>>14:00</option>
                <option value="15" <?php echo ($scheduling['hour'] == 15 ? 'selected' : ''); ?>>15:00</option>
                <option value="16" <?php echo ($scheduling['hour'] == 16 ? 'selected' : ''); ?>>16:00</option>
                <option value="17" <?php echo ($scheduling['hour'] == 17 ? 'selected' : ''); ?>>17:00</option>
                <option value="18" <?php echo ($scheduling['hour'] == 18 ? 'selected' : ''); ?>>18:00</option>
                <option value="19" <?php echo ($scheduling['hour'] == 19 ? 'selected' : ''); ?>>19:00</option>
                <option value="20" <?php echo ($scheduling['hour'] == 20 ? 'selected' : ''); ?>>20:00</option>
                <option value="21" <?php echo ($scheduling['hour'] == 21 ? 'selected' : ''); ?>>21:00</option>
                <option value="22" <?php echo ($scheduling['hour'] == 22 ? 'selected' : ''); ?>>22:00</option>
                <option value="23" <?php echo ($scheduling['hour'] == 23 ? 'selected' : ''); ?>>23:00</option>
                <option value="24" <?php echo ($scheduling['hour'] == 24 ? 'selected' : ''); ?>>24:00</option>
              </select>

            </div>
          </div>


          <div class="diario" style="display:none;">
            <div class="form-group"  style="margin-top:6px;" >
              <small><b><?php echo _('Hour');?>:</b></small>
              <br />
              <select class="form-control" name="scheduling[day_hour]">
                <option value="0" <?php echo ($scheduling['hour'] == 0 ? 'selected' : ''); ?>>00:00</option>
                <option value="1" <?php echo ($scheduling['hour'] == 1 ? 'selected' : ''); ?>>01:00</option>
                <option value="2" <?php echo ($scheduling['hour'] == 2 ? 'selected' : ''); ?>>02:00</option>
                <option value="3" <?php echo ($scheduling['hour'] == 3 ? 'selected' : ''); ?>>03:00</option>
                <option value="4" <?php echo ($scheduling['hour'] == 4 ? 'selected' : ''); ?>>04:00</option>
                <option value="5" <?php echo ($scheduling['hour'] == 5 ? 'selected' : ''); ?>>05:00</option>
                <option value="6" <?php echo ($scheduling['hour'] == 6 ? 'selected' : ''); ?>>06:00</option>
                <option value="7" <?php echo ($scheduling['hour'] == 7 ? 'selected' : ''); ?>>07:00</option>
                <option value="8" <?php echo ($scheduling['hour'] == 8 ? 'selected' : ''); ?>>08:00</option>
                <option value="9" <?php echo ($scheduling['hour'] == 9 ? 'selected' : ''); ?>>09:00</option>
                <option value="10" <?php echo ($scheduling['hour'] == 10 ? 'selected' : ''); ?>>10:00</option>
                <option value="11" <?php echo ($scheduling['hour'] == 11 ? 'selected' : ''); ?>>11:00</option>
                <option value="12" <?php echo ($scheduling['hour'] == 12 ? 'selected' : ''); ?>>12:00</option>
                <option value="13" <?php echo ($scheduling['hour'] == 13 ? 'selected' : ''); ?>>13:00</option>
                <option value="14" <?php echo ($scheduling['hour'] == 14 ? 'selected' : ''); ?>>14:00</option>
                <option value="15" <?php echo ($scheduling['hour'] == 15 ? 'selected' : ''); ?>>15:00</option>
                <option value="16" <?php echo ($scheduling['hour'] == 16 ? 'selected' : ''); ?>>16:00</option>
                <option value="17" <?php echo ($scheduling['hour'] == 17 ? 'selected' : ''); ?>>17:00</option>
                <option value="18" <?php echo ($scheduling['hour'] == 18 ? 'selected' : ''); ?>>18:00</option>
                <option value="19" <?php echo ($scheduling['hour'] == 19 ? 'selected' : ''); ?>>19:00</option>
                <option value="20" <?php echo ($scheduling['hour'] == 20 ? 'selected' : ''); ?>>20:00</option>
                <option value="21" <?php echo ($scheduling['hour'] == 21 ? 'selected' : ''); ?>>21:00</option>
                <option value="22" <?php echo ($scheduling['hour'] == 22 ? 'selected' : ''); ?>>22:00</option>
                <option value="23" <?php echo ($scheduling['hour'] == 23 ? 'selected' : ''); ?>>23:00</option>
                <option value="24" <?php echo ($scheduling['hour'] == 24 ? 'selected' : ''); ?>>24:00</option>
              </select>

            </div>
          </div>


          <div class="por_hora" style="display:none;">
            <div class="form-group"  style="margin-top:6px;" >
              <small><b><?php echo _('Period');?>:</b></small>
              <br />
              <select class="form-control" name="scheduling[hour]">
                <option value="1" <?php echo ($scheduling['hour'] == 1 ? 'selected' : ''); ?>> <?php echo _('Hourly');?></option>
                <option value="2" <?php echo ($scheduling['hour'] == 2 ? 'selected' : ''); ?>> <?php echo _('Every two hours');?></option>
                <option value="3" <?php echo ($scheduling['hour'] == 3 ? 'selected' : ''); ?>> <?php echo _('Every three hours');?></option>
                <option value="4" <?php echo ($scheduling['hour'] == 4 ? 'selected' : ''); ?>> <?php echo _('Every four hours');?></option>
                <option value="5" <?php echo ($scheduling['hour'] == 5 ? 'selected' : ''); ?>> <?php echo _('Every five hours');?></option>
                <option value="6" <?php echo ($scheduling['hour'] == 6 ? 'selected' : ''); ?>> <?php echo _('Every six hours');?></option>
                <option value="7" <?php echo ($scheduling['hour'] == 7 ? 'selected' : ''); ?>> <?php echo _('Every seven hours');?></option>
                <option value="8" <?php echo ($scheduling['hour'] == 8 ? 'selected' : ''); ?>> <?php echo _('Every eight hours');?></option>
                <option value="9" <?php echo ($scheduling['hour'] == 9 ? 'selected' : ''); ?>> <?php echo _('Every none hours');?></option>
                <option value="10" <?php echo ($scheduling['hour'] == 10 ? 'selected' : ''); ?>> <?php echo _('Every ten hours');?></option>
                <option value="11" <?php echo ($scheduling['hour'] == 11 ? 'selected' : ''); ?>> <?php echo _('Every eleven hours');?></option>
                <option value="12" <?php echo ($scheduling['hour'] == 12 ? 'selected' : ''); ?>> <?php echo _('Every twelve hours');?></option>
              </select>

            </div>


          <div class="form-group"  style="margin-top:6px;" >
            <small><b><?php echo _('Initial Limit Time');?>:</b></small>
            <br />
            <select class="form-control" name="scheduling[limit_initial]">
              <option value="0" <?php echo ($scheduling['limit_initial'] == 0 ? 'selected' : ''); ?>>00:00</option>
              <option value="1" <?php echo ($scheduling['limit_initial'] == 1 ? 'selected' : ''); ?>>01:00</option>
              <option value="2" <?php echo ($scheduling['limit_initial'] == 2 ? 'selected' : ''); ?>>02:00</option>
              <option value="3" <?php echo ($scheduling['limit_initial'] == 3 ? 'selected' : ''); ?>>03:00</option>
              <option value="4" <?php echo ($scheduling['limit_initial'] == 4 ? 'selected' : ''); ?>>04:00</option>
              <option value="5" <?php echo ($scheduling['limit_initial'] == 5 ? 'selected' : ''); ?>>05:00</option>
              <option value="6" <?php echo ($scheduling['limit_initial'] == 6 ? 'selected' : ''); ?>>06:00</option>
              <option value="7" <?php echo ($scheduling['limit_initial'] == 7 ? 'selected' : ''); ?>>07:00</option>
              <option value="8" <?php echo ($scheduling['limit_initial'] == 8 ? 'selected' : ''); ?>>08:00</option>
              <option value="9" <?php echo ($scheduling['limit_initial'] == 9 ? 'selected' : ''); ?>>09:00</option>
              <option value="10" <?php echo ($scheduling['limit_initial'] == 10 ? 'selected' : ''); ?>>10:00</option>
              <option value="11" <?php echo ($scheduling['limit_initial'] == 11 ? 'selected' : ''); ?>>11:00</option>
              <option value="12" <?php echo ($scheduling['limit_initial'] == 12 ? 'selected' : ''); ?>>12:00</option>
              <option value="13" <?php echo ($scheduling['limit_initial'] == 13 ? 'selected' : ''); ?>>13:00</option>
              <option value="14" <?php echo ($scheduling['limit_initial'] == 14 ? 'selected' : ''); ?>>14:00</option>
              <option value="15" <?php echo ($scheduling['limit_initial'] == 15 ? 'selected' : ''); ?>>15:00</option>
              <option value="16" <?php echo ($scheduling['limit_initial'] == 16 ? 'selected' : ''); ?>>16:00</option>
              <option value="17" <?php echo ($scheduling['limit_initial'] == 17 ? 'selected' : ''); ?>>17:00</option>
              <option value="18" <?php echo ($scheduling['limit_initial'] == 18 ? 'selected' : ''); ?>>18:00</option>
              <option value="19" <?php echo ($scheduling['limit_initial'] == 19 ? 'selected' : ''); ?>>19:00</option>
              <option value="20" <?php echo ($scheduling['limit_initial'] == 20 ? 'selected' : ''); ?>>20:00</option>
              <option value="21" <?php echo ($scheduling['limit_initial'] == 21 ? 'selected' : ''); ?>>21:00</option>
              <option value="22" <?php echo ($scheduling['limit_initial'] == 22 ? 'selected' : ''); ?>>22:00</option>
              <option value="23" <?php echo ($scheduling['limit_initial'] == 23 ? 'selected' : ''); ?>>23:00</option>
              <option value="24" <?php echo ($scheduling['limit_initial'] == 24 ? 'selected' : ''); ?>>24:00</option>
            </select>

          </div>

          <div class="form-group"  style="margin-top:6px;" >
            <small><b><?php echo _('Final Limit Time');?>:</b></small>
            <br />
            <select class="form-control" name="scheduling[limit_final]">
              <option value="0" <?php echo ($scheduling['limit_final'] == 0 ? 'selected' : ''); ?>>00:00</option>
              <option value="1" <?php echo ($scheduling['limit_final'] == 1 ? 'selected' : ''); ?>>01:00</option>
              <option value="2" <?php echo ($scheduling['limit_final'] == 2 ? 'selected' : ''); ?>>02:00</option>
              <option value="3" <?php echo ($scheduling['limit_final'] == 3 ? 'selected' : ''); ?>>03:00</option>
              <option value="4" <?php echo ($scheduling['limit_final'] == 4 ? 'selected' : ''); ?>>04:00</option>
              <option value="5" <?php echo ($scheduling['limit_final'] == 5 ? 'selected' : ''); ?>>05:00</option>
              <option value="6" <?php echo ($scheduling['limit_final'] == 6 ? 'selected' : ''); ?>>06:00</option>
              <option value="7" <?php echo ($scheduling['limit_final'] == 7 ? 'selected' : ''); ?>>07:00</option>
              <option value="8" <?php echo ($scheduling['limit_final'] == 8 ? 'selected' : ''); ?>>08:00</option>
              <option value="9" <?php echo ($scheduling['limit_final'] == 9 ? 'selected' : ''); ?>>09:00</option>
              <option value="10" <?php echo ($scheduling['limit_final'] == 10 ? 'selected' : ''); ?>>10:00</option>
              <option value="11" <?php echo ($scheduling['limit_final'] == 11 ? 'selected' : ''); ?>>11:00</option>
              <option value="12" <?php echo ($scheduling['limit_final'] == 12 ? 'selected' : ''); ?>>12:00</option>
              <option value="13" <?php echo ($scheduling['limit_final'] == 13 ? 'selected' : ''); ?>>13:00</option>
              <option value="14" <?php echo ($scheduling['limit_initial'] == 14 ? 'selected' : ''); ?>>14:00</option>
              <option value="15" <?php echo ($scheduling['limit_final'] == 15 ? 'selected' : ''); ?>>15:00</option>
              <option value="16" <?php echo ($scheduling['limit_final'] == 16 ? 'selected' : ''); ?>>16:00</option>
              <option value="17" <?php echo ($scheduling['limit_final'] == 17 ? 'selected' : ''); ?>>17:00</option>
              <option value="18" <?php echo ($scheduling['limit_final'] == 18 ? 'selected' : ''); ?>>18:00</option>
              <option value="19" <?php echo ($scheduling['limit_final'] == 19 ? 'selected' : ''); ?>>19:00</option>
              <option value="20" <?php echo ($scheduling['limit_final'] == 20 ? 'selected' : ''); ?>>20:00</option>
              <option value="21" <?php echo ($scheduling['limit_final'] == 21 ? 'selected' : ''); ?>>21:00</option>
              <option value="22" <?php echo ($scheduling['limit_final'] == 22 ? 'selected' : ''); ?>>22:00</option>
              <option value="23" <?php echo ($scheduling['limit_final'] == 23 ? 'selected' : ''); ?>>23:00</option>
              <option value="24" <?php echo ($scheduling['limit_final'] == 24 ? 'selected' : ''); ?>>24:00</option>
            </select>
          </div>      


          </div>

          <button type="submit" class="btn btn-primary pull-right" style="margin-left:3px;"><?php echo _('Save');?></button>

          <a href="/admin/config.php?display=callsreport&action=scheduling" class="btn btn-primary pull-right"><?php echo _('Cancel');?></a>

          <br />
          <br />
        </form>   

</div>



<script src="/admin/assets/callsreport/js/jquery.datetimepicker.js"></script>
<script src="/admin/assets/callsreport/js/bootstrap-multiselect.js"></script>
<script src="/admin/assets/callsreport/js/jquery.mask.js"></script>

<script type="text/javascript">

  function changeTypeReport() {

    var type = $('select[name="scheduling[type]"]').val(); 
    
    // queues
    if(type == "2") {
      $('.box_ivr').hide();
      $('.box_queue').show();
      $('.box_exten').hide();
    }
    // atendidas
    else if(type == "3") {
      $('.box_ivr').hide();
      $('.box_queue').hide();
      $('.box_exten').hide();
    }
    // atendidas
    else if(type == "4") {
      $('.box_ivr').hide();
      $('.box_queue').hide();
      $('.box_exten').hide();
    }    
    // ura 
    else if(type == "5") {
      $('.box_ivr').show();
      $('.box_queue').hide();
      $('.box_exten').hide();
    }else{
      $('.box_ivr').hide();
      $('.box_queue').hide();
      $('.box_exten').show();      
    }
  }

  function changePeriodicity() {

    var select = $('select[name="scheduling[periodicity]"]').val();
    if(select == 0) {
      $('.mensal').show();
      $('.semanal').hide();
      $('.diario').hide();
      $('.por_hora').hide();

      $('input[name="scheduling[day]"]').mask('ZY', {
        translation: {
          'Z': {
            pattern: /[0-3]/, optional: true
          },
          'Y': {
            pattern: /[0-9]/, optional: false
          }
        }
      });

      // scheduling[day]
    }
    if(select == 1) {
      $('.mensal').hide();
      $('.semanal').show();
      $('.diario').hide();
      $('.por_hora').hide();
    }
    if(select == 2) {
      $('.mensal').hide();
      $('.semanal').hide();
      $('.diario').show();
      $('.por_hora').hide();
    }
    if(select == 3) {
      $('.mensal').hide();
      $('.semanal').hide();
      $('.diario').hide();
      $('.por_hora').show();
    }    
  }


  $(document).ready(function() {

    $('#add_ramais').click(function() {
      return $('#ramais_1 option:selected').remove().appendTo('#ramais_2');
    });

    $('#remove_ramais').click(function() {
      return $('#ramais_2 option:selected').remove().appendTo('#ramais_1');
    });

    $('form').submit(function() {  
      $('#ramais_2 option').each(function(i) {  
        $(this).attr("selected", "selected");  
      });
    }); 

    $('#ramais_1 option:selected').remove().appendTo('#ramais_2');

    $('.multiselect').multiselect({
        filterBehavior: 'both'
    });

    $('select[name="scheduling[periodicity]"]').change(function() {
      changePeriodicity();
    });

    $('select[name="scheduling[type]"]').change(function() {
      changeTypeReport();
    });    

    $('input[name="scheduling[day]"]').keyup(function() {
      var number = $('input[name="scheduling[day]"]').val();
      if(number > 31) {
        $('input[name="scheduling[day]"]').val(31);
      }
    });

    changePeriodicity();
    changeTypeReport();

    $('.alert-dismissable').hide();     

  });

</script>
