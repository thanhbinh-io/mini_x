# 🐦 MiniX – Mạng Xã Hội X (Twitter) Clone Full-Stack

> Dự án xây dựng nền tảng mạng xã hội hiện đại. Ứng dụng tích hợp trợ lý trí tuệ nhân tạo **MiniX AI (Google Gemini)**, hệ thống **nhắn tin trực tiếp 1-1**, **chuỗi hội thoại phân cấp (Thread Replies)**, **cài đặt bảo mật & quyền riêng tư** và **bảng điều khiển quản trị viên (Admin Dashboard)**.

---

## 👥 Nhóm Tác Giả & Phân Chia Trách Nhiệm (25% mỗi thành viên)

Dự án được phân bổ đồng đều trách nhiệm và khối lượng công việc, phối hợp thông qua mô hình Git Branching & Pull Request:

| STT | Thành viên | Vai trò | Tỷ lệ | Phân hệ đảm nhiệm chi tiết |
|:---:|---|:---:|:---:|---|
| 1 | **Phạm Thanh Bình** | **Trưởng nhóm** | **25%** | **Nền tảng kiến trúc (Core Architecture):**<br>- Thiết lập Laravel 12 + Vue 3 (Inertia.js), Tailwind CSS v3 Dark/Light mode.<br>- Thiết kế cấu trúc Database tổng thể, chuẩn hóa Routing & Authentication (Breeze Dark Theme).<br>- Quản lý GitHub Repository, điều phối Code Review và Merge các Pull Request. |
| 2 | **Võ Tấn Đạt** | **Thành viên** | **25%** | **Hệ thống Bài viết & Tương tác (Tweets & Interactions):**<br>- Đăng bài viết (Tweet), upload ảnh/video, hiển thị số lượt xem (Views Count).<br>- Tương tác: Thả tim (Like), Đăng lại (Retweet), Đánh dấu (Bookmark), Trích dẫn (Quote Tweet).<br>- Chuỗi hội thoại bình luận phân cấp (Thread Replies) và Khám phá xu hướng Hashtag (#Trending). |
| 3 | **Nguyễn Quốc Khánh** | **Thành viên** | **25%** | **Mạng lưới Kết nối & Nhắn tin (Network & Direct Messages):**<br>- Cơ chế Theo dõi (Follow / Unfollow), Chặn (Block), Tắt tiếng (Mute).<br>- Trang Hồ sơ cá nhân người dùng (Avatar, Banner, Bio, Tabs: Tweets / Replies / Likes / Media).<br>- Hộp thư nhắn tin trực tiếp 1-1 (Direct Messages) tìm kiếm người nhận và trò chuyện riêng tư. |
| 4 | **Huỳnh Triều An** | **Thành viên** | **25%** | **Trợ lý AI, Thông báo & Quản trị (AI, Notifications & Admin):**<br>- Tích hợp trợ lý trí tuệ nhân tạo **MiniX AI Bot** với Google Gemini API (render Markdown & nút copy code).<br>- Trung tâm thông báo hệ thống tự động (Notifications khi có tương tác).<br>- Cài đặt bảo mật (Private Account, đổi mật khẩu) và Bảng điều khiển Quản trị viên (Admin Dashboard duyệt báo cáo, khóa user, xóa tweet). |

---

## 🚀 Tính Năng Nổi Bật Của Dự Án

- **Xác thực & Bảo mật:** Đăng nhập linh hoạt bằng Email hoặc Username, xác thực kích hoạt tài khoản qua Gmail (Email Verification), bảo vệ route bằng Middleware `verified` và `check.suspended`, phân quyền Admin/User chặt chẽ.
- **Dark Mode / Light Mode:** Chuyển đổi giao diện Sáng / Tối mượt mà chuẩn phong cách X.com, lưu trạng thái tự động vào trình duyệt.
- **Điều hướng SPA bằng Inertia.js:** Trải nghiệm Single Page Application (SPA) tải trang tức thì, không giật lag màn hình; hộp thư tin nhắn 1-1 cập nhật nội dung bằng cơ chế polling chu kỳ ~2.5 giây.
- **Xử lý Thread Tweets đa cấp:** Xem chi tiết bài viết cùng toàn bộ cây bình luận liên quan chuẩn xác.
- **MiniX AI Trợ lý thông minh:** Tích hợp Google Gemini trả lời tức thì, nhận diện ngữ cảnh và hỗ trợ viết bài/mã lập trình (yêu cầu đăng nhập).
- **Admin Dashboard chuyên nghiệp:** Thống kê số lượng bài đăng, quản trị viên có thể khóa tài khoản vi phạm và xử lý báo cáo nội dung (Reports).

---

## 🛠️ Công Nghệ Sử Dụng

- **Backend:** [Laravel 12](https://laravel.com/) (PHP 8.2+) – Eloquent ORM, Seeders, Policies, Middlewares.
- **Frontend:** [Vue 3](https://vuejs.org/) (Composition API `<script setup>`) + [Inertia.js v2](https://inertiajs.com/).
- **CSS Framework:** [Tailwind CSS v3](https://tailwindcss.com/) – Custom dark mode palette (`darkMode: 'class'`).
- **Trí tuệ nhân tạo:** [Google Gemini API](https://ai.google.dev/) (`gemini-3.5-flash-lite`, cấu hình linh hoạt qua biến `GEMINI_MODEL` trong `.env`).
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

---

## 🔑 Hướng Dẫn Lấy Khóa API Google Gemini (Kích hoạt MiniX AI)

Trợ lý **MiniX AI** tích hợp trực tiếp mô hình ngôn ngữ lớn của Google. Để kích hoạt tính năng chat thông minh này, bạn thực hiện như sau:

1. **Truy cập Google AI Studio:** Mở trình duyệt vào trang [https://aistudio.google.com/](https://aistudio.google.com/) và đăng nhập bằng tài khoản Google của bạn.
2. **Tạo API Key:**
   - Tại menu bên trái, chọn **Get API key** (hoặc truy cập thẳng [https://aistudio.google.com/app/apikey](https://aistudio.google.com/app/apikey)).
   - Bấm nút **Create API key** $\rightarrow$ Chọn **Create API key in new project** (hoặc chọn project Google Cloud sẵn có nếu có).
   - Hệ thống sẽ hiển thị một chuỗi ký tự khóa API của bạn. Bấm **Copy** để sao chép khóa này.
3. **Cấu hình vào file `.env`:**
   - Mở file `.env` ở thư mục gốc của dự án, tìm đến 2 dòng sau và dán khóa vừa copy vào:
   ```ini
   GEMINI_API_KEY=your_gemini_api_key_here
   GEMINI_MODEL=gemini-3.5-flash-lite
   ```
4. **Áp dụng cấu hình:**
   ```bash
   php artisan config:clear
   ```
> [!TIP]
> Khóa Gemini API hoàn toàn **miễn phí** với hạn mức sử dụng rất lớn cho mục đích học tập và phát triển cá nhân.

---

## 📧 Hướng Dẫn Cấu Hình Gmail Gửi Mail Xác Thực (Email Verification)

Dự án hỗ trợ tính năng gửi email xác thực tài khoản thật (`/verify-email`) và gửi link đặt lại mật khẩu khi quên tài khoản thông qua giao thức **Gmail SMTP**.

Google không cho phép dùng mật khẩu đăng nhập tài khoản thông thường mà yêu cầu tạo **Mật khẩu ứng dụng (App Password 16 ký tự)**:

### 1. Tạo Mật khẩu ứng dụng (App Password) trên Google
1. Mở trang Quản lý tài khoản Google: [https://myaccount.google.com/](https://myaccount.google.com/).
2. Chọn mục **Bảo mật** (Security) $\rightarrow$ Đảm bảo tài khoản đã **Bật Xác minh 2 bước (2-Step Verification)**.
3. Tìm kiếm từ khóa **"Mật khẩu ứng dụng"** trên thanh tìm kiếm của Google Account (hoặc truy cập trực tiếp link: [https://myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords)).
4. Nhập tên ứng dụng (ví dụ: `MiniX`) $\rightarrow$ Bấm **Tạo** (Create).
5. Google sẽ hiển thị một cửa sổ chứa mã mật khẩu gồm **16 ký tự** (ví dụ: `abcd efgh ijkl mnop`). Hãy copy chuỗi 16 ký tự này (lưu ý: bỏ các dấu cách khi dán).

### 2. Điền thông tin vào file `.env`
Mở file `.env` và cập nhật cụm cấu hình Mail như sau:

```ini
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email_cua_ban@gmail.com
MAIL_PASSWORD="your_16_char_app_password"   # Dán 16 ký tự App Password tạo ở bước trên (không khoảng trắng)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="email_cua_ban@gmail.com"
MAIL_FROM_NAME="MiniX"
```

### 3. Xóa cache cấu hình để Laravel nhận thông tin mới:
```bash
php artisan config:clear
```

> [!NOTE]
> **Chế độ kiểm thử offline nhanh:** Nếu không muốn cấu hình gửi mail thật, khi đăng ký tài khoản mới xong hệ thống sẽ chuyển đến trang `/verify-email`. Tại đây nhóm đã trang bị sẵn nút **"⚡ Kích hoạt tài khoản ngay (Chế độ phát triển)"** để kích hoạt tài khoản ngay tức thì mà không cần check hòm thư!

---

## 🗄️ Khởi Tạo Cơ Sở Dữ Liệu & Chạy Ứng Dụng

### Bước 4: Khởi tạo Cơ sở dữ liệu

1. Bật **Apache** và **MySQL** trong ứng dụng **XAMPP Control Panel**.
2. Mở trình duyệt vào `http://localhost/phpmyadmin`, tạo một Database mới có tên: **`mini_x`** (Bảng mã: `utf8mb4_unicode_ci`).
   *(Hoặc có thể tạo nhanh bằng 1 dòng lệnh trong Terminal: `mysql -u root -e "CREATE DATABASE IF NOT EXISTS mini_x CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"`)*
3. Khởi tạo cấu trúc bảng và nạp dữ liệu mẫu bằng lệnh:
   ```bash
   php artisan migrate --seed
   ```
   *(Lệnh này tự động tạo 16 bảng cơ sở dữ liệu và nạp toàn bộ bài viết, người dùng mẫu, hashtag và cấp quyền Admin).*

> [!WARNING]
> **Lưu ý về lệnh `migrate:fresh`:** Nếu bạn chạy lệnh `php artisan migrate:fresh --seed`, Laravel sẽ **XÓA SẠCH TOÀN BỘ BẢNG CŨ (DROP ALL TABLES)** trong cơ sở dữ liệu được cấu hình trước khi tạo lại từ đầu. Với cài đặt lần đầu trên database mới, hãy dùng `php artisan migrate --seed`. Chỉ dùng `migrate:fresh` khi bạn thực sự muốn reset trắng toàn bộ dữ liệu.

### Bước 5: Tạo liên kết thư mục lưu trữ media
```bash
php artisan storage:link
```

### Bước 6: Biên dịch giao diện Frontend
```bash
npm run build
```
> [!IMPORTANT]
> Bước này là **bắt buộc** sau khi vừa clone mã nguồn về máy để Vite đóng gói toàn bộ giao diện Vue & Tailwind CSS vào thư mục `public/build/`.

### Bước 7: Khởi chạy ứng dụng
```bash
php artisan serve
```

Mở trình duyệt và truy cập: **`http://127.0.0.1:8000`**

---

## 📱 Hướng Dẫn Mở Web Trên Thiết Bị Khác & Thiết Bị Ở Xa (Mobile / Remote Device)

Để giảng viên hoặc người đánh giá có thể mở website MiniX trực tiếp trên điện thoại, máy tính bảng hoặc một thiết bị ở xa hoàn toàn (qua Internet), thực hiện theo các cách sau:

### Cách 1: Thiết bị ở xa hoàn toàn qua Internet (Dành cho 4G/5G hoặc mạng khác)

#### Lựa chọn A: Dùng `localtunnel` (Nhanh nhất, không cần tạo tài khoản)

1. Đảm bảo **MySQL trong XAMPP** và lệnh `php artisan serve` đang chạy ở port 8000.
2. Mở một cửa sổ Terminal mới và chạy:
   ```powershell
   npx localtunnel --port 8000
   ```
3. Bạn sẽ nhận được một URL dạng:
   ```text
   https://xxxx.loca.lt
   ```
4. Gửi link này cho thiết bị ở xa mở trực tiếp trên trình duyệt.

> [!IMPORTANT]
> **Khắc phục lỗi màn hình trắng khi dùng localtunnel:**
> - **Nhập Tunnel Password:** Lần đầu mở link `*.loca.lt`, hệ thống sẽ yêu cầu nhập mật khẩu bảo vệ. Bạn mở [https://loca.lt/mytunnelpassword](https://loca.lt/mytunnelpassword) trên máy tính đang chạy web để lấy dãy số IP của bạn, dán vào ô rồi bấm **Click to Submit** là web sẽ tải.
> - **Đảm bảo không bị kẹt file dev:** Cần chạy `npm run build` và đảm bảo thư mục dự án không còn file `public/hot`.

#### Lựa chọn B: Dùng `ngrok` (Khuyên dùng: Ổn định cao, tốc độ nhanh, không bị chặn)

1. Cài đặt ngrok nhanh qua PowerShell: `winget install ngrok` (hoặc tải tại [ngrok.com](https://ngrok.com/)).
2. Chạy lệnh:
   ```powershell
   ngrok http 8000
   ```
3. Copy đường link dạng `https://xxxx.ngrok-free.app` gửi cho thiết bị ở xa truy cập trực tiếp.

---

### Cách 2: Thiết bị trong cùng mạng Wi-Fi (Mạng nội bộ LAN)

Dành cho điện thoại hoặc laptop khác kết nối chung một mạng Wi-Fi với máy tính của bạn:

1. **Lấy địa chỉ IP máy tính:**
   - Mở Terminal (PowerShell / CMD), gõ lệnh:
     ```powershell
     ipconfig
     ```
   - Tìm dòng **IPv4 Address** (Ví dụ: `192.168.1.15`).
2. **Khởi chạy Laravel mở cho toàn mạng:**
   ```powershell
   php artisan serve --host 0.0.0.0 --port 8000
   ```
3. **Mở trên điện thoại / thiết bị khác:**
   - Mở trình duyệt trên điện thoại và truy cập:
     ```text
     http://192.168.1.15:8000
     ```
     *(Thay `192.168.1.15` bằng địa chỉ IP máy tính của bạn tìm được ở Bước 1).*

---

## 👤 Danh Sách Tài Khoản Thử Nghiệm (Demo Accounts)

Mật khẩu mặc định cho toàn bộ tài khoản demo là: **`password`**

| Vai trò / Quyền | Tên hiển thị | Tên tài khoản | Email đăng nhập | Mật khẩu | Chức năng nổi bật có thể test |
|---|---|---|---|---|---|
| 👑 **Admin Quản trị** | Demo User | `@demouser` | `demo@example.com` | `password` | Truy cập **Admin Dashboard** (`/admin`), duyệt báo cáo, khóa/mở khóa tài khoản, xóa bài vi phạm. |
| 🧑 **Người dùng mẫu 1** | Elon Musk | `@elonmusk` | `elon@x.com` | `password` | Đăng tweet, đính kèm media, tương tác Like/Retweet, nhắn tin 1-1. |
| 🧑 **Người dùng mẫu 2** | Taylor Otwell | `@taylorotwell` | `taylor@laravel.com` | `password` | Thử nghiệm follow/unfollow, đăng tweet bình luận. |
| 🧑 **Người dùng mẫu 3** | Evan You | `@youyuxi` | `evan@vuejs.org` | `password` | Trò chuyện trực tiếp (DM) và kiểm tra tính năng riêng tư. |
| 🤖 **MiniX AI Bot** | MiniX AI | `@geminibot` | *Tích hợp sẵn* | *Yêu cầu đăng nhập* | Trò chuyện trực tiếp tại mục **MiniX AI** trên thanh điều hướng (sau khi đăng nhập một tài khoản bất kỳ). |

> [!TIP]
> **Quy chuẩn mật khẩu:** Khi người dùng tự tay đăng ký tài khoản mới (`/register`) hoặc đổi mật khẩu trong phần cài đặt (`/settings/account`), hệ thống áp dụng đầy đủ tiêu chuẩn bảo mật mạnh của Laravel (`Rules\Password::defaults()`).

---

## ⚠️ Các Giới Hạn Hiện Tại Của Hệ Thống (Current Limitations)

Để đảm bảo tính minh bạch học thuật và trung thực khi báo cáo đồ án, nhóm ghi nhận các giới hạn kỹ thuật hiện tại:

1. **Cơ chế cập nhật tin nhắn:** Hệ thống nhắn tin trực tiếp 1-1 hiện sử dụng cơ chế **Polling định kỳ khoảng 2.5 giây** (`resources/js/Pages/Messages/Index.vue:53`) để đồng bộ tin nhắn mới, chưa nâng cấp lên WebSocket toàn thời gian (Laravel Reverb / Pusher).
2. **Phụ thuộc kết nối Internet bên ngoài:** 
   - Trợ lý **MiniX AI** phụ thuộc vào Google Gemini API (cần Internet và khóa `GEMINI_API_KEY` hợp lệ trong `.env`).
   - Gửi email xác thực tài khoản thật phụ thuộc vào Google SMTP. Trong môi trường kiểm thử local hoặc không có mạng, hệ thống đã cung cấp nút **"⚡ Kích hoạt tài khoản ngay"** tại trang `/verify-email`.
3. **Tính năng "Tài khoản riêng tư" (`protect_posts`):** Trạng thái bật/tắt bảo vệ bài viết đã được lưu trữ trong cơ sở dữ liệu (`users.settings` JSON) và hiển thị trên giao diện cài đặt (`/settings/privacy`), tuy nhiên logic backend để ẩn tweet của tài khoản riêng tư đối với người chưa follow đang là tính năng thử nghiệm và tiếp tục được hoàn thiện trong phiên bản kế tiếp.

---

## 📂 Cấu Trúc Thư Mục Dự Án

```text
mini_x/
├── app/
│   ├── Http/Controllers/       # Bộ điều khiển xử lý logic nghiệp vụ (Tweets, Admin, AI, DM, ...)
│   ├── Http/Middleware/        # Middleware phân quyền (Admin, CheckSuspended, Inertia)
│   └── Models/                 # Eloquent Models (User, Tweet, Like, Follow, Message, Report, ...)
├── database/
│   ├── migrations/             # 16 file migration tạo bảng theo trình tự thời gian
│   └── seeders/                # TweetsSeeder & AdminSeeder nạp dữ liệu mẫu
├── resources/
│   ├── js/
│   │   ├── Components/         # Các UI component tái sử dụng (Button, Modal, Dropdown, ...)
│   │   ├── Layouts/            # AuthenticatedLayout, GuestLayout (Dark/Light mode)
│   │   └── Pages/              # Các trang Vue (Welcome/Feed, Profile, Messages, Admin, Bot, ...)
│   └── views/app.blade.php     # Template gốc tích hợp script Dark Mode và Ziggy Routes
├── routes/
│   ├── web.php                 # Toàn bộ routes chức năng của ứng dụng
│   └── auth.php                # Routes xác thực đăng nhập, đăng ký, quên mật khẩu
└── tailwind.config.js          # Cấu hình Tailwind CSS v3 hỗ trợ darkMode: 'class'
```
