export const pizza = {
    pizzaMoment: function (logoMoment) {
      if ($(logoMoment).hasClass("bi-star")) {
        let idPizza = $(logoMoment).data("id_pizza");
        setPizzaMoment(idPizza);
        $(logoMoment).removeClass("bi-star").addClass("bi-star-fill");
      } else {
        let idPizza = $(logoMoment).data("id_pizza");
        unsetPizzaMoment(idPizza);
        $(logoMoment).removeClass("bi-star-fill").addClass("bi-star");
      }
    },
  };
  function setPizzaMoment(idPizza) {
    $.ajax({
      type: "POST",
      url: "controller/treatment_pizza.php",
      data: {
        action: "setPizzaMoment",
        id: idPizza,
      },
    })
      .done(function (response) {
        console.log("Réponse du serveur :", response);
        location.reload();
      })
      .fail(function (xhr, status) {
        console.error("Erreur AJAX (statut " + status + ") :", xhr.responseText);
      });
  }
  function unsetPizzaMoment(idPizza) {
    $.ajax({
      type: "POST",
      url: "controller/treatment_pizza.php",
      data: {
        action: "unsetPizzaMoment",
        id: idPizza,
      },
    })
      .done(function (response) {
        console.log("Réponse du serveur :", response);
        location.reload();
      })
      .fail(function (xhr, status) {
        console.error("Erreur AJAX (statut " + status + ") :", xhr.responseText);
      });
  }