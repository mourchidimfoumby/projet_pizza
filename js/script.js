$(function () {
    
/*
=====================================================
                        PRODUCTS LIST
=====================================================
*/
function addToCart(){

    $($.ajax({
        type: "POST",
        url: "controller/treatment_cart.php",
        data: {
            action: 'sayHello',
            message: 'Hello'
        },
        dataType: "json",
        success: function (response) {
            $("h3").text(response.message);
        },
        error: function(error){
            $("h3").text(error.message);
        }
    }));
}
$(".product-cards").on("click", addToCart);
});