$(function () {
    /*
    =====================================================
                            PRODUCTS LIST
    =====================================================
    */

    let params = new URLSearchParams(window.location.search);
    let objet = params.get('objet');
    let id = params.get('id');
    let parameters = {
        'objet': objet,
        'id': id,
    };

    function addToCart() {
        $.ajax({
            type: "POST",
            url: "controller/treatment_cart.php",
            data: {
                action: 'addToCart',
                parameters: parameters
            },
            dataType: "json"
        })
        .done(function(response) {
            console.log('Réponse du serveur :', response);
            location.reload();
        })
        .fail(function(xhr, status, error) {
            console.error('Erreur AJAX (statut ' + status + ') :', xhr.responseText);
        });
    }

    function removeToCart(element) {
        parameters.position = $(element).data("position");
        $.ajax({
            type: "POST",
            url: "controller/treatment_cart.php",
            data: {
                action: 'removeToCart',
                parameters: parameters
            },
            dataType: "json"
        })
        .done(function(response) {
            console.log('Réponse du serveur :', response);
            location.reload();
        })
        .fail(function(xhr, status, error) {
            console.error('Erreur AJAX (statut ' + status + ') :', xhr.responseText);
        });
    }


    function clearSession(){
        $.ajax({
            type: "POST",
            url: "controller/clear.php",
            dataType: "json",
        })
        .done(function(response) {
            console.log('Réponse du serveur :', response);
            location.reload();
        })
        .fail(function(xhr, status, error) {
            console.error('Erreur AJAX (statut ' + status + ') :', xhr.responseText);
        });
    }

    $(".product-cards").on("click", addToCart);
    $(".bi-x-circle").on("click", function(){
        console.log($(this).data("position"));
        removeToCart(this);
    });
    $("#btn").on("click", clearSession);
});