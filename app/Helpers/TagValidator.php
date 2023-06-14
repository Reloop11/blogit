<?php

use App\Models\Tag;

class TagValidator {
    /**
     * Get valid tags from a request
     */
    public static function validate($tags, $maxTags = 5) {

        if (is_array($tags)) {
            $validated = [];
            
            $tags = array_unique($tags);
    
            foreach($tags as $tag) {
                $valid = Tag::where('name', '=', $tag)->first();
    
                if ($valid) {
                    array_push($validated, $valid); 
                }
            }
            
            if ($maxTags > 0) {
                $validated = array_slice($validated, 0, $maxTags);
            }
            
            return $validated;
        } else if (is_string($tags)) {
            return Tag::where('name', '=', $tags)->first();
        }
    }
}
