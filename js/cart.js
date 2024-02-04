import { popup } from "./popup.js";

export const cart = {
    
    addProduct: function (productItem, parameters) {
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
    },

    removeItem : function (cartItem, parameters) {
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
    },


    addPizza: function (parameters, id_pizza, objet){
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
                popup.close(objet);
                })
                .fail(function (xhr, status) {
                console.error(
                    "Erreur AJAX (statut " + status + ") :",
                    xhr.responseText
                );
            });
        }
    }
};