<?php


namespace BluesFlix\Media;


use Illuminate\Filesystem\FilesystemAdapter;

trait VideoStorages
{
    /**
     * @return \Illuminate\Filesystem\FilesystemAdapter
     */
    public function  getStorage(){
        return \Storage::disk($this->getDiskDrive());
    }

    protected function getDiskDrive(){
        return config('filesystems.default');
    }

    protected function getAbsolutePath(FilesystemAdapter $storage, $fileRelativePath)
    {
        return $storage->getDriver()->getAdapter()->applyPathPrefix($fileRelativePath);
        $storage->url($fileRelativePath);
    }

    public function isLocalDriver(){
        $driver = config("filesystems.disks.{$this->getDiskDrive()}.driver");
        return $driver == 'local';
    }
}