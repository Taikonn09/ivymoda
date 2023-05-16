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












  
  
  