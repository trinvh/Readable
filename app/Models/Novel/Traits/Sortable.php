<?php namespace App\Models\Novel\Traits;

trait Sortable {
    
    public function scopeLatest($query) {
        return $query->orderBy('updated_at', 'desc');
    }
    
    public function scopeAlphabet($query) {
        return $query->orderBy('name', 'asc');
    }
}