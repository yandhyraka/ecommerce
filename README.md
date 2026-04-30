Saya menggunakan migration, jadi tidak menambahkan file database sql.

Urutan menjalankan code:

composer install

php spark migrate

php spark db:seed DatabaseSeeder

php spark serve

file env rename ke .env