# Sportlink
## Anggota Kelompok
IBAR HUTTAQI SULTHON		215150201111042  
ZHAFRAN RAMA AZMI			215150207111025  
ALFRED JOSAFAT ELYAZAR		215150207111046  
MUHAMMAD FARISY CHANIAGO	215150200111038  
AZKA RAVINDRA RAHMAN		215150201111031  
## Run Locally

Clone the project

```bash
  git clone https://github.com/RushingAlien/proyek-akhir-rpl.git
```

Go to the project directory

```bash
  cd proyek-akhir-rpl
```

-   Copy .env.example file to .env and edit database credentials there

```bash
    composer install
```

```bash
    php artisan key:generate
```

```bash
    php artisan migrate:fresh --seed
```

#### Login

-   email = admin@example.com
-   password = 123
