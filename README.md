# Docker PHP
* nginx
* php 8.0.24
* mariadb 10.5.9
* adminer

# How to use
1. Clone this repository
2. Build images using this command
> $ docker compose build
3. Run images using this command
> $ docker compose up -d
4. Go to app container shell using this command
> $ docker exec -it app bash
5. Inside the container install laravel using this command, this will create project folder in root folder
> $ composer create-project --prefer-dist laravel/laravel:^8.0 project
6. Next, move the content of the project folder, to our root directory using this command
> $ mv ./project/* ./
> $ mv ./project.* ./
select no
7. Last, remove project folder using this command 
> $ rm -rf project/
8. exit the container, using this command
> $ exit
9. shutdown all the container
> $ docker compose down
10. start up again the container
> $ docker compose up -d

# Additional step
## laravel breeze installation
1. add this command container
> composer require laravel/breeze --dev
or
> composer require laravel/breeze:* --dev
> composer require laravel/breeze:1.9.4
2. exit from container
3. execute this command
> npm install && npm run dev
4. back to container shell, create this command.
> php artisan migrate



