 $(document).ready(function(){

  $("div.usr-info-hd a").click(function(){
    $("div.uinfo-panel").slideToggle("slow");
  });

  $('div.u-pa-li-1 a').click(function(){
  var requestData={requestV:'own_info'};
  $.post('/core/usr_info_hdl_re.php',requestData,function(data){
    $('#handleBlank').html(data);
  });
});
$('div.u-pa-li-2 a').click(function(){
  var requestData={requestV:'ch_pass'};
  $.post('/core/usr_info_hdl_re.php',requestData,function(data){
    $('#handleBlank').html(data);
  });
}); 

  $('div.order-hdl a').click(function(){
    $('div.ohdl-panel').slideToggle("slow");
  });
});

  // Deal with "get_ch_pass_hdl" from usr_info_hdl_re.php
$('ch-pass a').click(function(){
  var requestData={requestV:'changePW',old_pass:$("input[name='old_pass']").val(),
          new_pass:$("input[name='new_pass']").val(),new_pass2:$("input[name='new_pass2']").val()};
  $.post('usr_info_hdl_re.php',requestData,function(data){
    $('#handleBlank').html(data);
  });
});

$("input[name='old_pass']").blur(function(){
  var requestData={requestV:'vali_old_pass',old_pass:$("input[name='old_pass']").val()};
  $.post('usr_info_hdl_re.php',requestData,function(data){
    $('span.op_vali').html(data);
  })
});
// "get_ch_pass_hdl" ends.