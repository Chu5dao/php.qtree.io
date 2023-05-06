# DỰ ÁN THƯƠNG MẠI ĐIỆN TỬ: WEB BÁN CÂY CẢNH
Đây là một dự án được thực hiện trong phạm vi đồ án ở trường học còn rất nhiều sai sót nhỏ và không thực sự clean code
- Các công nghệ được sử dụng trong dự án này:
    + PHP thuần + mô hình OOP
    + MySQL
    + Theme User (HTML/CSS): Sislaf theme

# Hình ảnh về dự án
Demo web

![Img_Demo_Web](/Untitled.png)

Mô hình dữ liệu quan hệ

![Img_SQL](/Untitled1.png)

# CÀI ĐẶT CẤU HÌNH KẾT NỐI
File config.php
```
<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "qtree"); //Tên DB của bạn//
?>
```

# CÁC CHỨC NĂNG TRONG DỰ ÁN
1. Người dùng
    - Trang chủ
    - Xem cửa hàng
    - Liên hệ
    - Đăng nhập/Đăng ký
    - Tìm kiếm sản phẩm
    - Giỏ hàng
    - Lịch sử đặt hàng
    - Sản phẩm yêu thích
    - Thanh toán
2. NV Bán hàng
    - QL Danh mục sản phẩm
    - QL Sản phẩm
    - QL Bình luận
    - QL Đơn hàng
    - QL Liên hệ
3. NV QL Kho
    - QL Danh mục sản phẩm
    - QL Sản phẩm
    - QL Nhà cung cấp
4. NV Tài chính
    - QL Nhân viên
    - QL Sản phẩm - Thu chi
    - QL Liên hệ
    - QL Nhân viên