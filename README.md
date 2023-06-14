# News aggregator Backend App - Laravel
This project is for backend apis with Laravel for New aggregator app.

## Prerequisites

### Before you start, make sure you have the following tools installed:

-   Docker Engine 22.0.0 or later

-   Docker Compose 2.0.0 or later

## Getting Started

1. Clone this repository to your local machine:

```
git clone https://github.com/johnfumio/innoscripta_backend.git
```

2. Go to the project directory:

```
cd innoscripta_backend
```

3. Build and start the Docker containers:

```
docker-compose up
```

This command will start the following Docker containers:<br>

`backend`: the Laravel application server running on port 8000<br>

`mariadb`: the MySQL database server running on port 3306<br>

5. Migrate the database:

-   Run the following command to connect to the laravel-app container:

```
docker-compose exec backend sh
```

Then, run the following command to migrate the database:

```
php artisan migrate
```

6. To update news automatically in every hour, execute below command (`it may not work in local machine!`)

```
php artisan add-news
```

## Stopping the Containers

To stop the Docker containers, press `Ctrl+C` in the terminal window where you started the containers. Alternatively, you can run the following command in the project directory:

```
docker-compose down
```

## Running without Docker

Before running without Docker kindly make sure that Composer is installed and your MySQL database server is running on `PORT 3306`

1. Clone this repository to your local machine:

```
git clone https://github.com/johnfumio/innoscripta_backend.git

cd innoscripta/backend
```

2. Run the Laravel project by below commands

```
composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan add-news

php artisan serve
```

The The Laravel backend project will be run on `PORT 8000`


# Development work flow
This Application is for the backend side of news aggregator.
1. DB - MariaDB
    I created three tables - Users, Settings, Articles

    Users - storing user info - Id, Name, Email, Created Date

    Settings - storing user's preference info - Type, Name
        (ex: I like `author` called `Will Millar` => Type = `author` Name = `Will Millar` )

    Articles - storing the news info - Id, Source Name, Source, Author, Title, Category, Description, URL, Image, Created Date

2. Laravel
    - Auth Controller

        Login and Register

        These apis are public means everyone can access and will create a new user and send the token for the logged in users.

    - Articles Controller

        These are the private apis means only authorized users can access.

        - Articles

            You can fetch the articles filtered or searched by title, authors, categories, and sources.

        - Settings
            CRUD operations for user settings
            You can add, delete, update, and fetch the user settings with these apis.
