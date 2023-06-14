# Innoscripta Backend App - Laravel
### Tools required

-   Docker Engine 22.0.0 or later

-   Docker Compose 2.0.0 or later

## Getting Started

1. Clone this repository to your local machine:

```
git clone https://github.com/amatsui0725/innoscripta_backend.git
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
