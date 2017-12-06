$("#nav-cart").addClass("active");
$(".badge").hide();
$(".remove_item").on("click",function() {
    var tr = $(this).closest('tr');
    var id = tr.attr('data-id');
    var p = $('table').find('.ptotal');
    var qtotal = $('table').find('.qtotal');
    $.ajax( {
      url: "cartaction.php",
      data: "action=remove&p_id="+id,
      dataType: 'json',
      type: "POST",
      success: function(data){
        p.html(data.total+" Ks.");
        qtotal.html(data.q_total);
        tr.fadeOut(300, function(){
            tr.remove();
        });
        if($('table').find('tr').length < 4 )
          $('table').fadeOut(300, function(){
              after_empty_cart();
          });
      },
      error:function (){
        alert("unknown error");
      }
    });
});

$(".add-one").on("click",function() {
  var target = $(this).next('span');
  var tr = $(this).closest('tr');
  var id = tr.attr('data-id');
  var p = $('table').find('.ptotal');
  var qtotal = $('table').find('.qtotal');
  var n = parseInt(target.text());
  if (!isNaN(n)) {
      target.html(n+1);
  } else {
      target.html(0);
  }

  $.ajax( {
    url: "cartaction.php",
    data: "action=add_one&p_id="+id,
    dataType: 'json',
    type: "POST",
    success: function(data){
      tr.find('.p_price').html(data.one_total+" Ks.");
      p.html(data.total+" Ks.");
      qtotal.html(data.q_total);
    },
    error:function (){
      alert("unknown error");
    }
  });
});

$(".remove-one").on("click",function() {
  var target = $(this).prev('span');
  var tr = $(this).closest('tr');
  var id = tr.attr('data-id');
  var p = $('table').find('.ptotal');
  var qtotal = $('table').find('.qtotal');
  var n = parseInt(target.text());
  if(n==1){
    tr.remove();
    if($('table').find('tr').length < 3 )
      $('table').fadeOut(300, function(){
          after_empty_cart();
      });
  }else{
    if (!isNaN(n)) {
        target.html(n-1);
    } else {
        target.html(0);
    }
  }
  $.ajax( {
    url: "cartaction.php",
    data: "action=remove_one&p_id="+id,
    dataType: 'json',
    type: "POST",
    success: function(data){
      if(n>1)tr.find('.p_price').html(data.one_total+" Ks.");
      p.html(data.total+" Ks.");
      qtotal.html(data.q_total);
    },
    error:function () {    }
  });
});

$(".empty-cart").on("click",function(){
  $.ajax( {
    url: "cartaction.php",
    data: "action=empty",
    type: "POST",
    success: function(data){
      $('table').fadeOut(300, function(){
          after_empty_cart();
      });
    },
    error:function () {
    }
  });
});

function after_empty_cart() {
  $('.shopping-cart').hide();
  $('.empty-cart-alert').show();
  $('.checkout-span').hide();
}
