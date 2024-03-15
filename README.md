## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)


### Clone the repository

    git clone https://github.com/hayknazaryann/events-logging.git

### Switch to the repo folder

    cd events-logging



### Install all the dependencies using composer

    composer install

### Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

### Generate a new application key

    php artisan key:generate

### Run the migrations

    php artisan key:generate

### Start the local development server

    php artisan serve


### Register Request

`POST http://127.0.0.1:8000/api/register`


### Login Request

`POST http://127.0.0.1:8000/api/login`

### Event Create Request

`POST http://127.0.0.1:8000/api/events/create`

### Events count by interval and type

`GET http://127.0.0.1:8000/api/events/count-by-type?start_date=&end_date=`
