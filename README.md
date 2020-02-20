Data Cleansing Filter System
============================

![ci build](https://github.com/samsonasik/data-cleansing-filter-system/workflows/ci%20build/badge.svg)
[![Code Coverage](https://codecov.io/gh/samsonasik/data-cleansing-filter-system/branch/master/graph/badge.svg)](https://codecov.io/gh/samsonasik/data-cleansing-filter-system)

Setup
-----

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

3. Run Create DB Command, db migration, and db seeds:

```
php artisan database:create
php artisan migrate
php artisan db:seed
```

4. Run Local Development Server:

```bash
php artisan serve
```

