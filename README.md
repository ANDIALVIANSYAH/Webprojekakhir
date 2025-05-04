Judul : Booking Ruangan Hotel
Nama :ANDIALVIANSYAH.S
Nim  :D0223007
FrameWork Web Based

Web Booking ruangan hotel adalah web booking ruangan yang memungkinkan tiga jenis pengguna : Admin, Receptionist, dan Customer untuk mengelola dan memesan ruangan secara efisien.

•	Admin : Kelola Ruangan (CRUD Ruangan), Kelola User (CRUD User: Receptionist & Customer), dan lihat Semua booking.
•	Receptionist : Lihat booking customer, proses mulai sewa (Check-In), proses selesai sewa (Check-Out).
•	Customer : Lihat ruangan yang tersedia, booking ruangan, melihat riwayat booking.

Fitur Utama
•	Autentikasi Pengguna : Pengguna dapat mendaftar (oleh admin), login, dan mengakses fitur sesuai dengan peran mereka: Admin, Receptionist, atau Customer.
•	Pengelolaan Ruangan : Admin dapat menambahkan, mengedit, dan menghapus data ruangan. Setiap ruangan memiliki atribut seperti nama, kapasitas, harga, dan status (tersedia/dibooking).
•	Pemesanan Ruangan : Customer dapat melihat ruangan yang tersedia dan melakukan booking dengan memilih tanggal dan waktu sewa.
•	Proses penyewaan : Receptionist dapat melihat daftar booking yang masuk, serta memproses Check-In saat sewa dimulai dan Check-Out saat selesai.
•	Management pengguna : Admin dapat mengelola data pengguna (Receptionist dan Customer), termasuk menambahkan, mengedit, dan menghapus akun.
•	Role Management : Admin,Receptionist,Customer memiliki hak akses yang berbeda sesuai dengan peran mereka.
•	Pengelolaan pembayran : Customer dapat melakukan pembayaran setelah booking ruangan. Receptionist memverifikasi pembayaran dan mengubah statusnya. Admin dan Receptionist dapat melihat riwayat pembayaran, serta mengelola data jika ada kesalahan.

1.	Tabel Users
<h3>1. Tabel Users</h3>
<table border="1" cellpadding="5" cellspacing="0">
  <thead>
    <tr>
      <th>Field</th>
      <th>Tipe Data</th>
      <th>Deskripsi</th>
    </tr>
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



2.	Tabel Rooms
<h3>2. Tabel Rooms</h3>
<table border="1" cellpadding="5" cellspacing="0">
  <thead>
    <tr>
      <th>Field</th>
      <th>Tipe Data</th>
      <th>Deskripsi</th>
    </tr>
  </thead>
  <tbody>
    <tr><td>id</td><td>INT (auto increment, primary key)</td><td>ID unik untuk setiap ruangan</td></tr>
    <tr><td>room_name</td><td>VARCHAR(255)</td><td>Nama ruangan (misal: "Ruang Meeting A")</td></tr>
    <tr><td>capacity</td><td>INT</td><td>Kapasitas ruangan (jumlah orang)</td></tr>
    <tr><td>price</td><td>DECIMAL(10, 2)</td><td>Harga sewa per jam atau per hari</td></tr>
    <tr><td>status</td><td>ENUM('Available', 'Booked')</td><td>Status ruangan</td></tr>
    <tr><td>created_at</td><td>TIMESTAMP</td><td>Waktu pembuatan ruangan</td></tr>
    <tr><td>updated_at</td><td>TIMESTAMP</td><td>Waktu terakhir kali ruangan diperbarui</td></tr>
  </tbody>
</table>


3.	Tabel Bookings
<h3>3. Tabel Bookings</h3>
<table border="1" cellpadding="5" cellspacing="0">
  <thead>
    <tr>
      <th>Field</th>
      <th>Tipe Data</th>
      <th>Deskripsi</th>
    </tr>
  </thead>
  <tbody>
    <tr><td>id</td><td>INT (auto increment, primary key)</td><td>ID unik untuk setiap booking</td></tr>
    <tr><td>user_id</td><td>INT (foreign key)</td><td>ID pengguna (relasi ke tabel users)</td></tr>
    <tr><td>room_id</td><td>INT (foreign key)</td><td>ID ruangan (relasi ke tabel rooms)</td></tr>
    <tr><td>start_time</td><td>DATETIME</td><td>Waktu mulai sewa ruangan</td></tr>
    <tr><td>end_time</td><td>DATETIME</td><td>Waktu selesai sewa ruangan</td></tr>
    <tr><td>status</td><td>ENUM('Booked', 'Checked-in', 'Checked-out', 'Cancelled')</td><td>Status booking</td></tr>
    <tr><td>created_at</td><td>TIMESTAMP</td><td>Waktu pembuatan booking</td></tr>
    <tr><td>updated_at</td><td>TIMESTAMP</td><td>Waktu terakhir booking diperbarui</td></tr>
  </tbody>
</table>

4. Tabel Payments
<h3>4. Tabel Payments</h3>
<table border="1" cellpadding="5" cellspacing="0">
  <thead>
    <tr>
      <th>Field</th>
      <th>Tipe Data</th>
      <th>Deskripsi</th>
    </tr>
  </thead>
  <tbody>
    <tr><td>id</td><td>INT (auto increment, primary key)</td><td>ID unik untuk setiap pembayaran</td></tr>
    <tr><td>booking_id</td><td>INT (foreign key)</td><td>ID booking yang terkait (relasi ke tabel bookings_007)</td></tr>
    <tr><td>amount_paid</td><td>DECIMAL(10,2)</td><td>Jumlah uang yang dibayarkan</td></tr>
    <tr><td>payment_method</td><td>ENUM('Credit Card', 'Bank Transfer', 'Cash', 'Online Payment')</td><td>Metode pembayaran yang digunakan</td></tr>
    <tr><td>payment_status</td><td>ENUM('Pending', 'Completed', 'Failed', 'Refunded')</td><td>Status pembayaran</td></tr>
    <tr><td>payment_date</td><td>DATETIME</td><td>Tanggal dan waktu pembayaran dilakukan</td></tr>
    <tr><td>transaction_reference</td><td>VARCHAR (nullable)</td><td>Referensi transaksi (opsional)</td></tr>
    <tr><td>created_at</td><td>TIMESTAMP</td><td>Waktu pembuatan data pembayaran</td></tr>
    <tr><td>updated_at</td><td>TIMESTAMP</td><td>Waktu terakhir kali data diperbarui</td></tr>
  </tbody>
</table>


Jenis Relasi dan Tabel yang Berelasi
1. users_007 ↔ bookings_007
   Relasi: One-to-Many
   Penjelasan:Satu user (Customer) bisa memiliki banyak booking.Field user_id pada tabel bookings_007 adalah foreign key yang mereferensikan id di users_007
2. rooms_007 ↔ bookings_007
   Relasi: One-to-Many
   Penjelasan:satu ruangan bisa dibooking berkali-kali oleh user yang berbeda.Field room_id pada bookings_007 adalah foreign key dari rooms_007.
3. bookings_007 ↔ payments_007
   Relasi: One-to-One
   Penjelasan:Satu booking bisa memiliki satu atau lebih record pembayaran.Field booking_id di payments_007 adalah foreign key yang mereferensikan id di bookings_007.




## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
