<?php

namespace BluesFlix\Http\Controllers\Admin;

use BluesFlix\Forms\VideoRelationForm;
use BluesFlix\Models\Video;
use BluesFlix\Repositories\VideoRepository;
use FormBuilder;
use Illuminate\Http\Request;
use BluesFlix\Http\Controllers\Controller;

class VideoRelationsController extends Controller
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
        /** @var Form  $form */
        $form = FormBuilder::create(VideoRelationForm::class,[
            'url'=> route('admin.videos.relations.store', ['video' => $video->id]),
            'method' => 'POST',
            'model' => $video
        ]);
        return view('admin.videos.relation', compact('form'));
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
        $form = FormBuilder::create(VideoRelationForm::class);
        if (!$form->isValid()){
            return redirect()
                ->back()
                ->whithErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Vídeo alterado com sucesso. ');
        return redirect()->route('admin.videos.relations.create',['video' => $id]);
    }


}
