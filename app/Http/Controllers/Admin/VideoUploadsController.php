<?php

namespace BluesFlix\Http\Controllers\Admin;

use BluesFlix\Forms\VideoUploadForm;
use BluesFlix\Http\Controllers\Controller;
use BluesFlix\Repositories\VideoRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Facades\FormBuilder;
use BluesFlix\Models\Video;

class VideoUploadsController extends Controller
{

    /**
     * @var VideoRepository
     */
    private $repository;

    public function __construct(VideoRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Video $video)
    {
        /** @var Form $form */
        $form = FormBuilder::create(VideoUploadForm::class, [
            'url' => route('admin.videos.uploads.store', ['video' => $video->id]),
            'method' => 'POST',
            'model' => $video
        ]);
        return view('admin.videos.upload', compact('form'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        /** @var Form $form */
        $form = FormBuilder::create(VideoUploadForm::class);
        if (!$form->isValid()){
            return redirect()
                ->back()
                ->whithErrors($form->getErrors())
                ->withInput();
        }
        $this->repository->uploadThumb($id,$request->file('thumb')); //l5-repository
        $request->session()->flash('message', 'Upload(s) alterado(s) com sucesso. ');
        return redirect()->route('admin.videos.uploads.create',['video' => $id]);
    }


}
