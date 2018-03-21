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
                <button type="submit" value="1" name="calls[limpar]" class="btn btn-default">
                <i class="glyphicon glyphicon-remove"></i> <?php echo _('Clean Filter');?></button>
              <?php //endif; ?>
          </div>

          <div class="form-group">
            <small><b><?php echo _('Of');?>:</b></small>
            <input type="text" name="calls[data_inicio]" value="<?php echo $data_inicio; ?>" class="input-sm form-control" style="width: 95px;font-weight:bolder !important;" placehold="Data inicial" />
            <input type="text" name="calls[hora_inicio]" value="<?php echo $hora_inicio; ?>" class="input-sm form-control" style="width: 60px;font-weight:bolder !important;" placehold="Hora inicial" />
          </div>

          <div class="form-group">
            <small><b><?php echo _('Until');?>:</b></small>
            <input type="text" name="calls[data_fim]" value="<?php echo $data_fim; ?>" class="input-sm form-control"  style="width: 95px;font-weight:bolder !important;" placehold="Data final"  />
            <input type="text" name="calls[hora_fim]" value="<?php echo $hora_fim; ?>" class="input-sm form-control" style="width: 60px;font-weight:bolder !important;" placehold="Hora final" />
          </div>

          <div class="form-group">
            <small><b><?php echo _('Source');?>:</b></small>
            <input type="text" class="form-control input-sm" value="<?php echo $origem; ?>" name="calls[origem]" style="width: 100px;" /> 
          </div>

          <div class="form-group">
            <small><b><?php echo _('Destination');?>:</b></small>
            <input type="text" class="form-control input-sm" value="<?php echo $destino; ?>" name="calls[destino]" style="width: 100px;" />
          </div>

          <div class="form-group">
            <small><b><?php echo _('Number');?>:</b></small>
            <input type="text" class="form-control input-sm" value="<?php echo $numero; ?>" name="calls[numero]" style="width: 100px;" />
          </div>

          <br />

          <div class="form-group btn-group" style="margin-top:6px;margin-right:2px;">
            <?php if(count($sel_ramais) > 0): ?>
              <button type="button" class="btn-ramais btn btn-default active" onclick="toogleRamais();"> <b><small><?php echo _('Extensions');?></b></small> </button>
            <?php else: ?>
              <button type="button" class="btn-ramais btn btn-default" onclick="toogleRamais();"> <b><small><?php echo _('Extensions');?></b></small> </button>
            <?php endif; ?>
          </div>                            

          <div class="form-group"  style="margin-top:6px;">
            <small><b><?php echo _('Disposition');?>:</b></small>
            <select class="dropdown-toggle btn btn-default multiselect form-control input-sm" multiple="multiple" name="calls[disposition][]">
                <option <?php echo ( in_array('NO ANSWER',$sel_disposition) || isset($sel_disposition['ALL']) ? 'selected' : '') ?> value="NO ANSWER"> NO ANSWER </option>
                <option <?php echo ( in_array('CONGESTION',$sel_disposition) || isset($sel_disposition['ALL']) ? 'selected' : '') ?> value="CONGESTION"> CONGESTION </option>
                <option <?php echo ( in_array('FAILED',$sel_disposition) || isset($sel_disposition['ALL']) ? 'selected' : '') ?> value="FAILED"> FAILED </option>
                <option <?php echo ( in_array('BUSY',$sel_disposition) || isset($sel_disposition['ALL']) ? 'selected' : '') ?> value="BUSY"> BUSY </option>
                <option <?php echo ( in_array('ANSWERED',$sel_disposition) || isset($sel_disposition['ALL']) ? 'selected' : '') ?> value="ANSWERED"> ANSWERED </option>
            </select>
          </div>

          <div style="display:<?php echo ( count($sel_ramais) > 0 ? 'block' : 'none' ) ?>;width:100%;height:192px;margin-top:8px;background-color:#f1f1f1;border-top:1px solid #fff;" class="busca_ramal">
                <div class="col-xs-12" style="padding-left:15px;">
                  <small><b><?php echo _('Extensions');?>:</b></small>
                </div>
                <div class="col-xs-5">
                  <select class="form-control" size="8" id="ramais_1" multiple="multiple" name="calls[a_ramais][]" style="width:100%;height:150px;">
                      <?php foreach($extens as $exten_number => $exten_name): ?>
                        <?php //if($selected_exten): ?>
                          <?php if(in_array($exten_number, $sel_ramais) || in_array('ALL', $sel_ramais) ):  ?>
                              <option selected value="<?php echo $exten_number; ?>"><?php echo _('Exten');?> <?php echo $exten_number; ?> (<?php echo $exten_name; ?>)</option>
                          <?php else: ?>
                              <option value="<?php echo $exten_number; ?>"><?php echo _('Exten');?> <?php echo $exten_number; ?> (<?php echo $exten_name; ?>)</option>
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
                <div class="col-xs-5">
                  <select class="form-control" size="8" id="ramais_2" multiple="multiple" name="calls[b_ramais][]"  style="width:100%;height:150px;"></select>
                </div>
          </div>
        </form>
    </div>
  </div>


  <div class="row" style="padding:18px 15px;"></div>

  <table class="table table-striped table-hover table-responsive">
  	<thead>
          <tr>
              <td style="width: 20px;"></td>
              <td><b><?php echo _('Date');?></b></td>
              <td><b><?php echo _('Time');?></b></td>
              <td><b><?php echo _('CallerID');?></b></td>
              <td><b><?php echo _('Source');?></b></td>
              <td><b><?php echo _('Destination');?></b></td>
              <td><b><?php echo _('Status');?></b></td>
              <td><b><?php echo _('Duration');?></b></td>
              <td><b><?php echo _('Ring Time');?></b></td>
              <td><b><?php echo _('Talking Time');?></b></td>
              <td><b><?php echo _('Áudio File');?></b></td>
          </tr>
  	</thead>
  	<tbody>
        <?php if(count($results) > 0): ?>
          <?php foreach($results as $evento) : ?>
              <tr>
                  <td><input type="checkbox" value="<?php echo $evento['id'];?>" /> </td>
                  <?php $data_ini = new \DateTime($evento['calldate']); ?>
                  <td> <?php echo $data_ini->format('d/m/Y'); ?> </td>
                  <td> <?php echo $data_ini->format('H:i:s'); ?> </td>
                  <td> <?php echo $evento['clid']; ?> </td>
                  <td> <?php echo $evento['src'];?> </td>
                  <td> <?php echo $evento['dst'];?> </td>
                  <td> <?php echo $evento['disposition'];?> </td>
                  <td> <?php echo gmdate('i:s', $evento['duration']);?></td>
                  <td> <?php echo gmdate('i:s', $evento['billsec']);?></td>
                  <td> <?php echo gmdate('i:s', $evento['duration']-$evento['billsec']);?></td>
                  <td style="width: 50px;">
                    <?php if($evento['recordingfile'] != ''): ?>
                      <?php $path = explode(' ', $evento['calldate']); ?>
                      <?php $path = explode('-', $path[0]); ?>
                      <?php $filepath = "/var/spool/asterisk/monitor/{$path[0]}/{$path[1]}/{$path[2]}/{$evento['recordingfile']}"; ?>
                      <?php $filename = "/monitor/{$path[0]}/{$path[1]}/{$path[2]}/{$evento['recordingfile']}"; ?>

                      <?php if( file_exists($filepath)):?>
                        <button type="button" class="btn btn-sm btn-default" onclick="openCallInfo('<?php echo $filename;?>');">
                          <i class="glyphicon glyphicon-volume-up"></i>
                        </button>
                      <?php endif; ?>
                    <?php else:?>
                      <button type="button" class="btn btn-sm btn-default disabled">
                        <i class="glyphicon glyphicon-volume-off"></i>
                      </button>                  
                    <?php endif;?>
                  </td>
              </tr>
          <?php endforeach; ?>
        <?php endif; ?>
  	</tbody>
  </table>


<hr />

<a href="/admin/config.php?display=callsreport&pdf=1" class="btn btn-primary pull-right" target="_blank">
  <?php echo _('Export PDF');?>
</a>


<br />
<?php echo _('Total');?>: <b> <?php echo $total; ?></b>

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
<script src="/admin/assets/callsreport/js/wavesurfer.min.js"></script>

<script type="text/javascript">

    function openAudio(url) {


      var html = '<div id="waveform" style="min-height:220px;"><div class="loading label label-primary"><?php echo _("Loading");?>...</div>';
      html += '</div>';

      html += '<div class="row" style="text-align:center;margin-bottom:10px;margin-top:10px;">';
      html += '<div style="width:100px;float:right;text-align:right;" id="total_time">00:00:00</div> ';
      html += '<div style="width:100px;float:left;text-align:left;" id="atual_time">00:00:00</div> ';
      html += '</div>';


      html += '<div class="row" style="text-align:center;margin-bottom:10px;margin-top:10px;">';
           
      html += '<button class="btn btn-primary" onclick="splayer.play();">';
      html +=   '<i class="glyphicon glyphicon-play"></i>';
      html +=   ' ';
      html += '</button>';


      html += '<button class="btn btn-primary" onclick="splayer.pause();" style="margin-left:4px;">';
      html +=   '<i class="glyphicon glyphicon-pause"></i>';
      html +=   ' ';
      html += '</button>';

      html += '<button class="btn btn-primary" onclick="splayer.stop();" style="margin-left:4px;">';
      html +=   '<i class="glyphicon glyphicon-stop"></i>';
      html +=   ' ';
      html += '</button>';

      html += '<button class="btn btn-primary" onclick="splayer.seekTo(0);" style="margin-left:4px;">';
      html +=   '<i class="glyphicon glyphicon-step-backward"></i>';
      html +=   ' ';
      html += '</button>';


      html += '<button class="btn btn-primary" onclick="splayer.skipBackward(5);" style="margin-left:4px;">';
      html +=   '<i class="glyphicon glyphicon-backward"></i>';
      html +=   ' ';
      html += '</button>';

      html += '<button class="btn btn-primary" onclick="splayer.skipForward(5)" style="margin-left:4px;">';
      html +=   '<i class="glyphicon glyphicon-forward"></i>';
      html +=   ' ';
      html += '</button>';      

      html += '<button class="btn btn-primary" onclick="splayer.seekTo(100)" style="margin-left:4px;">';
      html +=   '<i class="glyphicon glyphicon-step-forward"></i>';
      html +=   ' ';
      html += '</button>';      

      html += '<button class="btn btn-primary" onclick="splayer.toggleMute();" style="margin-left:4px;">';
      html +=   '<i class="glyphicon glyphicon-volume-off"></i>';
      html +=   ' ';
      html += '</button>';

      html += '</div>';   

      $('#calls_report_audio_file').html(html);

      splayer = WaveSurfer.create({
          container: '#waveform',
          waveColor: '#0075be',
          height: 250,
          progressColor: 'darkorange',
          scrollParent: true
      });
      splayer.load(url);
      $('.loading').hide();
    }

  function convertTime(time) {

    if (!time) {
      return "00:00:00";
    }
    var sec_num = parseInt(time, 10); // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    return hours+':'+minutes+':'+seconds;
  }


  function openCallInfo(url) {
    $('.modal_calls_report').show();
    openAudio(url);
  }

  function toogleRamais() {
    $('.busca_atendentes').hide();
    if($('.btn-ramais').hasClass('active')) {
      $('.busca_ramal').hide();
      $('.btn-ramais').removeClass('active');
      $('.btn-atendentes').removeClass('active');
    }else{
      $('.btn-ramais').addClass('active');
      $('.busca_ramal').show();
      $('.btn-atendentes').removeClass('active');
    }
  }

  function toogleAtendentes() {
    $('.busca_ramal').hide();    
    if($('.btn-atendentes').hasClass('active')) {
      $('.busca_atendentes').hide();
      $('.btn-atendentes').removeClass('active');
      $('.btn-ramais').removeClass('active');
    }else{      
      $('.busca_atendentes').show();
      $('.btn-atendentes').addClass('active');
      $('.btn-ramais').removeClass('active');
    }
  }

  var splayer = false;
  
	$(document).ready(function() {


        setInterval(function() {
          if($('#waveform').is(":visible") == false) {
            if(splayer) {
              splayer.stop();  
            }
            
          }else{
            if(splayer) {
              $('#total_time').html( convertTime(splayer.getDuration()) );
              $('#atual_time').html( convertTime(splayer.getCurrentTime()) );
            }
          }
        }, 1000);

        jQuery("input[name='calls[data_inicio]']").datetimepicker({
          timepicker:false,
          format:'d/m/Y',
          lang:'pt'
        });

        jQuery("input[name='calls[data_fim]']").datetimepicker({
          timepicker:false,
          format:'d/m/Y',
          lang:'pt'
        });

        jQuery("input[name='calls[hora_inicio]']").datetimepicker({
          datepicker:false,
          format:'H:i',
          lang:'pt'
        });

        jQuery("input[name='calls[hora_fim]']").datetimepicker({
          datepicker:false,
          format:'H:i',
          lang:'pt'
        });

        $('#add_ramais').click(function() {
          return $('#ramais_1 option:selected').remove().appendTo('#ramais_2');
        });

        $('#remove_ramais').click(function() {
          return $('#ramais_2 option:selected').remove().appendTo('#ramais_1');
        });

        $('select[name="num"]').change(function() {
          $('#form_num').submit();
        });

        $('.multiselect').multiselect({
            filterBehavior: 'both'
        });

        $('form').submit(function() {  
          $('#b_ramais option').each(function(i) {  
            $(this).attr("selected", "selected");  
          });
          $('#b_atendentes option').each(function(i) {  
            $(this).attr("selected", "selected");  
          });          
        }); 

        $('#ramais_1 option:selected').remove().appendTo('#ramais_2');
        $('#atendentes_1 option:selected').remove().appendTo('#atendentes_2');


        $('#add_atendentes').click(function() {
          return $('#atendentes_1 option:selected').remove().appendTo('#atendentes_2');
        });

        $('#remove_atendentes').click(function() {
          return $('#atendentes_2 option:selected').remove().appendTo('#atendentes_1');
        });

        $('.alert-dismissable').hide();        

        if( $('.modal_calls_report').length == 0) {
          var html = '<div class="modal_calls_report panel panel-primary" style="display:none;">';
          html +=  '<div class="panel-heading">';
          html +=  '    <h3 class="panel-title"> <button type="button" class="btn btn-danger btn-sm pull-right" onclick="$(\'.modal_calls_report\').hide();">Fechar</button> Arquivo de Áudio</h3>';
          html +=  '  </div>';
          html +=  '  <div class="panel-body">';
          html +=  '    <div id="calls_report_audio_file"></div>';
          html +=  '  </div>';
          html +=  '</div>';
          $('body').append(html);
        }

  });

</script>
