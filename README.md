
# Installation guide
This is API server based on Laravel 9, Mysql 8.0 and Nginx. This application is dockerized so make sure to install Docker.

### You need to run following Commands to run this project:
Firstly go into the root folder.
- run command "docker compose build"
- run command "docker compose up -d"
- run command "docker compose exec composer composer install"
- run command "docker compose exec php php artisan migrate"
- run command "docker compose exec php php artisan optimize"

### Notice: Application will run on port 80 


