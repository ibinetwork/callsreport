<link rel="stylesheet" href="/admin/assets/callsreport/css/jquery-ui.css">
<link rel="stylesheet" href="/admin/assets/callsreport/css/jquery.datetimepicker.css">

<div class="fpbx-container" style="margin-top:20px;">

  <?php echo $menus['top']; ?>

  <?php echo $menus['menu']; ?>

  <div class="tab-content display">
    <div role="tabpanel" class="tab-pane active" style="padding-top: 15px;">        
    	<a href="/admin/config.php?display=callsreport&action=scheduling&method=add" class="btn btn-default"> <i class="glyphicon glyphicon-plus"></i> <?php echo _('Add');?></a>
    </div>

    <table class="table table-striped table-hover table-responsive" style="margin-top:20px;">
      <thead>
            <tr>
                <td><b><?php echo _('Description');?></b></td>
                <td><b><?php echo _('Type');?></b></td>
                <td><b><?php echo _('Extensions');?></b></td>
                <td><b><?php echo _('Ivr');?></b></td>
                <td><b><?php echo _('Periodicity');?></b></td>
                <td><b><?php echo _('Day');?></b></td>
                <td><b><?php echo _('Week Day');?></b></td>
                <td><b><?php echo _('Hour');?></b></td>
                <td style="width:200px;"><b><?php echo _('Actions');?></b></td>
            </tr>
      </thead>
      <tbody>
          <?php if(count($scheduling) > 0): ?>
            <?php foreach($scheduling as $evento) : ?>
                <tr>
                    <td> <?php echo $evento['description'] ?> </td>
                    <td> 

                      <?php if($evento['type'] == 0): ?> 
                          <?php echo _('Calls Report');?>

                      <?php elseif($evento['type'] == 1): ?> 
                          <?php echo _('Agents Report');?>

                      <?php elseif($evento['type'] == 2): ?> 
                          <?php echo _('Queues Report');?>

                      <?php elseif($evento['type'] == 3): ?> 
                          <?php echo _('Attended Report');?>

                      <?php elseif($evento['type'] == 4): ?> 
                          <?php echo _('Returned Report');?>

                      <?php elseif($evento['type'] == 5): ?> 
                          <?php echo _('Ivr Report');?>
                          
                      <?php endif; ?> 
                    </td>
                    <td> <?php echo $evento['extens']; ?> </td>
                    <td> <?php echo $evento['ivr']; ?> </td>
                    <td> 
                      <?php if($evento['periodicity'] == 0): ?> 
                          Mensal
                      <?php elseif($evento['periodicity'] == 1): ?> 
                          Semanal
                      <?php elseif($evento['periodicity'] == 2): ?> 
                          Diário
                      <?php elseif($evento['periodicity'] == 3): ?> 
                          Por hora                          
                      <?php endif; ?>
                    </td>
                    <td> 
                      <?php if($evento['periodicity'] == 0): ?> 
                          <?php echo $evento['day']; ?>
                      <?php else: ?>
                          -
                      <?php endif; ?>
                    </td>
                    <td> 
                      <?php if($evento['periodicity'] == 1): ?> 
                          <?php echo $evento['week_day']; ?>
                      <?php else: ?>
                          -
                      <?php endif; ?>
                    </td>
                    <td> 
                      <?php $hour = array(0=>'00:00',1=>'01:00',2=>'02:00',3=>'03:00',4=>'04:00',5=>'05:00',6=>'06:00',7=>'07:00',8=>'08:00',9=>'09:00',10=>'10:00',11=>'11:00',12=>'12:00',13=>'13:00',14=>'14:00',15=>'15:00',16=>'16:00',17=>'17:00',18=>'18:00',19=>'19:00',20=>'20:00',21=>'21:00',22=>'22:00',23=>'23:00',24=>'24:00',)?>
                      
                      <?php if($evento['periodicity'] == 3): ?> 
                          <?php if($evento['hour'] == 1):?>
                            De hora em hora
                          <?php elseif($evento['hour'] == 2):?>
                            A cada duas horas
                          <?php elseif($evento['hour'] == 3):?>
                            A cada três horas
                          <?php elseif($evento['hour'] == 4):?>
                            A cada quatro horas
                          <?php elseif($evento['hour'] == 5):?>
                            A cada cinco horas
                          <?php elseif($evento['hour'] == 6):?>
                            A cada seis horas
                          <?php elseif($evento['hour'] == 7):?>
                            A cada sete horas
                          <?php elseif($evento['hour'] == 8):?>
                            A cada oito horas
                          <?php elseif($evento['hour'] == 9):?>
                            A cada nove horas
                          <?php elseif($evento['hour'] == 10):?>
                            A cada dez horas
                          <?php elseif($evento['hour'] == 11):?>
                            A cada onze horas
                          <?php elseif($evento['hour'] == 12):?>
                            A cada doze horas
                          <?php endif;?>
                      <?php else: ?>
                        <?php echo $hour[$evento['hour']]; ?>
                      <?php endif ?>
                      
                     </td>
                    <td style="width: 50px;">
                        <a href="/admin/config.php?display=callsreport&action=scheduling&method=edit&id=<?php echo $evento['id'];?>" class="btn btn-sm btn-default">
                          <i class="glyphicon glyphicon-pencil"></i> <?php echo _('Edit');?>
                        </a>
                        <a href="/admin/config.php?display=callsreport&action=scheduling&method=remove&id=<?php echo $evento['id'];?>" class="btn btn-sm btn-default">
                          <i class="glyphicon glyphicon-trash"></i> <?php echo _('Remove');?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
          <?php endif; ?>
      </tbody>
    </table>
      <?php if(count($scheduling) < 1): ?>
        <div class="alert alert-info">
          <?php echo _('No scheduling');?>
        </div>            
      <?php endif; ?>
  </div>
</div>



<script src="/admin/assets/callsreport/js/jquery.datetimepicker.js"></script>
<script src="/admin/assets/callsreport/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.alert-dismissable').hide();     
  });
</script>