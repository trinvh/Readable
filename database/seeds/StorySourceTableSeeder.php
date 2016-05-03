<?php

use Illuminate\Database\Seeder;
use App\Models\Novel\Source;

class StorySourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $source = new Source();
        $source->name = "Bạch Ngọc Sách";
        $source->url = "http://bachngocsach.com/reader/truyen";
        $source->smodel = "\App\Models\Novel\SourceHandlers\BachNgocSach";
        $source->save();
    }
}
