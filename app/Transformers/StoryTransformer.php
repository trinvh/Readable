<?php namespace App\Transformers;

use App\Models\Novel\Story;

class StoryTransformer extends \Transformer {
    
    public function transform(Story $story) {
        return [
            'name'  => $story->name,
            'slug'  => $story->slug,
            'photo' => $story->photo,
            'viewed'    => (int)$story->viewed,
            'updated_at' => (string)$story->updated_at,
            'author'    => $story->authors->first()->name,
            'latest_chap'   => $story->chapters()->orderBy('sort_order','desc')->first()
        ];
    }
}