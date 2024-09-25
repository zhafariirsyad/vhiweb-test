# vhiweb-test

# Step Menjalankan Website

### 1. Duplikat File `.env`
- Duplikat file `.env.example` dan rename menjadi `.env`.
- File `.env.example` sudah disesuaikan konfigurasinya
### 2. Build Docker
- Jalankan perintah berikut di dalam folder `vhiweb-test` untuk build Docker:
  ```bash
  docker-compose build
  docker-compose up -d
### 3. Migration dan Seeder
- Jalankan migration untuk menambahkan table kedalam database:
  ``` bash
  docker exec -it php php artisan migrate
- Jalankan seeder untuk menambahkan data dummy kedalam database
  ```bash
  docker exec -it php php artisan db:seed
### 4. Running Website
- Jalankan website menggunakan `[http:localhost:85](http://localhost:85)`