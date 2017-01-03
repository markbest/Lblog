<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Contracts\PictureRepository;

use App\Picture;
use DB;

class PictureRepositoryEloquent extends BaseRepository implements PictureRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Picture::class;
    }
}
