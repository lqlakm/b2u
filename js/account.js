$("#nav-acc").addClass("active");

$("#login-tab").click(function(){
  $("#clr-title").html("Customer Login");
});$("#reg-tab").click(function(){
  $("#clr-title").html("Customer Registration");
});

$("a[id=popover]").popover({placement:"left",trigger:"focus"});

$("#cedit").click(function () {
  $("#cinfos").hide();
  $("#cedit").hide();
  $("#cinputs").show().removeClass('hidden');
  $("#cclose").show().removeClass('hidden');
  $("#c_name").val($("#ci_name").html());
  $("#c_email").val($("#ci_email").html());
  $("#c_phone").val($("#ci_phone").html());
  $("#c_gender").val($("#ci_gender").html());
  $("#c_address").val($("#ci_address").html());
  $("#c_dob").val($("#ci_dob").html());
});

$("#cclose").click(function () {
 $("#cinputs").hide();
 $("#cclose").hide();
 $("#cinfos").show();
 $("#cedit").show();
});
