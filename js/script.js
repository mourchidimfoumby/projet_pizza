$(function () {
    
/*
=====================================================
                        PRODUCTS LIST
=====================================================
*/
function addToCart(){
    $($.ajax({
        type: "POST",
        url: "controller/treatment.php",
        data: {
            ajax: true,
            action: 'getObjet'
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
        },
        error: function(error){
            console.error(error);
        }
    }));
}
$(".product-cards").on("click", addToCart);
});
