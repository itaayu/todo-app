# ✅ Todo List Web App - Laravel 10

Aplikasi manajemen aktivitas harian berbasis web menggunakan Laravel 10. Dengan aplikasi ini, pengguna dapat menambahkan, mengelola, dan melacak tugas, catatan, agenda, serta kategori aktivitas secara efisien dan terorganisir.

---

## 🔧 Fitur Aplikasi

### 📌 Todo List
- Tambah, ubah, hapus, dan lihat daftar tugas
- Tugas memiliki prioritas (`Rendah`, `Sedang`, `Tinggi`)
- Tugas dapat memiliki deadline
- Tugas dikelompokkan berdasarkan status: **Draft**, **Belum Selesai**, **Selesai**, dan **Terlambat**
- Halaman dashboard dengan ringkasan tugas

### 📝 Catatan (Notes)
- CRUD catatan umum
- Tampilan list dan detail catatan

### 📅 Agenda
- CRUD jadwal kegiatan
- Visualisasi kalender agenda bulanan
- Tanggal dengan agenda ditandai warna merah

### 🗂️ Kategori
- CRUD kategori
- Kategori digunakan untuk mengelompokkan Todo dan Catatan

### 🎨 UI/UX
- Desain responsif dan modern menggunakan Tailwind CSS
- Warna prioritas dan status disesuaikan untuk visualisasi yang informatif
- Interaksi tombol dan hover yang interaktif

---

## 📷 Cuplikan Tampilan

> 📌 ![image](https://github.com/user-attachments/assets/7a52e451-ce4a-4104-aef5-bbe1a78e24b3)
> 📌 ![image](https://github.com/user-attachments/assets/35f6b65c-89fc-4e21-867c-4a6e1f71e87b)



---

## 🛠️ Instalasi dan Menjalankan Proyek

### 1. Clone repository

```bash
git clone https://github.com/username/todo-list.git
cd todo-list

**### 2. Install dependency Laravel**
composer install

**### 3. Salin dan konfigurasi .env**
cp .env.example .env
Lalu atur database (MySQL) pada file .env:
DB_DATABASE=todo_list
DB_USERNAME=root
DB_PASSWORD=

**### 4. Generate app key dan migrasi database**
php artisan key:generate
php artisan migrate --seed

**### 5. Jalankan server lokal**
php artisan serve
Buka di browser: http://localhost:8000

🧪 Struktur Folder Utama
├── app/
│   ├── Models/           # Model Eloquent
│   ├── Http/
│   │   ├── Controllers/  # Controller MVC
│   └── ...
├── resources/
│   └── views/            # Blade templates (UI)
├── routes/
│   └── web.php           # Routing web
├── database/
│   ├── migrations/       # Struktur tabel
│   ├── seeders/          # Dummy data awal
│   └── factories/        # Data factory

Kontributor : Ita Ayu Pratiwi
Email       : Itaayu.work@gmail.com
