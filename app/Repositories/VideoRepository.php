<?php

namespace BluesFlix\Repositories;

use Illuminate\Http\UploadedFile;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface VideoRepository
 * @package namespace BluesFlix\Repositories;
 */
interface VideoRepository extends RepositoryInterface
{
    public function uploadThumb($id,UploadedFile $file);
    public function uploadFile($id,UploadedFile $file);
}
