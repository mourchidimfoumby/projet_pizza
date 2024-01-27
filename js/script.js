import {cart} from "./cart.js";
import {popup} from "./popup.js";

$(function () {
  /*============= VARIABLE GLOBALES ==============*/

  const params = new URLSearchParams(window.location.search);
  let objet = params.get("objet");
  let id_pizza = params.get("id_pizza");
  let parameters = {
    objet: objet,
  };

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


  /*============= EVENEMENTS ==============*/
  $("#btn").on("click", clearSession);
  
  if(id_pizza != null){
    $("body").css("overflow", "hidden");
  }

  $(".bi-x").on("click", function(){
    popup.close(objet)});

  $("#popup-btn-add").on("click", function(){
    cart.addPizza(parameters, id_pizza, objet)});

  $("#cart-item .bi-x-circle").on("click", function(){
    cart.removeItem(this, parameters)});

  $(".other-product").on("click", function (event) {
    event.preventDefault();
    cart.addProduct(this, parameters);
  });

  $("#popup-ul-remove").on(
    "click",
    ".popup-list-remove .bi-x-circle",
    function () {
      popup.removeIngredient(this);
    }
  );

  $("#popup-ul-add").on("click", ".popup-list-add", function () {
    popup.addIngredient(this);
  });
});
