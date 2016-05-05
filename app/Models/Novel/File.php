<?php

namespace App\Models\Novel;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use \UuidTrait;
    
    protected $table = 's_story_files';
    
    protected $fillable = ['path', 'file_type', 'total_chapters'];
    
    public function story() {
        return $this->belongsTo(Story::class, 'story_id');
    }
}
