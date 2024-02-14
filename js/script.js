import {cart} from "./cart.js";
import {popup} from "./popup.js";
import {pizza} from "./pizza.js";

$(function () {
  /*============= VARIABLE GLOBALES ==============*/

  const params = new URLSearchParams(window.location.search);
  let objet = params.get("objet");
  let id_pizza = params.get("id_pizza");
  let id_stock = params.get("id_stock");
  let action = params.get("action");
  let parameters = {
    objet: objet,
  };


  /*============= EVENEMENTS ==============*/  
  if(id_pizza != null || action == "displayCreateForm" || id_stock != null){
    $("body").css("overflow", "hidden");
  }

  $(".bi-x").on("click", function(){
    popup.close(objet, action)
  });

  $("#popup-btn-add").on("click", function(){
    cart.addPizza(parameters, id_pizza, objet)
  });

  $("#cart-item .bi-x-circle").on("click", function(){
    cart.removeItem(this, parameters)
  });

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

  $(".popup-create-checkbox").on("click", function(event){
      popup.selectElementPizza(this, event);
  });
  
  $(".logoIsMoment").on("click", function(){
    pizza.pizzaMoment(this);
  });
});