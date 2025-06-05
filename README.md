<!-- Improved compatibility of back to top link -->
<a id="readme-top"></a>

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="#">
    <img src="images/logo.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">🍽️ Restaurant Modern App</h3>

  <p align="center">
    Aplikasi restoran modern dengan QR Code ordering dan pembayaran digital Midtrans
    <br />
    <br />
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#screenshots">Screenshots</a></li>
    <li><a href="#features">Features</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->
## About The Project

![Menu](https://i.ibb.co/fdBGjQ7n/Screenshot-2025-06-03-143129.png)
![Cart](https://i.ibb.co/4RhNZ2my/Screenshot-2025-06-03-143208.png)
![Payment Gateway Midtrans](https://i.ibb.co/fVxGY7jw/Screenshot-2025-06-03-143347.png)


Restaurant Modern App adalah solusi komprehensif untuk restoran yang ingin memberikan pengalaman dining modern kepada pelanggan mereka. Aplikasi ini memungkinkan pelanggan untuk memesan makanan melalui QR Code dan melakukan pembayaran digital via Midtrans QRIS atau cash langsung ke kasir.

Mengapa Restaurant Modern App?
* **Customer Experience**: Pelanggan dapat memesan dengan mudah tanpa antri, cukup scan QR code di meja
* **Flexible Payment**: Mendukung pembayaran digital QRIS dan cash untuk kemudahan semua kalangan
* **Operational Efficiency**: Dashboard terintegrasi untuk admin, kasir, dan chef meningkatkan efisiensi operasional
* **Real-time Management**: Monitor pesanan dan pembayaran secara real-time

Aplikasi ini dikembangkan khusus untuk kebutuhan restoran modern dengan fokus pada user experience dan operational efficiency.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

Aplikasi ini dibangun menggunakan teknologi modern dan reliable untuk memastikan performa optimal:

* [![Laravel][Laravel.com]][Laravel-url]
* [![Bootstrap][Bootstrap.com]][Bootstrap-url]
* [![JQuery][JQuery.com]][JQuery-url]
* [![MySQL][MySQL.com]][MySQL-url]
* [![Midtrans][Midtrans.com]][Midtrans-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->
## Getting Started

Ikuti langkah-langkah berikut untuk menjalankan aplikasi secara lokal.

### Prerequisites

Pastikan sistem Anda memiliki requirement berikut:
* PHP 8.1+
  ```sh
  php --version
  ```
* Composer
  ```sh
  composer --version
  ```
* Node.js & NPM
  ```sh
  npm --version
  ```
* MySQL/MariaDB

### Installation

Ikuti langkah instalasi berikut:

1. Clone repository
   ```sh
   git clone https://github.com/adityafakhrii/restaurant-modern-app.git
   ```
2. Masuk ke direktori project
   ```sh
   cd restaurant-modern-app
   ```
3. Install PHP dependencies
   ```sh
   composer install
   ```
4. Install NPM packages
   ```sh
   npm install
   ```
5. Copy environment file
   ```sh
   cp .env.example .env
   ```
6. Generate application key
   ```sh
   php artisan key:generate
   ```
7. Setup database di `.env`
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=restaurant_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```
8. Setup Midtrans di `.env`
   ```env
   MIDTRANS_SERVER_KEY=your_server_key
   MIDTRANS_CLIENT_KEY=your_client_key
   MIDTRANS_IS_PRODUCTION=false
   ```
9. Run migration dan seeding
   ```sh
   php artisan migrate --seed
   ```
10. Build assets
    ```sh
    npm run build
    ```
11. Start development server
    ```sh
    php artisan serve
    ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- USAGE EXAMPLES -->
## Usage

### Default Login Credentials

Setelah seeding berhasil, gunakan credentials berikut untuk login:

**Admin Dashboard:**
- Email: `admin@restaurant.com`
- Password: `password`

**Kasir POS:**
- Email: `cashier@restaurant.com`
- Password: `password`

**Chef Kitchen:**
- Email: `chef@restaurant.com`
- Password: `password`

### Customer Flow
1. Pelanggan scan QR code di meja restoran
2. Browse menu dan pilih makanan/minuman
3. Tambahkan ke keranjang dan checkout
4. Pilih metode pembayaran (QRIS atau Cash)
5. Untuk QRIS: scan dan bayar melalui aplikasi bank/e-wallet
6. Untuk Cash: tunjukkan order ke kasir untuk pembayaran
7. Monitor status pesanan secara real-time

_Untuk dokumentasi lengkap, silakan kunjungi [Kelas Fullstack](https://kelasfullstack.com)_

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- SCREENSHOTS -->
## Screenshots

### Customer Interface
- `screenshots/customer-qr-scan.png` - QR Code scanning interface
- `screenshots/customer-menu.png` - Menu browsing interface  
- `screenshots/customer-cart.png` - Shopping cart
- `screenshots/customer-payment.png` - Payment selection
- `screenshots/customer-order-status.png` - Order tracking

### Admin Dashboard
- `screenshots/admin-dashboard.png` - Main admin dashboard
- `screenshots/admin-menu-management.png` - Menu management
- `screenshots/admin-orders.png` - Order management
- `screenshots/admin-reports.png` - Sales reports

### Staff Interface  
- `screenshots/cashier-pos.png` - Cashier POS system
- `screenshots/chef-orders.png` - Chef order queue

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- FEATURES -->
## Features

### 🔍 Customer Experience
- [x] **QR Code Ordering** - Scan QR code di meja untuk akses menu instant
- [x] **Digital Payment** - Pembayaran via Midtrans QRIS
- [x] **Cash Payment** - Opsi pembayaran tunai langsung ke kasir
- [x] **Real-time Order Tracking** - Monitor status pesanan secara real-time
- [x] **Responsive Design** - Optimal di semua perangkat mobile dan desktop

### 👨‍💼 Admin Dashboard
- [x] **Menu Management** - Kelola menu, harga, dan kategori makanan
- [x] **Order Management** - Monitor dan kelola semua pesanan masuk
- [x] **User Management** - Manajemen staff dan role permissions
- [x] **Sales Analytics** - Laporan penjualan dan analytics mendalam
- [x] **Table Management** - Kelola meja dan QR code generator

### 👨‍🍳 Kitchen & Cashier
- [x] **Kitchen Display** - Antrian pesanan untuk chef dengan status update
- [x] **POS System** - Sistem kasir terintegrasi untuk pembayaran cash
- [x] **Order Status Update** - Update status pesanan real-time
- [x] **Receipt Printing** - Generate dan print receipt otomatis

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ROADMAP -->
## Roadmap

### 🔔 Real-time Notifications
- [ ] **Laravel Pusher Integration** - Notifikasi real-time saat makanan siap
- [ ] **Sound Notifications** - Alert suara untuk staff dan customer
- [ ] **Push Notifications** - Mobile push notifications

### 🎁 Loyalty & Rewards System
- [ ] **Queue-based Loyalty System** - Sistem poin pelanggan dengan queue processing
- [ ] **Birthday Vouchers** - Voucher otomatis di hari ulang tahun
- [ ] **Advanced Admin Login** - Multi-factor authentication untuk admin

### ⚙️ Advanced Development Features
- [ ] **Custom Artisan Commands** - Command khusus untuk operasional harian
- [ ] **Coupon & Discount System** - Sistem kupon dan diskon fleksibel
- [ ] **Advanced Promo Engine** - Engine promosi dengan berbagai kondisi

### 🧪 Testing & Quality Assurance
- [ ] **Comprehensive Testing** - Unit dan integration testing dengan coverage tinggi
- [ ] **PEST Laravel Testing** - Modern testing framework untuk Laravel
- [ ] **Selenium UI Testing** - Automated browser testing untuk UI
- [ ] **Performance Testing** - Load testing untuk sistem pembayaran

### 🗺️ Location & Delivery Features
- [ ] **Google Maps Integration** - Tracking posisi real-time untuk delivery
- [ ] **Driver Tracking System** - Sistem seperti Domino's Pizza untuk tracking driver
- [ ] **Geofencing** - Notifikasi otomatis berdasarkan lokasi
- [ ] **Delivery Zone Management** - Manajemen area pengiriman

### ☁️ Cloud & Storage
- [ ] **Cloudinary Integration** - Upload dan optimasi gambar menu
- [ ] **AWS S3 Alternative** - Storage alternatif untuk media files
- [ ] **CDN Integration** - Content delivery network untuk performa optimal

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- LICENSE -->
## License

This project is proprietary software developed for educational purposes at Kelas Fullstack. All rights reserved.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTACT -->
## Contact

**Aditya Fakhri** - [@adityafakhrii](https://twitter.com/adityafakhrii) - adityafakhri@kelasfullstack.com

Project Link: [Restaurant Modern App](https://github.com/adityafakhrii/restaurant-modern-app)

**Social Media:**
- Instagram: [@adityafakhrii](https://instagram.com/adityafakhrii)
- GitHub: [@adityafakhrii](https://github.com/adityafakhrii)
- LinkedIn: [@adityafakhrii](https://linkedin.com/in/adityafakhrii)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ACKNOWLEDGMENTS -->
## Acknowledgments

Resources dan tools yang membantu dalam pengembangan aplikasi ini:

* [Laravel Documentation](https://laravel.com/docs)
* [Bootstrap](https://getbootstrap.com)
* [Midtrans Payment Gateway](https://midtrans.com)
* [Font Awesome](https://fontawesome.com)
* [jQuery](https://jquery.com)
* [QR Code Generator](https://github.com/endroid/qr-code)
* [Kelas Fullstack](https://kelasfullstack.com)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
[issues-shield]: https://img.shields.io/github/issues/adityafakhrii/restaurant-modern-app.svg?style=for-the-badge
[issues-url]: https://github.com/adityafakhrii/restaurant-modern-app/issues
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/adityafakhrii
[product-screenshot]: screenshots/main-dashboard.png
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[JQuery.com]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[JQuery-url]: https://jquery.com
[MySQL.com]: https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white
[MySQL-url]: https://mysql.com
[Midtrans.com]: https://img.shields.io/badge/Midtrans-00D4AA?style=for-the-badge&logo=midtrans&logoColor=white
[Midtrans-url]: https://midtrans.com
