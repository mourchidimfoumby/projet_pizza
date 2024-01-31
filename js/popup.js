
export const popup = {
    close : function (objet) {
    window.location.href = "index.php?objet=" + objet;
  },

  removeIngredient : function (btnSpanRemove) {

    let spanIngredient = $(btnSpanRemove).closest("span.popup-list-add-price")
    let spanBtnAdd = $("#popup-btn-add").find("span#total-price").first();
    let itemPrice = 0;
    if(spanIngredient.length > 0) itemPrice = parseFloat(spanIngredient.text());
    let totalPrice = parseFloat(spanBtnAdd.text());
    totalPrice -= itemPrice;
    totalPrice = totalPrice.toFixed(2);
    spanBtnAdd.text(totalPrice);

    let itemList = $(btnSpanRemove).closest(".popup-list-remove");
    itemList.removeClass("popup-list-remove").addClass("popup-list-add");
    itemList.appendTo("#popup-ul-add");

    $(btnSpanRemove).removeClass("bi-x-circle");
    $(btnSpanRemove).addClass("bi-plus-lg");

  },

  addIngredient: function (itemList) {
    let span = $(itemList).find("span.bi-plus-lg").first();
    span.removeClass("bi-plus-lg");
    span.addClass("bi-x-circle");

    let spanIngredient = $(itemList).find("span.popup-list-add-price").first();
    let spanBtnAdd = $("#popup-btn-add").find("span#total-price").first();
    if(spanIngredient.text().length > 0){
      let itemPrice = parseFloat(spanIngredient.text());
      let totalPrice = parseFloat(spanBtnAdd.text());
      totalPrice += itemPrice;
      totalPrice = totalPrice.toFixed(2);
      spanBtnAdd.text(totalPrice);
    }

    $(itemList).removeClass("popup-list-add").addClass("popup-list-remove");
    $(itemList).appendTo("#popup-ul-remove");
  },

  addPizzaMoment: function (){
    //let 
  }
};