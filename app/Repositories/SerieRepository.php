<?php

namespace BluesFlix\Repositories;

use Illuminate\Http\UploadedFile;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SerieRepository
 * @package namespace BluesFlix\Repositories;
 */
interface SerieRepository extends RepositoryInterface
{
    public function uploadThumb($id,UploadedFile $file);
}
