# DỰ ÁN THƯƠNG MẠI ĐIỆN TỬ: WEB BÁN CÂY CẢNH
Đây là một dự án được thực hiện trong phạm vi đồ án ở trường học còn rất nhiều sai sót nhỏ và không thực sự clean code. Lưu ý: Dự án vẫn còn đang phát triển
- Các công nghệ được sử dụng trong dự án này:
    + PHP thuần + mô hình OOP
    + MySQL
    + Theme User (HTML/CSS): Sislaf theme

# Hình ảnh về dự án
Demo web

![Img_Demo_Web](https://user-images.githubusercontent.com/132061931/261525668-e7fa38cb-8ce8-47ab-af66-090226b41d1c.png)

![Img_Admin1](https://user-images.githubusercontent.com/132061931/261525408-84d04690-c100-4848-a201-a620cb1c00b4.png)

Mô hình dữ liệu quan hệ

![Img_SQL](https://user-images.githubusercontent.com/132061931/243055036-c7891f06-a01c-44af-a4df-f365f6de8527.pngg)

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
    
Thẻ test:

| Ngân hàng     |                 NCB|
| :------------ |:------------------:|
| Số thẻ        | 9704198526191432198|
| Tên chủ thẻ   | NGUYEN VAN A       |
| Ngày phát hành| 07/15              |
| Mật khẩu OTP  | 123456             |