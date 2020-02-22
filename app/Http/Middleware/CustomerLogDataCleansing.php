<?php

namespace App\Http\Middleware;

use App\LogDataCleansingFilter;
use Closure;

class CustomerLogDataCleansing
{
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
                if (! empty($row['title'])) {
                    $model->title_correct_suggestion = $row['title'];
                }
                if (! empty($row['name'])) {
                    $model->name_correct_suggestion = $row['name'];
                }
                if (! empty($row['date_of_birth'])) {
                    $model->date_of_birth_correct_suggestion = $row['date_of_birth'];
                }
                $model->save();
            }
        }

        return $next($request);
    }
}
