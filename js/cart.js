// Lấy tất cả các nút "Thêm vào giỏ hàng" và gán sự kiện click cho chúng
const addToCartButtons = document.querySelectorAll('.add-to-cart');
addToCartButtons.forEach(button => {
  button.addEventListener('click', () => {
    // Lấy thông tin sản phẩm
    const productItem = button.closest('.product-item');
    const productName = productItem.querySelector('.product-name').textContent;
    const selectedColor = productItem.querySelector('input[name="color"]:checked').value;
    const productPrice = productItem.querySelector('.price-new').textContent;

    // Hiển thị size-select
    const sizeSelect = productItem.querySelector('#size-select');
    sizeSelect.classList.remove('hidden');

    // Lấy phần tử success-overlay
    const successOverlay = document.getElementById('success-overlay');

    // Ẩn size-select và hiển thị thông báo thành công
    function hideSizeSelect() {
      sizeSelect.classList.add('hidden');
      successOverlay.classList.remove('hidden');

      // Ẩn thông báo thành công sau 1 giây
      setTimeout(function() {
        successOverlay.classList.add('hidden');
      }, 1000);
    }

    // Gán sự kiện click cho các lựa chọn size
    const sizeOptions = sizeSelect.querySelectorAll('li');
    sizeOptions.forEach(option => {
      option.addEventListener('click', () => {
        const selectedSize = option.textContent;

        // Ẩn phần tử size-select khi người dùng đã chọn kích thước
        hideSizeSelect();

        // Tạo đối tượng sản phẩm
        const product = { name: productName, color: selectedColor, size: selectedSize, price: productPrice, quantity: 1 };

        // Hiển thị thông tin sản phẩm trong giỏ hàng
        const showCart = document.querySelector('#my-cart');
        showCart.innerHTML = `
          <div id="cart-items">
            <div>
                
            </div>

            <span class="cart-name">${product.name}</span>
            <div class"color-size">
                <span class="cart-color">Màu sắc: ${product.color}</span>
                <span class="cart-size">Kích thước: ${product.size}</span>
            </div>
            <span class="cart-price">Đơn giá: ${product.price}</span> <br>
            <span class="cart-quantity">
              <button class="decrease-quantity" onclick="decreaseCartItemQuantity()">-</button>
              <input class="input-quantity" type="number" min="0" value="${product.quantity}" onchange="updateCartItemQuantity(this.value)" />
              <button class="increase-quantity" onclick="increaseCartItemQuantity()">+</button>
            </span>
          </div>
        `;

        // Hiển thị giỏ hàng
        showCart.style.display = 'block';

        // Lưu trữ thông tin sản phẩm
        showCart.dataset.product = JSON.stringify(product);

        // Gán sự kiện cho nút tăng giảm số lượng
        const decreaseQuantityButton = showCart.querySelector('.decrease-quantity');
        const increaseQuantityButton = showCart.querySelector('.increase-quantity');
        decreaseQuantityButton.addEventListener('click', decreaseCartItemQuantity);
        increaseQuantityButton.addEventListener('click', increaseCartItemQuantity);
      });
    });
  });
});


// Giảm số lượng sản phẩm trong giỏ hàng
function decreaseCartItemQuantity() {
  const myCart = document.querySelector('#my-cart');
  const quantityInput = myCart.querySelector('input[type="number"]');
  let quantity = parseInt(quantityInput.value);
  
  if (quantity > 0) {
  quantity--;
  quantityInput.value = quantity;
  }
  
  if (quantity === 0) {
  // Xóa sản phẩm khỏi giỏ hàng
  myCart.style.display = 'none';
  myCart.innerHTML = '';
  myCart.dataset.product = '';
  }
  }
  
  // Tăng số lượng sản phẩm trong giỏ hàng
  function increaseCartItemQuantity() {
  const showCart = document.querySelector('#show-cart');
  const quantityInput = showCart.querySelector('input[type="number"]');
  let quantity = parseInt(quantityInput.value);
  
  quantity++;
  quantityInput.value = quantity;
  }
  
  // Cập nhật số lượng sản phẩm trong giỏ hàng
  function updateCartItemQuantity(value) {
  const showCart = document.querySelector('#show-cart');
  const quantityInput = showCart.querySelector('input[type="number"]');
  let quantity = parseInt(value);
  
  if (quantity < 0) {
  quantity = 0;
  }
  
  quantityInput.value = quantity;
  }