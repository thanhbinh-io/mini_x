# 🐦 MiniX – Mạng Xã Hội X (Twitter) Clone Full-Stack

> Dự án xây dựng nền tảng mạng xã hội hiện đại. Ứng dụng tích hợp trợ lý trí tuệ nhân tạo **MiniX AI (Google Gemini)**, hệ thống **nhắn tin trực tiếp 1-1**, **chuỗi hội thoại phân cấp (Thread Replies)**, **cài đặt bảo mật & quyền riêng tư** và **bảng điều khiển quản trị viên (Admin Dashboard)**.

---

## 👥 Nhóm Tác Giả & Phân Chia Trách Nhiệm (25% mỗi thành viên)

Dự án được phân bổ đồng đều trách nhiệm và khối lượng công việc, phối hợp thông qua mô hình Git Branching & Pull Request:

| STT | Thành viên | Vai trò | Tỷ lệ | Phân hệ đảm nhiệm chi tiết |
|:---:|---|:---:|:---:|---|
| 1 | **Nguyễn Thanh Bình** | **Trưởng nhóm** | **25%** | **Nền tảng kiến trúc (Core Architecture):**<br>- Thiết lập Laravel 12 + Vue 3 (Inertia.js), Tailwind CSS v3 Dark/Light mode.<br>- Thiết kế cấu trúc Database tổng thể, chuẩn hóa Routing & Authentication (Breeze Dark Theme).<br>- Quản lý GitHub Repository, điều phối Code Review và Merge các Pull Request. |
| 2 | **Võ Tấn Đạt** | **Thành viên** | **25%** | **Hệ thống Bài viết & Tương tác (Tweets & Interactions):**<br>- Đăng bài viết (Tweet), upload ảnh/video, hiển thị số lượt xem (Views Count).<br>- Tương tác: Thả tim (Like), Đăng lại (Retweet), Đánh dấu (Bookmark), Trích dẫn (Quote Tweet).<br>- Chuỗi hội thoại bình luận phân cấp (Thread Replies) và Khám phá xu hướng Hashtag (#Trending). |
| 3 | **Nguyễn Quốc Khánh** | **Thành viên** | **25%** | **Mạng lưới Kết nối & Nhắn tin (Network & Direct Messages):**<br>- Cơ chế Theo dõi (Follow / Unfollow), Chặn (Block), Tắt tiếng (Mute).<br>- Trang Hồ sơ cá nhân người dùng (Avatar, Banner, Bio, Tabs: Tweets / Replies / Likes / Media).<br>- Hộp thư nhắn tin trực tiếp 1-1 (Direct Messages) tìm kiếm người nhận và trò chuyện riêng tư. |
| 4 | **Huỳnh Triệu An** | **Thành viên** | **25%** | **Trợ lý AI, Thông báo & Quản trị (AI, Notifications & Admin):**<br>- Tích hợp trợ lý trí tuệ nhân tạo **MiniX AI Bot** với Google Gemini API (render Markdown & nút copy code).<br>- Trung tâm thông báo hệ thống tự động (Notifications khi có tương tác).<br>- Cài đặt bảo mật (Private Account, đổi mật khẩu) và Bảng điều khiển Quản trị viên (Admin Dashboard duyệt báo cáo, khóa user, xóa tweet). |

---

## 🚀 Tính Năng Nổi Bật Của Dự Án

- **Xác thực & Bảo mật:** Đăng nhập linh hoạt bằng Email hoặc Username, xác thực kích hoạt tài khoản qua Gmail (Email Verification), bảo vệ route bằng Middleware `verified` và `check.suspended`, phân quyền Admin/User chặt chẽ.
- **Dark Mode / Light Mode:** Chuyển đổi giao diện Sáng / Tối mượt mà chuẩn phong cách X.com, lưu trạng thái tự động vào trình duyệt.
- **Tương tác thời gian thực với Inertia.js:** Trải nghiệm Single Page Application (SPA) tải trang tức thì, không giật lag màn hình.
- **Xử lý Thread Tweets đa cấp:** Xem chi tiết bài viết cùng toàn bộ cây bình luận liên quan chuẩn xác.
- **MiniX AI Trợ lý thông minh:** Tích hợp Google Gemini trả lời tức thì, nhận diện ngữ cảnh và hỗ trợ viết bài/mã lập trình.
- **Admin Dashboard chuyên nghiệp:** Thống kê số lượng bài đăng, quản trị viên có thể khóa tài khoản vi phạm và xử lý báo cáo nội dung (Reports).

---

## 🛠️ Công Nghệ Sử Dụng

- **Backend:** [Laravel 12](https://laravel.com/) (PHP 8.2+) – Eloquent ORM, Seeders, Policies, Middlewares.
- **Frontend:** [Vue 3](https://vuejs.org/) (Composition API `<script setup>`) + [Inertia.js v2](https://inertiajs.com/).
- **CSS Framework:** [Tailwind CSS v3](https://tailwindcss.com/) – Custom dark mode palette (`darkMode: 'class'`).
- **Trí tuệ nhân tạo:** [Google Gemini API](https://ai.google.dev/) (`gemini-1.5-flash`).
- **Cơ sở dữ liệu:** MySQL (XAMPP MariaDB).
- **Công cụ đóng gói:** [Vite](https://vitejs.dev/).

---

## 📥 Hướng Dẫn Cài Đặt Chi Tiết (Dành cho Giảng viên / Người chấm bài)

### Bước 1: Clone mã nguồn về máy
```bash
git clone https://github.com/thanhbinh-io/mini_x.git
cd mini_x
```

### Bước 2: Cài đặt các gói phụ thuộc (Dependencies)
```bash
# 1. Cài đặt thư viện Backend PHP
composer install

# 2. Cài đặt thư viện Frontend Node.js
npm install
```

### Bước 3: Tạo file cấu hình môi trường (`.env`)
- **Trên Windows PowerShell:**
  ```powershell
  copy .env.example .env
  ```
- **Trên macOS / Linux:**
  ```bash
  cp .env.example .env
  ```

Tạo khóa mã hóa ứng dụng Laravel:
```bash
php artisan key:generate
```

> [!NOTE]
> File `.env.example` đã được cấu hình sẵn 100% phù hợp với chuẩn mặc định của XAMPP:
> ```ini
> DB_CONNECTION=mysql
> DB_HOST=127.0.0.1
> DB_PORT=3306
> DB_DATABASE=mini_x
> DB_USERNAME=root
> DB_PASSWORD=
> ```

### Bước 4: Khởi tạo Cơ sở dữ liệu

1. Bật **Apache** và **MySQL** trong ứng dụng **XAMPP Control Panel**.
2. Mở trình duyệt vào `http://localhost/phpmyadmin`, tạo một Database mới có tên: **`mini_x`** (Bảng mã: `utf8mb4_unicode_ci`).
3. Khởi tạo cấu trúc bảng và nạp dữ liệu mẫu (chọn 1 trong 2 cách bên dưới):

* **Cách 1 (Khuyên dùng - Chuẩn Laravel):** Chạy 1 câu lệnh duy nhất tại terminal:
  ```bash
  php artisan migrate:fresh --seed
  ```
  *(Lệnh này tự động tạo 15 bảng cơ sở dữ liệu và nạp toàn bộ bài viết, người dùng mẫu, hashtag và cấp quyền Admin).*

* **Cách 2 (Dự phòng truyền thống qua phpMyAdmin):**
  - Mở `http://localhost/phpmyadmin` > Chọn database `mini_x`.
  - Chọn tab **Import (Nhập)** > Chọn file `database/mini_x.sql` trong thư mục dự án và bấm **Import**.

### Bước 5: Tạo liên kết thư mục lưu trữ media
```bash
php artisan storage:link
```

### Bước 6: Biên dịch giao diện Frontend
```bash
npm run build
```

### Bước 7: Khởi chạy ứng dụng
```bash
php artisan serve
```

Mở trình duyệt và truy cập: **`http://127.0.0.1:8000`**

---

## 👤 Danh Sách Tài Khoản Thử Nghiệm (Demo Accounts)

Mật khẩu mặc định cho toàn bộ tài khoản mẫu là quy ước chuẩn quốc tế của Laravel: **`password`**

| Vai trò / Quyền | Tên hiển thị | Tên tài khoản | Email đăng nhập | Mật khẩu | Chức năng nổi bật có thể test |
|---|---|---|---|---|---|
| 👑 **Admin Quản trị** | Demo User | `@demouser` | `demo@example.com` | `password` | Truy cập **Admin Dashboard** (`/admin`), duyệt báo cáo, khóa/mở khóa tài khoản, xóa bài vi phạm. |
| 🧑 **Người dùng mẫu 1** | Elon Musk | `@elonmusk` | `elon@x.com` | `password` | Đăng tweet, đính kèm media, tương tác Like/Retweet, nhắn tin 1-1. |
| 🧑 **Người dùng mẫu 2** | Taylor Otwell | `@taylorotwell` | `taylor@laravel.com` | `password` | Thử nghiệm follow/unfollow, đăng tweet bình luận. |
| 🧑 **Người dùng mẫu 3** | Evan You | `@youyuxi` | `evan@vuejs.org` | `password` | Trò chuyện trực tiếp (DM) và kiểm tra tính năng riêng tư. |
| 🤖 **MiniX AI Bot** | MiniX AI | `@geminibot` | *Tích hợp sẵn* | *Không cần đăng nhập* | Trò chuyện trực tiếp tại mục **MiniX AI** trên thanh điều hướng bên trái. |

> [!TIP]
> **Quy chuẩn mật khẩu:** Khi người dùng tự tay đăng ký tài khoản mới (`/register`) hoặc đổi mật khẩu trong phần cài đặt (`/settings/account`), hệ thống áp dụng đầy đủ tiêu chuẩn bảo mật mạnh của Laravel (`Rules\Password::defaults()`).

---

## 📂 Cấu Trúc Thư Mục Dự Án

```text
mini_x/
├── app/
│   ├── Http/Controllers/       # Bộ điều khiển xử lý logic nghiệp vụ (Tweets, Admin, AI, DM, ...)
│   ├── Http/Middleware/        # Middleware phân quyền (Admin, CheckSuspended, Inertia)
│   └── Models/                 # Eloquent Models (User, Tweet, Like, Follow, Message, Report, ...)
├── database/
│   ├── migrations/             # 15 file migration tạo bảng theo trình tự thời gian
│   ├── seeders/                # TweetsSeeder & AdminSeeder nạp dữ liệu mẫu
│   └── mini_x.sql              # Bản xuất dự phòng cho phpMyAdmin
├── resources/
│   ├── js/
│   │   ├── Components/         # Các UI component tái sử dụng (Button, Modal, Dropdown, ...)
│   │   ├── Layouts/            # AuthenticatedLayout, GuestLayout (Dark/Light mode)
│   │   └── Pages/              # Các trang Vue (Welcome/Feed, Profile, Messages, Admin, Bot, ...)
│   └── views/app.blade.php     # Template gốc tích hợp script Dark Mode và Ziggy Routes
├── routes/
│   ├── web.php                 # Toàn bộ 69 routes chức năng của ứng dụng
│   └── auth.php                # Routes xác thực đăng nhập, đăng ký, quên mật khẩu
└── tailwind.config.js          # Cấu hình Tailwind CSS v3 hỗ trợ darkMode: 'class'
```
