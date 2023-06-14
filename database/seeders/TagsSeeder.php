<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Games'],
            ['name' => 'History'],
            ['name' => 'Design'],
            ['name' => 'Books'],
            ['name' => 'Art'],
            ['name' => 'Humor'],
            ['name' => 'Music'],
            ['name' => 'News'],
            ['name' => 'Reviews'],
            ['name' => 'Food'],
            ['name' => 'Photography'],
            ['name' => 'Technology'],
            ['name' => 'Travel'],
            ['name' => 'Internet'],
            ['name' => 'Movies'],
            ['name' => 'Recipes'],
            ['name' => 'Sports'],
            ['name' => 'Science'],
            ['name' => 'Nature'],
            ['name' => 'Fashion'],
        ];
        
        foreach($tags as $tag) {
            Tag::firstOrCreate($tag);
        }
    }
}
