<?php namespace App\Models\Novel\Traits;

trait HasManyRender {
    
    public function showMany($relation) {
        if($this->$relation->count() <= 0)
            return '<span class="label label-danger">No item</span>';
        return implode(', ', $this->$relation->pluck('name')->toArray());
    }
}