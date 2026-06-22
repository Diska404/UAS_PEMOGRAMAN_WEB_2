# Backend API E-Inventory

Backend ini dibuat menggunakan CodeIgniter 4 dan berjalan sebagai RESTful API server untuk aplikasi E-Inventory.

## Menjalankan Backend

```bash
copy .env.example .env
php spark serve
```

Backend berjalan pada:

```text
http://localhost:8080
```

## Database

Import file berikut melalui phpMyAdmin:

```text
../database/uas_web_2.sql
```

## Akun Admin

```text
Email    : admin@inventory.test
Password : admin123
```

## Proteksi Endpoint

Endpoint manipulasi data seperti POST, PUT, PATCH, dan DELETE hanya dapat diakses menggunakan Authorization Bearer Token.
