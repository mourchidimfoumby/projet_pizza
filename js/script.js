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
    let element;
    let myevent;

    function addToCart(event, element) {
        event.preventDefault();
        parameters.id = $(element).data("id");
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

    function removeToCart(event, element) {
        event.preventDefault()
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

    function showPopup(){
        $("#app-container").css("pointer-events", "none");
        $("body").css("overflow", "hidden")
        $("#overlay").fadeIn();
        $(".popup").fadeIn();
    }
    function closePopup(){
        $("#app-container").css("pointer-events", "all");
        $("body").css("overflow", "auto")
        $(".popup").fadeOut();
        $("#overlay").fadeOut();
    }

    $(".product").on("click", function(event){
        element = this;
        myevent = event;
        showPopup();
    });

    $(".bi-x-circle").on("click", function(event){
        removeToCart(event,this);
    });
    
    $("#btn-popup-add").on("click", function() {
        closePopup();
        addToCart(myevent, element)
    });
    $("#btn-popup-cancel").on("click", closePopup);

});

// function clearSession(){
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