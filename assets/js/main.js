$(document).ready(function () {
  $(".cat-btn").click(function () {
    var categoryId = $(this).data("category-id");

    $.ajax({
      type: "POST",
      url: "functions.php",
      data: { category_id: categoryId },
      success: function (response) {
        $(".card-container").html(response);
      },
    });
  });

  $("#reset").click(function () {
    $.ajax({
      type: "POST",
      url: "functions.php",
      data: { reset: true },
      success: function (response) {
        $(".card-container").html(response);
      },
    });
  });
});
function updateDisplayedQuantity(productId) {
  const quantityInput = document.getElementById('quantityInput' + productId);
  const displayedQuantity = document.getElementById('displayedQuantity' + productId);
  displayedQuantity.textContent = quantityInput.value;
}

