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

# Application Feature
## Booking appointment app


# Completed To Do
* create user.
* install spatie/laravel-permission (rbac).
* create schedule Model and table
* seed user, doctor, patient, admin. 
* seed permission and roles
* assign role to user as doctor, patient and admin
* seed schedule table with data
* create doctor api
* create doctor list page
* create doctor item component
* create doctor details
* create doctor detail page/component
* create doctor time slot item
* validate requested date, show warning less than today date (done in calendar side)
* handle axios request error on doctor list page (when id not found show 404 message)
* handle axios timeslot request error on doctor show page
* validate requested date, show warning less than today date (laravel request validate)
* add id to timeslot 
* when submit booking validate booking request, prevent double booking on the same doctor
* install moment js
* add moment js to global vue attributes
* handle 404 error / other error
* install vuex
* axios post request save
* update schedule request query by filtering booked timeslot
* add more data to schedule seeder
* add search bar
* update api request including keyword from search bar
* add last search to global state vuex
* add more random result in seeder
* change emmit parameter
* add status field to schedule to reduce query load

# Not Completed To Do
* fixed isLoading, isError order on vue page
* add 404 page when url not found
* add polymorphic one relation to user
* add login 
* add register
* only login patient can book an appointment 