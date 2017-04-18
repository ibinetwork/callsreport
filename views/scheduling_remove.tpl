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
      <form method="post">
        <input type="hidden" name="confirm_remove" value="1" />
        <input type="hidden" name="id" value="<?php echo $scheduling['id'];?>" />
        <table class="table table-striped table-hover table-responsive" style="margin-top:20px;">
          <thead>
                <tr>
                    <td><b>Descrição</b></td>
                    <td><b>Tipo</b></td>
                    <td><b>Extensões</b></td>
                    <td><b>E-mail de Destino</b></td>
                    <td><b>Periodicidade</b></td>
                    <td><b>Dia</b></td>
                    <td><b>Dia da Semana</b></td>
                    <td><b>Hora</b></td>
                </tr>
          </thead>
          <tbody>
            <tr>
                <td> <?php echo $scheduling['description'] ?> </td>
                <td> 
                  <?php if($scheduling['type'] == 0): ?> 
                      Relatório de Chamadas
                  <?php elseif($scheduling['type'] == 1): ?> 
                      Relatório de Agentes
                  <?php endif; ?> 
                </td>
                <td> <?php echo $scheduling['extens'] ?> </td>
                <td> <?php echo $scheduling['email'] ?> </td>
                <td> 
                  <?php if($scheduling['type'] == 0): ?> 
                      Mensal
                  <?php elseif($scheduling['type'] == 1): ?> 
                      Semanal
                  <?php elseif($scheduling['type'] == 2): ?> 
                      Diário
                  <?php endif; ?>
                </td>
                <td> 
                  <?php if($scheduling['type'] == 0): ?> 
                      <?php echo $scheduling['day']; ?>
                  <?php else: ?>
                      -
                  <?php endif; ?>
                </td>
                <td> 
                  <?php if($scheduling['type'] == 1): ?> 
                      <?php echo $scheduling['week_day']; ?>
                  <?php else: ?>
                      -
                  <?php endif; ?>
                </td>
                <td> 
                  <?php $hour = array(0=>'00:00',1=>'01:00',2=>'02:00',3=>'03:00',4=>'04:00',5=>'05:00',6=>'06:00',7=>'07:00',8=>'08:00',9=>'09:00',10=>'10:00',11=>'11:00',12=>'12:00',13=>'13:00',14=>'14:00',15=>'15:00',16=>'16:00',17=>'17:00',18=>'18:00',19=>'19:00',20=>'20:00',21=>'21:00',22=>'22:00',23=>'23:00',24=>'24:00',)?>
                  <?php echo $hour[$scheduling['hour']]; ?>
                 </td>
            </tr>
          </tbody>
        </table>

        <h3 style="text-align:center;">Deseja remover este agendamento?</h3>
          
        <button type="submit" class="btn btn-primary pull-right" style="margin-left:3px;">Remover</button>
        <a href="/admin/config.php?display=callsreport&action=scheduling" class="btn btn-primary pull-right">Cancelar</a>
        <br />
        <br />
      </form>    	

    </div>
  </div>

  <div class="row" style="padding: 10px 18px;">



  </div>

</div>



<script src="/admin/assets/callsreport/js/jquery.datetimepicker.js"></script>
<script src="/admin/assets/callsreport/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">

  $(document).ready(function() {

    $('.multiselect').multiselect({
        filterBehavior: 'both'
    });

  });

</script>