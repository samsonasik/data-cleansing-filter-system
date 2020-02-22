Installation
============

1. Clone project and get the dependencies

```bash
git clone git@github.com:samsonasik/data-cleansing-filter-system.git
cd data-cleansing-filter-system && composer install
```

2. Configuration

Configure the `.env` to ensure it has a match db configuration with your local dev environment:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=data_cleansing_filter_system
DB_USERNAME=root
DB_PASSWORD=
```

3. Run Create DB Command, and db migration:

```
php artisan database:create
php artisan migrate
```

4. Run Local Development Server:

```bash
php artisan serve
```

5. Open in the browser http://localhost:8000

[>>> Next (Database Structure)](/docs/database-structure.md)
