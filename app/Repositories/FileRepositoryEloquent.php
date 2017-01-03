<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Contracts\FileRepository;

use App\File;
use DB;

class FileRepositoryEloquent extends BaseRepository implements FileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return File::class;
    }

    /**
     * Get all files with category
     *
     * @param $page_size
     * @return mixed
     */
    public function getAllWithCategory($page_size){
        $files = DB::table('files')
               ->leftjoin('categories', 'files.cat_id', '=', 'categories.id')
               ->select('files.*', 'categories.title as category_name')
               ->orderBy('files.created_at','desc')
               ->paginate($page_size);
        return $files;
    }
}
