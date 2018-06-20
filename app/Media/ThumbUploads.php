<?php

namespace BluesFlix\Media;


use Folklore\Image\Facades\Image;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Imagine\Image\Box;

trait ThumbUploads
{
    public function uploadThumb($id,UploadedFile $file)
    {
        $model = $this->find($id);
        $name = $this->upload($model,$file, 'thumb');
        if ($name){
            $this->deleteThumbsOld($model);
            $model->thumb = $name;
            $this->makeThumbSmall($model);
            $model->save();
        }
        return $model;
    }

    protected function makeThumbSmall($model){
        $storage = $model->getStorage();
        $thumbfile = $model->thumb_path;
        $format = Image::format($thumbfile);
        $thumbnailSmall = Image::open($thumbfile)
            ->thumbnail(new Box(64, 36));
        $storage->put($model->thumb_small_relative,$thumbnailSmall->get($format));
    }

    public  function  deleteThumbsOld($model){
        /** @var FilesystemAdapter $storage */
        $storage = $model->getStorage();
        if($storage->exists($model->thumb_relative) && $model->thumb != $model->thumb_default){
            $storage->delete($model->thumb_relative, $model->thumb_small_relative);
        }
    }
}