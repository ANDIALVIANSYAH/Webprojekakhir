<div align="center">
    <h2 style="margin:0; font-size:3em; color:#333;">BOOKING RUANGAN HOTEL</h2>
    <img src="/public/logo unsulbar.jpeg" alt="Logo Unsulbar" style="display:block; margin:1em auto; max-width:80%; height:auto;" />
    <h2 style="margin:0; font-size:2em; color:#333;">ANDIALVIANSYAH.S</h2>
    <h2 style="margin:0; font-size:2em; color:#333;">D0223007</h2>
    <h2 style="margin:0; font-size:2em; color:#333;">FRAMEWORK WEB BASED</h2>
    <h2 style="margin-top:0.5em; font-size:2em; color:#333;">2025</h2>
  </div>

  <h2>Deskripsi</h2>
  <p>
    Web Booking ruangan hotel adalah aplikasi berbasis web yang memungkinkan tiga jenis pengguna — <strong>Admin</strong>, <strong>Receptionist</strong>, dan <strong>Customer</strong> — untuk mengelola dan memesan ruangan secara efisien.
  </p>

  <h2>Hak Akses Berdasarkan Peran</h2>
  <ul>
    <li><strong>Admin:</strong> CRUD Ruangan, CRUD User (Receptionist & Customer), Lihat Semua Booking dan Pembayaran.</li>
    <li><strong>Receptionist:</strong> Lihat Booking Customer, Proses Check-In, Proses Check-Out, Verifikasi Pembayaran.</li>
    <li><strong>Customer:</strong> Lihat Ruangan Tersedia, Booking Ruangan, Melihat Riwayat Booking dan Pembayaran.</li>
  </ul>

  <h2>Fitur Utama</h2>
  <ul>
    <li><strong>Autentikasi Pengguna:</strong> Login berdasarkan peran (Admin, Receptionist, Customer).</li>
    <li><strong>Pengelolaan Ruangan:</strong> Admin dapat mengelola ruangan (tambah, edit, hapus).</li>
    <li><strong>Pemesanan Ruangan:</strong> Customer dapat booking ruangan dengan memilih waktu dan tanggal.</li>
    <li><strong>Proses Penyewaan:</strong> Receptionist mengelola check-in dan check-out.</li>
    <li><strong>Manajemen Pengguna:</strong> Admin dapat mengelola akun Receptionist dan Customer.</li>
    <li><strong>Role Management:</strong> Akses fitur berdasarkan peran pengguna.</li>
    <li><strong>Pengelolaan Pembayaran:</strong> Customer bayar, receptionist verifikasi, admin & receptionist bisa melihat riwayatnya.</li>
  </ul>

  <h2>Relasi Antar Tabel</h2>
  <ol>
    <li><strong>users_007 ↔ bookings_007 (One-to-Many):</strong> Satu user bisa melakukan banyak booking.</li>
    <li><strong>rooms_007 ↔ bookings_007 (One-to-Many):</strong> Satu ruangan bisa dibooking banyak kali oleh user yang berbeda.</li>
    <li><strong>bookings_007 ↔ payments_007 (One-to-One):</strong> Satu booking memiliki satu data pembayaran.</li>
  </ol>

  <h2>Tabel Users</h2>
  <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr><th>Field</th><th>Tipe Data</th><th>Deskripsi</th></tr>
    </thead>
    <tbody>
      <tr><td>id</td><td>INT (auto increment, primary key)</td><td>ID unik untuk setiap pengguna</td></tr>
      <tr><td>name</td><td>VARCHAR(255)</td><td>Nama pengguna</td></tr>
      <tr><td>email</td><td>VARCHAR(255)</td><td>Email pengguna (unik)</td></tr>
      <tr><td>password</td><td>VARCHAR(255)</td><td>Password pengguna</td></tr>
      <tr><td>role</td><td>ENUM('Admin', 'Receptionist', 'Customer')</td><td>Peran pengguna dalam sistem</td></tr>
      <tr><td>created_at</td><td>TIMESTAMP</td><td>Waktu pembuatan akun</td></tr>
      <tr><td>updated_at</td><td>TIMESTAMP</td><td>Waktu terakhir kali akun diperbarui</td></tr>
    </tbody>
  </table>

  <h2>Tabel Rooms</h2>
  <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr><th>Field</th><th>Tipe Data</th><th>Deskripsi</th></tr>
    </thead>
    <tbody>
      <tr><td>id</td><td>INT (auto increment, primary key)</td><td>ID unik untuk setiap ruangan</td></tr>
      <tr><td>room_name</td><td>VARCHAR(255)</td><td>Nama ruangan (misal: "Ruang Meeting A")</td></tr>
      <tr><td>capacity</td><td>INT</td><td>Kapasitas ruangan</td></tr>
      <tr><td>price</td><td>DECIMAL(10,2)</td><td>Harga sewa</td></tr>
      <tr><td>status</td><td>ENUM('Available', 'Booked')</td><td>Status ruangan</td></tr>
      <tr><td>created_at</td><td>TIMESTAMP</td><td>Waktu pembuatan</td></tr>
      <tr><td>updated_at</td><td>TIMESTAMP</td><td>Waktu terakhir diperbarui</td></tr>
    </tbody>
  </table>

  <h2>Tabel Bookings</h2>
  <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr><th>Field</th><th>Tipe Data</th><th>Deskripsi</th></tr>
    </thead>
    <tbody>
      <tr><td>id</td><td>INT (auto increment, primary key)</td><td>ID unik untuk setiap booking</td></tr>
      <tr><td>user_id</td><td>INT (foreign key)</td><td>Relasi ke tabel users</td></tr>
      <tr><td>room_id</td><td>INT (foreign key)</td><td>Relasi ke tabel rooms</td></tr>
      <tr><td>start_time</td><td>DATETIME</td><td>Waktu mulai sewa</td></tr>
      <tr><td>end_time</td><td>DATETIME</td><td>Waktu selesai sewa</td></tr>
      <tr><td>status</td><td>ENUM('Booked', 'Checked-in', 'Checked-out', 'Cancelled')</td><td>Status booking</td></tr>
      <tr><td>created_at</td><td>TIMESTAMP</td><td>Waktu dibuat</td></tr>
      <tr><td>updated_at</td><td>TIMESTAMP</td><td>Waktu diperbarui</td></tr>
    </tbody>
  </table>

  <h2>Tabel Payments</h2>
  <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr><th>Field</th><th>Tipe Data</th><th>Deskripsi</th></tr>
    </thead>
    <tbody>
      <tr><td>id</td><td>INT (auto increment, primary key)</td><td>ID unik untuk pembayaran</td></tr>
      <tr><td>booking_id</td><td>INT (foreign key)</td><td>Relasi ke tabel bookings</td></tr>
      <tr><td>amount_paid</td><td>DECIMAL(10,2)</td><td>Jumlah dibayarkan</td></tr>
      <tr><td>payment_method</td><td>ENUM('Credit Card', 'Bank Transfer', 'Cash', 'Online Payment')</td><td>Metode pembayaran</td></tr>
      <tr><td>payment_status</td><td>ENUM('Pending', 'Completed', 'Failed', 'Refunded')</td><td>Status pembayaran</td></tr>
      <tr><td>payment_date</td><td>DATETIME</td><td>Tanggal pembayaran</td></tr>
      <tr><td>transaction_reference</td><td>VARCHAR (nullable)</td><td>Referensi transaksi (opsional)</td></tr>
      <tr><td>created_at</td><td>TIMESTAMP</td><td>Waktu dibuat</td></tr>
      <tr><td>updated_at</td><td>TIMESTAMP</td><td>Waktu diperbarui</td></tr>
    </tbody>
  </table>

  <h2>Lisensi</h2>
  <p>Framework Laravel adalah perangkat lunak open-source yang dilisensikan di bawah <a href="https://opensource.org/licenses/MIT" target="_blank">MIT License</a>.</p>

</body>
</html>


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
