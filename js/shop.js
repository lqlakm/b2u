    $("#nav-shop").addClass("active");
    $(document).ready(init());

    function init(){
        $("#dropdown-catagory").hide();
        $("#dropdown-cat-icon").hide();
        direct_link();
        make_active();
    }
    function make_active(){
        $(".cat-list").on('click','a',function(){
            $(".cat-list a.active").removeClass('active');
            $(this).addClass('active').blur();
        });
    }

     function fetch_product(cat_id){
        $(".fetch_result").hide();
        $("#search-results").hide();
        $(".loading").show();
        setTimeout(function() {
            $("#r-"+cat_id).load( "views/fetch_products.php",{"catid":cat_id});
            $(".loading").hide();
            $("#r-"+cat_id).show();
            $("#r-"+cat_id).on( "click", ".pagination a", function (){
                var page = $(this).attr("data-page");
                $("#r-"+cat_id).load("views/fetch_products.php",{"page":page,"catid":cat_id});
            });
        },200);
    }

    $("#searchkey-txt").keydown(function(e){
        if(e.keyCode == 13){search_result();}
    });

    function search_result(){
        var search_key=$("#searchkey-txt").val();
        if(search_key != ""){
            $(".fetch_result").hide();
            $(".cat-list a.active").removeClass('active');
            $(".loading").show();
            setTimeout(function() {
                $("#search-results").load( "views/search_result.php",{"searchKey":search_key});
                $(".loading").hide();
                $("#search-results").show();
                $("#search-results").on( "click", ".pagination a", function (){
                    var page = $(this).attr("data-page");
                    $("#search-results").load("views/search_result.php",{"page":page,"searchKey":search_key});
                });
            },200);
        }
    }

    function direct_link(){
        $url=window.location.href;
        var $id=0;
        for (var i = 1; i <= 20; i++) {
            if($url.includes("categoryID-"+i)){
                $id=i;
                break;
            }
        };
        if($id == 0)fetch_product("all");
        else{
            $("#categoryid-"+$id).click();
            $(".cat-list a.active").removeClass('active');
            $("#categoryid-"+$id).addClass("active");
        }
    }

    function add_to_cart(p_id){
      $.ajax( {
        url: "cartaction.php",
        data: "action=add&p_id="+p_id,
        type: "POST",
        success: function(data){
          $(".badge").fadeOut(100);
          $(".badge").fadeIn(200).html(data);
        },
        error:function (){
          alert("cant");
        }
    });
  }
