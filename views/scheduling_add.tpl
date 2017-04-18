<link rel="stylesheet" href="/admin/assets/callsreport/css/jquery-ui.css">
<link rel="stylesheet" href="/admin/assets/callsreport/css/jquery.datetimepicker.css">

<div class="fpbx-container" style="margin-top:20px;">

  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation">
      <a href="/admin/config.php?display=callsreport" role="tab">Relatório de Chamadas</a>
    </li>
    <li role="presentation">
      <a href="/admin/config.php?display=callsreport&action=agents" role="tab">Relatório de Agentes</a>
    </li>
    <li role="presentation" class="active">
      <a href="/admin/config.php?display=callsreport&action=scheduling" role="tab">Agendamentos</a>
    </li>
  </ul>

  <div class="tab-content display">
    <div role="tabpanel" class="tab-pane active" style="padding-top: 15px;">

    </div>

    <form name="scheduling" method="post">

      <div class="form-group"  style="margin-top:6px;">
        <small><b>Descrição:</b></small>
        <input type="text" name="scheduling[description]" placeholder="Breve descrição"  class="form-control" />
      </div>   

      <div class="form-group"  style="margin-top:6px;">
        <small><b>E-mail(s) Destino:</b></small>
        <input type="text" name="scheduling[email]" placeholder="email1@empresa.com.br,email2@empresa.com.br" class="form-control" />
      </div>   

      <div class="form-group"  style="margin-top:6px;">
        <small><b>Tipo de Relatório:</b></small>
        <select class="dropdown-toggle btn btn-default form-control input-sm" name="scheduling[type]">
            <option value="0">Relatório de Chamadas</option>
            <option value="1">Relatório de Agentes</option>            
        </select>
      </div>    
<!--
      <div class="form-group"  style="margin-top:6px;">
        <small><b>Tipo de Chamada:</b></small>
        <br />
        <select class="dropdown-toggle btn btn-default form-control input-sm multiselect" style="display:block;clear:both;" multiple="multiple" name="scheduling[direction]">
            <option value="0" selected>Originadas</option>
            <option value="1" selected>Recebidas</option>
        </select>
      </div>  
-->
      <div class="form-group"  style="margin-top:6px;">
        <small><b>Ramais:</b></small>
        <div style="width:100%;height:192px;margin-top:8px;border-top:1px solid #fff;" class="busca_ramal">
              <div class="col-xs-12" style="padding-left:15px;">
                
              </div>
              <div class="col-xs-5" style="padding-left:0px;">
                <select class="form-control" size="8" id="ramais_1" multiple="multiple" name="scheduling[a_ramais][]" style="width:100%;height:150px;">
                    <?php foreach($ramais as $exten_number => $exten_name): ?>
                      <?php //if($selected_exten): ?>
                        <?php if(in_array($exten_number, $sel_ramais) || in_array('ALL', $sel_ramais) ):  ?>
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


      <div class="form-group"  style="margin-top:6px;">
        <small><b>Periodicidade:</b></small>
        <br />
        <select class="dropdown-toggle btn btn-default form-control input-sm" name="scheduling[periodicity]">
            <option value="0">Mensal</option>
            <option value="1">Semanal</option>
            <option value="2">Diário</option>
            <option value="3">Por hora</option>
        </select>
      </div>  

      <div class=" mensal">
        <div class="form-group"  style="margin-top:6px;" >
          <small><b>Dia:</b></small>
          <br />
          <input type="text" class="form-control" name="scheduling[day]" />
        </div>  
        <div class="form-group"  style="margin-top:6px;" >
          <small><b>Hora:</b></small>
          <br />
          <select class="form-control" name="scheduling[month_hour]">
            <option value="0">00:00</option>
            <option value="1">01:00</option>
            <option value="2">02:00</option>
            <option value="3">03:00</option>
            <option value="4">04:00</option>
            <option value="5">05:00</option>
            <option value="6">06:00</option>
            <option value="7">07:00</option>
            <option value="8">08:00</option>
            <option value="9">09:00</option>
            <option value="10">10:00</option>
            <option value="11">11:00</option>
            <option value="12">12:00</option>
            <option value="13">13:00</option>
            <option value="14">14:00</option>
            <option value="15">15:00</option>
            <option value="16">16:00</option>
            <option value="17">17:00</option>
            <option value="18">18:00</option>
            <option value="19">19:00</option>
            <option value="20">20:00</option>
            <option value="21">21:00</option>
            <option value="22">22:00</option>
            <option value="23">23:00</option>
            <option value="24">24:00</option>
          </select>
        </div>
      </div>


      <div class="semanal" style="display:none">
        <div class="form-group"  style="margin-top:6px;" >
          <small><b>Dia da Semana:</b></small>
          <br />
          <select class="form-control" name="scheduling[week_day]">
            <option value="0">Domingo</option>
            <option value="1">Segunda-feira</option>
            <option value="2">Terça-feira</option>
            <option value="3">Quarta-feira</option>
            <option value="4">Quinta-feira</option>
            <option value="5">Sexta-feira</option>
            <option value="6">Sábado</option>
          </select>

        </div>  
        <div class="form-group"  style="margin-top:6px;" >
          <small><b>Hora:</b></small>
          <br />
          <select class="form-control" name="scheduling[week_hour]">
            <option value="0">00:00</option>
            <option value="1">01:00</option>
            <option value="2">02:00</option>
            <option value="3">03:00</option>
            <option value="4">04:00</option>
            <option value="5">05:00</option>
            <option value="6">06:00</option>
            <option value="7">07:00</option>
            <option value="8">08:00</option>
            <option value="9">09:00</option>
            <option value="10">10:00</option>
            <option value="11">11:00</option>
            <option value="12">12:00</option>
            <option value="13">13:00</option>
            <option value="14">14:00</option>
            <option value="15">15:00</option>
            <option value="16">16:00</option>
            <option value="17">17:00</option>
            <option value="18">18:00</option>
            <option value="19">19:00</option>
            <option value="20">20:00</option>
            <option value="21">21:00</option>
            <option value="22">22:00</option>
            <option value="23">23:00</option>
            <option value="24">24:00</option>
          </select>

        </div>
      </div>


      <div class="diario" style="display:none;">
        <div class="form-group"  style="margin-top:6px;" >
          <small><b>Hora:</b></small>
          <br />
          <select class="form-control" name="scheduling[day_hour]">
            <option value="0">00:00</option>
            <option value="1">01:00</option>
            <option value="2">02:00</option>
            <option value="3">03:00</option>
            <option value="4">04:00</option>
            <option value="5">05:00</option>
            <option value="6">06:00</option>
            <option value="7">07:00</option>
            <option value="8">08:00</option>
            <option value="9">09:00</option>
            <option value="10">10:00</option>
            <option value="11">11:00</option>
            <option value="12">12:00</option>
            <option value="13">13:00</option>
            <option value="14">14:00</option>
            <option value="15">15:00</option>
            <option value="16">16:00</option>
            <option value="17">17:00</option>
            <option value="18">18:00</option>
            <option value="19">19:00</option>
            <option value="20">20:00</option>
            <option value="21">21:00</option>
            <option value="22">22:00</option>
            <option value="23">23:00</option>
            <option value="24">24:00</option>
          </select>

        </div>
      </div>


      <div class="por_hora" style="display:none;">
        <div class="form-group"  style="margin-top:6px;" >
          <small><b>Período de Horas:</b></small>
          <br />
          <select class="form-control" name="scheduling[hour]">
            <option value="1">De hora em Hora</option>
            <option value="2">A cada duas horas</option>
            <option value="3">A cada três horas</option>
            <option value="4">A cada quatro horas</option>
            <option value="5">A cada cinco horas</option>
            <option value="6">A cada seis horas</option>
            <option value="7">A cada sete horas</option>
            <option value="8">A cada oito horas</option>
            <option value="9">A cada nove horas</option>
            <option value="10">A cada dez horas</option>
            <option value="11">A cada onze horas</option>
            <option value="12">A cada doze horas</option>
          </select>

        </div>

        <div class="form-group"  style="margin-top:6px;" >
          <small><b>Hora Limite Inicial:</b></small>
          <br />
          <select class="form-control" name="scheduling[limit_initial]">
            <option value="0" selected>00:00</option>
            <option value="1">01:00</option>
            <option value="2">02:00</option>
            <option value="3">03:00</option>
            <option value="4">04:00</option>
            <option value="5">05:00</option>
            <option value="6">06:00</option>
            <option value="7">07:00</option>
            <option value="8">08:00</option>
            <option value="9">09:00</option>
            <option value="10">10:00</option>
            <option value="11">11:00</option>
            <option value="12">12:00</option>
            <option value="13">13:00</option>
            <option value="14">14:00</option>
            <option value="15">15:00</option>
            <option value="16">16:00</option>
            <option value="17">17:00</option>
            <option value="18">18:00</option>
            <option value="19">19:00</option>
            <option value="20">20:00</option>
            <option value="21">21:00</option>
            <option value="22">22:00</option>
            <option value="23">23:00</option>
            <option value="24">24:00</option>
          </select>

        </div>

        <div class="form-group"  style="margin-top:6px;" >
          <small><b>Hora Limite Final:</b></small>
          <br />
          <select class="form-control" name="scheduling[limit_final]">
            <option value="0">00:00</option>
            <option value="1">01:00</option>
            <option value="2">02:00</option>
            <option value="3">03:00</option>
            <option value="4">04:00</option>
            <option value="5">05:00</option>
            <option value="6">06:00</option>
            <option value="7">07:00</option>
            <option value="8">08:00</option>
            <option value="9">09:00</option>
            <option value="10">10:00</option>
            <option value="11">11:00</option>
            <option value="12">12:00</option>
            <option value="13">13:00</option>
            <option value="14">14:00</option>
            <option value="15">15:00</option>
            <option value="16">16:00</option>
            <option value="17">17:00</option>
            <option value="18">18:00</option>
            <option value="19">19:00</option>
            <option value="20">20:00</option>
            <option value="21">21:00</option>
            <option value="22">22:00</option>
            <option value="23">23:00</option>
            <option value="24" selected>24:00</option>
          </select>
        </div>       

      </div>

        <button type="submit" class="btn btn-primary pull-right" style="margin-left:3px;">Salvar</button>

        <a href="/admin/config.php?display=callsreport&action=scheduling" class="btn btn-primary pull-right">Cancelar</a>

        <br />
        <br />
    </form>   


  </div>
</div>



<script src="/admin/assets/callsreport/js/jquery.datetimepicker.js"></script>
<script src="/admin/assets/callsreport/js/bootstrap-multiselect.js"></script>
<script src="/admin/assets/callsreport/js/jquery.mask.js"></script>

<script type="text/javascript">

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

    $('input[name="scheduling[day]"]').keyup(function() {
      var number = $('input[name="scheduling[day]"]').val();
      if(number > 31) {
        $('input[name="scheduling[day]"]').val(31);
      }
    });

    changePeriodicity();

  });

</script>
