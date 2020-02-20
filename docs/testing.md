Testing
=======

On very first run, you need to create database, migration, and db seed for testing purpose with set `.env.testing` file from `.env.example.testing`:

```bash
cp .env.example.testing .env.testing
```

and then configure the `.env.testing` to ensure it has a match db configuration with your local dev environment:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=data_cleansing_filter_system_test
DB_USERNAME=root
DB_PASSWORD=
```

> Ensure that you use **different DB** for `testing`.

```bash
php artisan database:create --env=testing
php artisan migrate --env=testing
```

After it, you can run:

```bash
vendor/bin/phpunit
````

