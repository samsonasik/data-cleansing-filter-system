<?php

namespace App\Http\Middleware;

use App\LogDataCleansingFilter;
use Closure;

class CustomerLogDataCleansing
{
    private const COLUMNS = [
        'title',
        'name',
        'date_of_birth',
        'address',
        'city',
        'region',
        'postcode',
        'country_code',
        'telephone',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $datacleansing = $request->attributes->get('datacleansing');
        if ($datacleansing) {
            foreach ($datacleansing as $key => $row) {
                $model = new LogDataCleansingFilter();
                $model->customer_id = $key;
                $model->score       = $row['score'];
                foreach (self::COLUMNS as $column) {
                    if (! empty($row[$column])) {
                        $model->{$column . '_correct_suggestion'} = $row[$column];
                    }
                }
                $model->save();
            }
        }

        return $next($request);
    }
}
