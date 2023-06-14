<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class QueryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Builder::macro('search', function(string $query) {
            $query = trim($query);
            
            if ($query) {
                $this->where(function($queryBuilder) use ($query) {
                    $keywords = explode(' ', $query);
                    $keywords = array_map('trim', $keywords);
                    $keywords = array_filter($keywords);
                    
                    $queryBuilder
                        ->where('title', 'like', $query.'%')
                        ->orWhere('title', 'like', '%'.$query.'%')
                        ->orWhere('title', 'like', '%'.$query)
                        ->orWhere('body', 'like', '%'.$query.'%');
                    
                    foreach($keywords as $key) {
                        $queryBuilder->orWhere('title', 'like', '%'.$key.'%');
                        $queryBuilder->orWhere('body', 'like', '%'.$key.'%');
                    }

                })->orderByRaw("CASE
                    WHEN title LIKE ? THEN 1
                    WHEN title LIKE ? THEN 2
                    WHEN title LIKE ? THEN 3
                    WHEN body LIKE ? THEN 4
                    ELSE 5 END",
                    [$query.'%', '%'.$query.'%', '%'.$query, '%'.$query.'%']);
            }
                    
            return $this;
        });
    }
}
