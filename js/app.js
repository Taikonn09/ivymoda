//------------banner trên trang chủ---------------  
const images = [
    'images/banner1.jpg',
    'images/banner2.jpg',
    'images/banner3.jpg'
];

let currentImageIndex = 0;
const bannerImage = document.querySelector('.banner-page img');
const radios = document.querySelectorAll('.input-radio input[type=radio]');

function switchImage() {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    bannerImage.src = images[currentImageIndex];

    radios.forEach((radio, index) => {
        if (index === currentImageIndex) {
            radio.setAttribute('checked', 'checked');
        } else {
            radio.removeAttribute('checked');
        }
    });
}
setInterval(switchImage, 3000);

//---------------nút về đầu trang------------------------------
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
// Lấy đối tượng button
var topButton = document.querySelector('.top-page-btn');

// Thêm sự kiện cuộn
topButton.addEventListener('click', scrollToTop);
window.addEventListener('scroll', function () {
    // Kiểm tra vị trí cuộn
    if (window.scrollY > 0) {
        // Hiển thị nút khi vị trí cuộn > 0
        topButton.style.opacity = '1';
        topButton.style.pointerEvents = 'auto';
    } else {
        // Ẩn nút khi vị trí cuộn = 0
        topButton.style.opacity = '0';
        topButton.style.pointerEvents = 'none';
    }
});

//------------------------ẩn hiện giỏ hàng---------------------------
function showCart() {
    var x = document.getElementById("show-cart");
    if (x.style.display == "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}
function hideCart() {
    var x = document.getElementById("show-cart");
    x.style.display = "none";
}

function showCart() {
    var x = document.getElementById("show-cart");
    x.classList.add("show");
}

function hideCart() {
    var x = document.getElementById("show-cart");
    x.classList.remove("show");
}

//-----------------------thêm sp vào giỏ hàng-----------------------------
let cartItems = []; // mảng chứa thông tin sản phẩm
let cartCount = 0; // biến đếm số lượng sản phẩm trong giỏ hàng

// Lấy tất cả các nút "Thêm vào giỏ hàng" và gán sự kiện click cho chúng
const addToCartButtons = document.querySelectorAll('.add-to-cart');
addToCartButtons.forEach(button => {
  button.addEventListener('click', () => {
    // Lấy thông tin sản phẩm từ các phần tử HTML tương ứng
    const productName = button.parentNode.parentNode.querySelector('.product-name').textContent;
    const productPrice = button.parentNode.querySelector('.price-new').textContent;

    // Tạo đối tượng sản phẩm
    const product = { name: productName, price: productPrice };

    // Thêm sản phẩm vào mảng và tăng biến đếm
    cartItems.push(product);
    cartCount++;

    // Hiển thị số lượng sản phẩm trên biểu tượng giỏ hàng
    const cartBadge = document.querySelector('.shopping-cart');
    cartBadge.innerHTML = `<span class="material-symbols-outlined">local_mall</span><p>${cartCount}</p>`;

    // Hiển thị sản phẩm trong giỏ hàng
    const cartList = document.querySelector('#cart-items');
    cartList.innerHTML += `<li>${productName} - ${productPrice}</li>`;

    // Tính tổng tiền trong giỏ hàng
    let cartTotal = 0;
    cartItems.forEach(item => {
      cartTotal += parseInt(item.price.replace(/\D/g, ''));
    });
    document.querySelector('#cart-total').textContent = `Tổng tiền: ${cartTotal} đ`;
  });
});

