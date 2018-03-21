<link rel="stylesheet" href="/admin/assets/callsreport/css/jquery-ui.css">
<link rel="stylesheet" href="/admin/assets/callsreport/css/jquery.datetimepicker.css">

<div class="fpbx-container" style="margin-top:20px;">

  <?php echo $menus['top']; ?>

  <?php echo $menus['menu']; ?>

  <div class="tab-content display">
    <div role="tabpanel" class="tab-pane active" style="padding-top: 15px;">
      <form method="post">
        <input type="hidden" name="confirm_remove" value="1" />
        <input type="hidden" name="id" value="<?php echo $scheduling['id'];?>" />
        <table class="table table-striped table-hover table-responsive" style="margin-top:20px;">
          <thead>
                <tr>
                  <td><b><?php echo _('Description');?></b></td>
                  <td><b><?php echo _('Type');?></b></td>
                  <td><b><?php echo _('Extensions');?></b></td>
                  <td><b><?php echo _('Emails');?></b></td>
                  <td><b><?php echo _('Periodicity');?></b></td>
                  <td><b><?php echo _('Day');?></b></td>
                  <td><b><?php echo _('Week Day');?></b></td>
                  <td><b><?php echo _('Hour');?></b></td>
                </tr>
          </thead>
          <tbody>
            <tr>
                <td> <?php echo $scheduling['description'] ?> </td>
                <td> 
                  <?php if($scheduling['type'] == 0): ?> 
                      <?php echo _('Calls Report');?>
                  <?php elseif($scheduling['type'] == 1): ?> 
                      <?php echo _('Agents Report');?>
                  <?php elseif($scheduling['type'] == 2): ?> 
                      <?php echo _('Queues Report');?>
                  <?php elseif($scheduling['type'] == 3): ?> 
                      <?php echo _('Attended Report');?>
                  <?php elseif($scheduling['type'] == 4): ?> 
                      <?php echo _('Returned Report');?>
                  <?php elseif($scheduling['type'] == 5): ?> 
                      <?php echo _('Ivr Report');?>
                  <?php endif; ?> 
                </td>
                <td> <?php echo $scheduling['extens'] ?> </td>
                <td> <?php echo $scheduling['email'] ?> </td>
                <td> 
                  <?php if($scheduling['type'] == 0): ?> 
                      <?php echo _('Monthly');?>
                  <?php elseif($scheduling['type'] == 1): ?> 
                      <?php echo _('Weekly');?>
                  <?php elseif($scheduling['type'] == 2): ?> 
                      <?php echo _('Daily');?>
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

        <h3 style="text-align:center;"> <?php echo _('Do you want to remove this schedule');?> </h3>
          
        <button type="submit" class="btn btn-primary pull-right" style="margin-left:3px;"><?php echo _('Remove');?></button>
        <a href="/admin/config.php?display=callsreport&action=scheduling" class="btn btn-primary pull-right"><?php echo _('Cancel');?></a>
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
    $('.alert-dismissable').hide();     
    
  });

</script>