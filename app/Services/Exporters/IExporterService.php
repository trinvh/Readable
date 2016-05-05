<?php namespace App\Services\Exporters;

use App\Models\Novel\Story;
use App\Models\Novel\File;

abstract class IExporterService {
    
    // ORM instance
    protected $story;
    
    // Export provider instance
    protected $book;
    
    // Downloadable file
    protected $file;
    
    // epub, mobi, pdf...
    protected $type; 
    
    protected $savePath;
    
    public function __construct(Story $story) {
        $this->story = $story;
        $this->savePath = 'downloads/' . $this->type;
        if(! file_exists($this->savePath)) {
            mkdir($this->savePath, 0777, true);
        }
    }
    
    /*
     * return http header for download
    */
    abstract public function exportAndDownload();
    
    /*
     * return url that downloadable
    */
    abstract public function export();
    
    protected function checkFileExists() {
        $query = $this->story->files()->where('file_type', $this->type);
        if($query->count() > 0) {
            $record = $query->first();
            if($record->total_chapters >= $this->story->chapters->count()) {
                $this->file = $record->path;
                return true;
            }
            // TODO : Delete existed file and record in db
            return false;
        }
        return false;
    }
    
    protected function saveToDatabase($path) {
        $this->story->files()->save(
            new File([
                'path' => $path,
                'file_type' => $this->type,
                'total_chapters' => $this->story->chapters->count()
            ])
        );
    }
}