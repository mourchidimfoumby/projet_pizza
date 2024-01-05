$(function () {
  /*============= VARIABLE GLOBALES ==============*/

  let params = new URLSearchParams(window.location.search);
  let objet = params.get("objet");
  let id_pizza = params.get("id_pizza");
  let parameters = {
    objet: objet,
  };
  // let initialPizzaIngredients = {};

  /*============= FONCTIONS ==============*/

  function addProductToCart(productItem) {
    parameters.id = $(productItem).data("id_product");

    $.ajax({
      type: "POST",
      url: "controller/treatment_cart.php",
      data: {
        action: "addProductToCart",
        parameters: parameters,
      },
      dataType: "json",
    })
      .done(function (response) {
        console.log("Réponse du serveur :", response);
        location.reload();

      })
      .fail(function (xhr, status) {
        console.error(
          "Erreur AJAX (statut " + status + ") :",
          xhr.responseText
        );
      });
  }

  function removeToCart(cartItem) {
    parameters.position = $(cartItem).data("position");
    $.ajax({
      type: "POST",
      url: "controller/treatment_cart.php",
      data: {
        action: "removeToCart",
        parameters: parameters,
      },
      dataType: "json",
    })
      .done(function (response) {
        console.log("Réponse du serveur :", response);
        location.reload();
      })
      .fail(function (xhr, status) {
        console.error(
          "Erreur AJAX (statut " + status + ") :",
          xhr.responseText
        );
      });
  }

  function closePopup() {
    window.location.href = "index.php?objet=" + objet;
  }

  function removeIngredientPopup(btnSpanRemove) {
    $(btnSpanRemove).removeClass("bi-x-circle");
    $(btnSpanRemove).addClass("bi-plus-lg");

    let itemList = $(btnSpanRemove).closest(".popup-list-remove");
    itemList.removeClass("popup-list-remove").addClass("popup-list-add");
    itemList.appendTo("#popup-ul-add");

    let spanIngredient = $(btnSpanRemove).find("span.popup-list-add-price").first();
    let spanBtnAdd = $("#popup-btn-add").find("span#total-price").first();

    let itemPrice = parseFloat(spanIngredient.text());
    let totalPrice = parseFloat(spanBtnAdd.text());
    totalPrice -= itemPrice;
    totalPrice = totalPrice.toFixed(2);
    spanBtnAdd.text(totalPrice);
  }

  function addIngredientPopup(itemList) {
    let span = $(itemList).find("span.bi-plus-lg").first();
    span.removeClass("bi-plus-lg");
    span.addClass("bi-x-circle");

    let spanIngredient = $(itemList).find("span.popup-list-add-price").first();
    let spanBtnAdd = $("#popup-btn-add").find("span#total-price").first();

    let itemPrice = parseFloat(spanIngredient.text());
    let totalPrice = parseFloat(spanBtnAdd.text());
    totalPrice += itemPrice;
    totalPrice = totalPrice.toFixed(2);
    spanBtnAdd.text(totalPrice);

    $(itemList).removeClass("popup-list-add").addClass("popup-list-remove");
    $(itemList).appendTo("#popup-ul-remove");
  }

  // if (id_pizza != null) {
  //   let initialPizzaIngredientsList = $("#popup-ul-remove").find("li");
    
  //   initialPizzaIngredientsList.each(function () {
  //     let nameIngredient = $(this).text();
  //     let dataId = $(this).data("id_ingredient");
  //     initialPizzaIngredients[dataId] = nameIngredient;
  //   });

    function addPizzaToCart(){
      let pizzaIngredientsList = $("#popup-ul-remove").find("li");
      if(pizzaIngredientsList.length === 0) alert("Veuillez insérer au moins un ingrédient dans la pizza");
      else
      {

        let pizzaIngredients = {};
        pizzaIngredientsList.each(function(){
          let span =  $(this).find("span.popup-list-add-price").first();
          span.removeClass("popup-list-add-price");
          span.text("");
          let nameIngredient = $(this).text();
          let dataId = $(this).data("id_ingredient");
          pizzaIngredients[dataId] = nameIngredient;
        });

          parameters.id = id_pizza;
          parameters.ingredients = pizzaIngredients;
          $.ajax({
            type: "POST",
            url: "controller/treatment_cart.php",
            data: {
              action: "addPizzaToCart",
              parameters: parameters,
            },
            dataType: "json",
          })
            .done(function (response) {
              console.log("Réponse du serveur :", response);
              closePopup();
            })
            .fail(function (xhr, status) {
              console.error(
                "Erreur AJAX (statut " + status + ") :",
                xhr.responseText
              );
            });
        }
    }

  /*============= EVENEMENTS ==============*/

  $(".bi-x").on("click", closePopup);

  $("#popup-btn-add").on("click", function () {
    addPizzaToCart();
  });

  $("#cart-item .bi-x-circle").on("click", function () {
    removeToCart(this);
  });

  $(".other-product").on("click", function (event) {
    event.preventDefault();
    addProductToCart(this);
  });

  $("#popup-ul-remove").on(
    "click",
    ".popup-list-remove .bi-x-circle",
    function () {
      removeIngredientPopup(this);
    }
  );

  $("#popup-ul-add").on("click", ".popup-list-add", function () {
    addIngredientPopup(this);
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
