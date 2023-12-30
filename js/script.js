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
    };

    function addToCart(element) {
        if(element != null) parameters.id = $(element).data("id");
        else parameters.id = id;
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
            if(element != null) location.reload();
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

    function closePopup(){
        window.location.href = "index.php?objet=" + objet;
    }

    $(".bi-x").on("click", closePopup);

    $("#btn-popup-add").on("click", function() {
        addToCart()
        setTimeout(function() {
            closePopup();
        }, 100);
    });

    $(".bi-x-circle").on("click", function(){
        removeToCart(this);
    });
    
    $(".other-product").on("click", function(event){
        event.preventDefault();
       addToCart(this);
    });

});


//     function clearSession(){
//     $.ajax({
//         type: "POST",
//         url: "controller/clear.php",
//         dataType: "json",
//     })
//     .done(function(response) {
//         console.log('Réponse du serveur :', response);
//         location.reload();
//     })
//     .fail(function(xhr, status, error) {
//         console.error('Erreur AJAX (statut ' + status + ') :', xhr.responseText);
//     });
// }
// $("#btn").on("click", clearSession); 