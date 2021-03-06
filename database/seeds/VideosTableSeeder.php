<?php

use BluesFlix\Models\Category;
use BluesFlix\Repositories\VideoRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Collection $series */
        $series= \BluesFlix\Models\Serie::all();
        $categories = Category::all();
        $repository = app(VideoRepository::class);
        $collectionThumbs = $this->getThumbs();
        $collectionVideos = $this->getVideos();
        factory(\BluesFlix\Models\Video::class,4)
            ->create()
            ->each(function ($video)use(
                $series,
                $categories,
                $repository,
                $collectionThumbs,
                $collectionVideos
            ){
                $repository->uploadThumb($video->id, $collectionThumbs->random());
                $repository->uploadFile($video->id, $collectionVideos->random());
                $video->categories()->attach($categories->random(4)->pluck('id'));
                $num = rand(1, 3);
                if ($num%2==0){
                    $serie = $series->random();
                    $video->serie_id = $serie->id;
                    $video->serie()->associate($serie);
                    $video->save();
                }
        });
    }

    protected function getThumbs(){
        return new \Illuminate\Support\Collection([
            new \Illuminate\Http\UploadedFile(
                storage_path('app/files/faker/thumbs/thumb_ww.jpg'),
                'thumb_ww.jpg'
            ),
        ]);
    }

    protected function getVideos(){
        return new \Illuminate\Support\Collection([
            new \Illuminate\Http\UploadedFile(
                storage_path('app/files/faker/videos/westworld.mp4'),
                'westworld.mp4'
            ),
        ]);
    }
}
