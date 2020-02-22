Import Flow
===========

The import flow is handled by middleware, that registered in `routes/web.php` at `/import`:

```php
<?php

Route::post('/import', 'SystemController@import')
    ->name('import')
    ->middleware([
        // import to customers table
        App\Http\Middleware\CustomerImport::class,

        // pull customers data from db and set to "customers" attributes in Request instance
        App\Http\Middleware\SetCustomersAttribute::class,

        // filtering data that need to be cleaned
        App\Http\Middleware\CustomerTitle::class,
        App\Http\Middleware\CustomerName::class,
        App\Http\Middleware\CustomerDOB::class,
        App\Http\Middleware\CustomerAddress::class,
        App\Http\Middleware\CustomerCity::class,
        App\Http\Middleware\CustomerRegion::class,
        App\Http\Middleware\CustomerPostCode::class,
        App\Http\Middleware\CustomerCountryCode::class,
        App\Http\Middleware\CustomerTelephone::class,

        // finally, save log data cleansing if any errors
        App\Http\Middleware\CustomerLogDataCleansing::class,
    ]);
```

First, we import the collection in the form into `customers` table, after it, we set 'customers' request attribute so can be used in next middlewares for getting customers data to be cleaned and the logging purpose.

Each middleware filter has constant `SCORE` that will be used to when data is invalid. They can be activated by add/remove the filters.

Finally, save log data, there is `CustomerLogDataCleansing::COLUMNS` constant for saving to DB what fields that need suggestion for correction.

[>>> Prev (Database Structure)](/docs/database-structure.md)
[>>> Next (Usage)](/docs/usage.md)