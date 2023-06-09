//--------------------ẩn nút đăng xuất-----------------------------
// Lấy các phần tử cần thiết
const adminImg = document.getElementById('admin-img');
const adminName = document.getElementById('admin-name');
const logoutLink = document.getElementById('logout-link');
const iconRightName = document.querySelector('.icon-right-name');

// Thêm trình xử lý sự kiện click cho hình ảnh
adminImg.addEventListener('click', toggleLogout);
// Thêm trình xử lý sự kiện click cho tên người dùng
adminName.addEventListener('click', toggleLogout);

// Hàm xử lý chuyển đổi tbrạng thái của phần tử "logout-admin"
function toggleLogout() {
  logoutLink.classList.toggle('hidden');
  if (logoutLink.classList.contains('hidden')) {
    iconRightName.classList.replace('fa-chevron-up', 'fa-chevron-down');
  } else {
    iconRightName.classList.replace('fa-chevron-down', 'fa-chevron-up');
  }
}


//---------------------ẩn hiện này ở chỗ ql sản phẩm---------------------
const dropdownToggle = document.querySelector('.dropdown-toggle');
dropdownToggle.addEventListener('click', function() {
  const dropdownMenu = this.nextElementSibling;
  dropdownMenu.classList.toggle('show');
  this.classList.toggle('active');
  const icon = this.querySelector("i");
  if (dropdownMenu.classList.contains("show")) {
    icon.classList.remove("fa-chevron-down");
    icon.classList.add("fa-chevron-up");
  } else {
    icon.classList.remove("fa-chevron-up");
    icon.classList.add("fa-chevron-down");
  }
});

// Sử dụng sự kiện click bên ngoài để đóng menu khi nhấn ra ngoài
document.addEventListener('click', function(event) {
  const dropdowns = document.querySelectorAll('.dropdown-menu');
  dropdowns.forEach(function(dropdown) {
    if (dropdown.classList.contains('show') && !dropdown.contains(event.target) && !dropdownToggle.contains(event.target)) {
      dropdown.classList.remove('show');
      dropdownToggle.classList.remove('active');
      const icon = dropdownToggle.querySelector("i");
      icon.classList.remove("fa-chevron-up");
      icon.classList.add("fa-chevron-down");
    }
  });
});



