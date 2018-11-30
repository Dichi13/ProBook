# Tugas 2 IF3110 Pengembangan Aplikasi Berbasis Web 


## Anggota Tim

- 13516033 - Abner Adhiwijna
- 13516063 - Rizky Andyno Ramadhan
- 13516075 - David Timothy Panjaitan

## Penjelasan
### Basis Data
Pada skema basis data di bawah, teks **bercetak tebal** adalah primary key, dan teks *bergaris miring* adalah foreign key.

- Aplikasi Pro-Book
  - User(**userid**, username, password, nama, email, alamat, phone, nomorkartu, avatar)<br>
  Tabel ini menyimpan data pengguna.
  
  - Purchase(**purchaseid**, *userid*, bookid, review, rating, jumlah, tanggal)<br>
  Tabel ini menyimpan riwayat pembelian pengguna beserta review dan ratingnya.

  - Token(**userid**, tokenstring, ipaddress, expire)<br>
  Tabel ini menyimpan access token pengguna.

- Webservice Bank
  - Account(**cardnumber**, name, balance)<br>
  Tabel ini menyimpan daftar akun yang ada di webservice bank.

  - Transaction(sender, receiver, amount, date)<br>
  Tabel ini menyimpan hasil transaksi antar dua pengguna akun yang melakukan transfer.

- Webservice Buku
  - Purchased(**purchaseid**, bookid, category, total)<br>
  Tabel ini menyimpan riwayat pembelian buku.

  - BookPrice(**bookid**, price)<br>
  Tabel ini berisi harga dari beberapa buku yang terdaftar di Google Book API.


### Shared Session

Pada protokol REST, state tidak disimpan sehingga seluruh komunikasi bersifat *stateless*.

### Token

Pembangkitan *token* dilakukan dengan membuat string random  ketika pengguna melakukan login atau registrasi. Token tersebut disimpan di dua tempat, yaitu di basis data Pro-Book dan *cookie* dari *browser* pengguna. Di basis data, tersimpan nomor id pengguna, *string token*, IP address tempat pengguna mengakses aplikasi, dan waktu kedaluwarsa *token*. Pada cookie hanya tersimpan data berupa *string token*.

Cara kerjanya adalah aplikasi akan mengecek kondisi berikut setiap kali pengguna memasuki suatu laman di aplikasi Pro-Book:
- *Cookie* yang berisi *token* terdapat di browser tempat pengguna mengakses aplikasi
- *String token* berada di basis data
- Entri *string token* memiliki waktu yang lebih kecil dari waktu kedaluwarsa *token* dan memiliki IP Address yang sama

Apabila salah satu kondisi di atas tidak terpenuhi, maka pengguna akan diarahkan (*redirect*) ke laman login. Khusus ketika pengguna *logout* atau token sudah kedaluwarsa, maka *cookie* dan entri yang bersangkutan akan dihapus.

### Kelebihan dan Kelemahan

Berikut adalah kelebihan dan kekurangan dari arsitektur yang diterapkan aplikasi ini dibandingkan dengan aplikasi monolitik:

#### Kelebihan
- Aplikasi menjadi lebih ringkas karena sebagian besar beban ditangani oleh *webservice*.
- Lebih mudah untuk dirawat.
- Server tersebar ke berbagai tempat sehingga tidak terkonsentrasi di satu server.

#### Kekurangan
- Aplikasi harus menerapkan protokol yang sesuai dengan protokol dari *webservice* sehingga menambah kompleksitas aplikasi.
- Menambah depedensi sehingga apabila salah satu *webservice* sedang *down*, maka aplikasi ini tidak dapat berjalan sebagaimana mustinya.


## Pembagian Tugas

REST :
1. Validasi nomor kartu : 13516063
2. Service Transfer : 13516033
3. Fetch Data Menggunakan Google Books API : 13516075

SOAP :
1. Implementasi JAX-WS : 13516063
2. Implementasi layanan webservice buku : 13516075
3. Implementasi Client Soap pada Aplikasi Pro-Book
   - Browse : 13516033, 13516063, 13516075
   - Detail : 13516033, 13516075
   - History : 13516033
   - Review : 13516063


Perubahan Pro-Book :
1. Penambahan Field Kartu di Login dan Register : 13516033
2. Implementasi Access Token Login : 13516063
3. Implementasi AJAX untuk Validasi : 13516063
4. Pengubahan Database : 13516033, 13516063, 13516075
5. Pembelian Buku : 13516075
6. Detail Buku + Rekomendasi : 13516033
7. AngularJS : 13516033, 13516075