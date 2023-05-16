
/*---------------------chọn màu sp------------------- */

document.addEventListener('DOMContentLoaded', function () {
    const colorOptions = document.querySelectorAll('.color-option');

    colorOptions.forEach(function (option) {
        option.addEventListener('click', function () {
            colorOptions.forEach(function (option) {
                option.classList.remove('checked');
            });
            option.classList.add('checked');
        });
    });
});

/*----------------------------------chọn size sp--------------------------*/

function showSizeSelect() {
    var sizeSelect = document.getElementById("size-select");
    sizeSelect.classList.remove("hidden");
}
var addToCartButton = document.querySelector(".add-to-cart");
addToCartButton.addEventListener("click", showSizeSelect);
function selectSize(element) {
    var lis = document.querySelectorAll("#size-select li");
    lis.forEach(function (li) {
        li.classList.remove("selected");
    });

    element.classList.add("selected");
}


/*------------------ thêm sp vào giỏ hàng-------------------------*/



