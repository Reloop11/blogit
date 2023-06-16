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
        Builder::macro('search', function(string $query, array $fields) {
            $query = trim($query);
            
            if ($query) {
                $this->where(function($queryBuilder) use ($query, $fields) {
                    $keywords = explode(' ', $query);
                    $keywords = array_map('trim', $keywords);
                    $keywords = array_filter($keywords);
                    
                    foreach($fields as $field) {
                        foreach($keywords as $key) {
                            $queryBuilder->orWhere($field, 'like', '%'.$key.'%');
                            }
                    }
                });
            }
                    
            return $this;
        });
    }
}
