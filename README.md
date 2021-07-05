# roadsurfer-case

#### Required Environment
xampp, mysql , shymphony 5 , php 7.4, composer 1.0

### RUN WITHOUT DOCKER

1. git clone 'https://github.com/XabirHK/roadsurfer-case'
2. composer install
3. php bin/console doctrine:migrations:migrate
4. php bin/console server:run

### Import initial data
you will find the sql in /database directory

please use database connection in your .env like the follwing

DATABASE_URL="mysql://user:pass@127.0.0.1:3306/roadsurfer?serverVersion=mariadb-10.4.11"

### RUN DOCKER
My system is windows and for docker I have to use windows builtin linux WSL
which is bit problematic at the moment

I will try to update docker when it is fixed

## API for each Station
http://localhost:8000/api/v1/station/{station_id}
## Link for HTML dashboard 
http://localhost:8000/station/dashboard


#### N.B. also need to write some unit test after i fix the docker
