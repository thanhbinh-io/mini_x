# 🐦 MiniX – Mạng xã hội X (Twitter) Clone Full-Stack

> Dự án xây dựng nền tảng mạng xã hội hiện đại lấy cảm hứng từ giao diện và trải nghiệm của **X.com (Twitter)**, tích hợp trợ lý trí tuệ nhân tạo **MiniX AI (Google Gemini)**, hệ thống **nhắn tin trực tiếp 1-1 thời gian thực**, **cài đặt quyền riêng tư nâng cao** và **bảng điều khiển quản trị viên**.

---

## 👥 Nhóm tác giả thực hiện (Phân chia đồng đều 25% mỗi thành viên)

| Thành viên | Tỷ lệ | Phân hệ đảm nhiệm |
|---|:---:|---|
| **Nguyễn Thanh Bình (Trưởng nhóm)** | **25%** | **Nền tảng kiến trúc (Core Architecture):** Thiết lập Laravel 12 + Vue 3 Inertia, quản lý GitHub Repository, Code Review và Merge Pull Request. |
| **Võ Tấn Đạt** | **25%** | **Hệ thống bài viết & Tương tác:** Thả tim (Like), Đăng lại (Retweet), Đánh dấu (Bookmark), Chuỗi hội thoại (Thread replies), Khám phá xu hướng & Tìm kiếm. |
| **Nguyễn Quốc Khánh** | **25%** | **Mạng lưới kết nối & Nhắn tin:** Theo dõi (Follow), Chặn (Block), Tắt tiếng (Mute), Trang hồ sơ cá nhân tùy chỉnh và Hộp thư nhắn tin 1-1 (Direct Messages). |
| **Huỳnh Triệu An** | **25%** | **Trợ lý AI & Quản trị:** Tích hợp MiniX AI Bot (Gemini), Trung tâm Thông báo (Notifications), Cài đặt bảo mật, Creator Studio & Admin Dashboard. |

---

## 🛠️ Công nghệ sử dụng

- **Backend:** [Laravel 12](https://laravel.com/) (PHP 8.2+) – Kiến trúc MVC, Eloquent ORM, Authentication, Authorization Policies, Storage Disks.
- **Frontend:** [Vue 3](https://vuejs.org/) (`<script setup>` Composition API) – Reactive Components.
- **Single Page Application (SPA):** [Inertia.js](https://inertiajs.com/) – Kết nối mượt mà giữa Laravel và Vue mà không cần viết REST API thủ công, tải trang tức thì không giật lag.
- **Giao diện & Thiết kế:** [Tailwind CSS](https://tailwindcss.com/) – Thiết kế chuẩn X.com, hỗ trợ đầy đủ **Dark Mode** và **Light Mode**.
- **Trí tuệ nhân tạo (AI):** [Google Gemini API](https://ai.google.dev/) – Phản hồi thông minh, render Markdown code block có nút sao chép mã.
- **Cơ sở dữ liệu:** MySQL (MariaDB trong XAMPP).
- **Bộ đóng gói tài nguyên:** [Vite](https://vitejs.dev/) – Tốc độ build siêu nhanh.

---

## 📥 Hướng dẫn tải về và cài đặt chi tiết (Dành cho Giảng viên / Người chấm bài)

### Bước 1: Clone mã nguồn về máy
```bash
git clone https://github.com/thanhbinh-io/mini_x.git
cd mini_x
```

### Bước 2: Cài đặt thư viện Backend
```bash
composer install
```

### Bước 3: Cài đặt thư viện Frontend
```bash
npm install
```

### Bước 4: Tạo file cấu hình môi trường (.env)
- **Windows (PowerShell):**
  ```powershell
  copy .env.example .env
  ```
- **macOS / Linux:**
  ```bash
  cp .env.example .env
  ```

Tạo khóa bảo mật cho ứng dụng:
```bash
php artisan key:generate
```

### Bước 5: Cấu hình Cơ sở dữ liệu
1. Mở **XAMPP Control Panel**, nhấn **Start** cả **Apache** và **MySQL**.
2. Mở trình duyệt vào `http://localhost/phpmyadmin`, tạo một Database mới có tên: **`mini_x`** (Bảng mã: `utf8mb4_unicode_ci`).
3. File `.env` mặc định đã được cấu hình sẵn kết nối tới MySQL XAMPP:
   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mini_x
   DB_USERNAME=root
   DB_PASSWORD=
   ```

### Bước 6: Tạo liên kết thư mục lưu trữ ảnh/video
```bash
php artisan storage:link
```

### Bước 7: Khởi tạo bảng dữ liệu và nạp dữ liệu mẫu
```bash
php artisan migrate:fresh --seed
```
*(Lệnh này tự động tạo 15 bảng cơ sở dữ liệu, nạp sẵn các tài khoản demo chuẩn, bài viết mẫu có ảnh/video và cấp quyền Admin).*

### Bước 8: Biên dịch giao diện Frontend
```bash
npm run build
```

### Bước 9: Khởi chạy máy chủ ứng dụng
```bash
php artisan serve
```

Truy cập trình duyệt: **`http://127.0.0.1:8000`**

---

## 👤 Danh sách tài khoản mẫu (Demo Accounts)

Tất cả tài khoản demo đều dùng chung mật khẩu quy ước chuẩn: **`password`**

| Vai trò | Tên hiển thị | Tên tài khoản | Email đăng nhập | Mật khẩu |
|---|---|---|---|---|
| 👑 **Admin Quản trị** | Demo User | `@demouser` | `demo@example.com` | `password` |
| 🧑 **Người dùng mẫu** | Elon Musk | `@elonmusk` | `elon@x.com` | `password` |
| 🧑 **Người dùng mẫu** | Taylor Otwell | `@taylorotwell` | `taylor@laravel.com` | `password` |
| 🧑 **Người dùng mẫu** | Evan You | `@youyuxi` | `evan@vuejs.org` | `password` |
| 🧑 **Người dùng mẫu** | John Weeks | `@johnweeksdev` | `john@example.com` | `password` |

> 💡 **Ghi chú về mật khẩu:** Khi người dùng tự tay đăng ký tài khoản mới (`/register`) hoặc đổi mật khẩu trong phần cài đặt (`/settings/account`), hệ thống tự động áp dụng bộ quy tắc kiểm tra bảo mật chuẩn của Laravel (`Rules\Password::defaults()`).
