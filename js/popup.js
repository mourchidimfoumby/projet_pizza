
export const popup = {
  close : function (objet, action) {
    if(action == "displayCreateForm")
      window.location.href = "index.php?objet=" + objet + "&action=displayStock";
    else window.location.href = "index.php?objet=" + objet;
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

selectElementPizza: function(itemIngredient, event){
  let checkbox = $(itemIngredient).find(".myCheckBox");
  let inputQte = $(itemIngredient).find(".myCheckBox-qte");
  if (!checkbox.prop("checked")){
    checkbox.prop("disabled", false);
    inputQte.prop("disabled", false);
    inputQte.prop("required", true);
    checkbox.prop("checked", !checkbox.prop("checked"));
    $(itemIngredient).toggleClass("highlight", checkbox.prop("checked"));
  }
  else if(checkbox.prop("checked") && !$(event.target).is(".myCheckBox-qte")){
    checkbox.prop("disabled", true);
    inputQte.prop("disabled", true);
    inputQte.prop("required", false);
    checkbox.prop("checked", !checkbox.prop("checked"));
    $(itemIngredient).toggleClass("highlight", checkbox.prop("checked"));
  }
}
};