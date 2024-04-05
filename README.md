## Requirements

- PHP >= 8.1.0

## Usage

1. Clone project
2. Create .env file, copy content from .env.example to .env file and config your database in .env:

``` bash
    APP_DEBUG=false
    APP_URL=domain
	
	DB_CONNECTION=mysql
	DB_HOST=database_server_ip
	DB_PORT=3306
	DB_DATABASE=database_name
	DB_USERNAME=username
	DB_PASSWORD=password

```

3. Run

``` bash
	$ composer install
	$ php artisan key:generate
	$ php artisan jwt:secret
	$ php artisan migrate
	$ php artisan db:seed --class=DatabaseSeeder
	$ php artisan scribe:generate
	$ php artisan storage:link
	$ php artisan route:clear
	$ php artisan config:clear
	
	
	$ npm install
	$ npm run build or vite build

```

4. Local development server

- Run

``` bash
back-end
	$ php artisan serve
	
front-end
	$ vite
	or
	$ npm run dev
```

- In your browser, go to [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login) to run your project.
- Login with default admin account : admin and password: 123456aA@
