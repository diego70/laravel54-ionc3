<?php

namespace BluesFlix\Http\Controllers\Admin;

use BluesFlix\Forms\VideoForm;
use BluesFlix\Models\Video;
use BluesFlix\Repositories\VideoRepository;
use Illuminate\Http\Request;
use FormBuilder;
use BluesFlix\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Form;


class VideosController extends Controller
{

    /**
     * @var VideoRepository
     */
    private $repository;

    /**
     * VideosController constructor.
     * @param VideoRepository $repository
     */
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = $this->repository->paginate();
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** @var Form  $form */
        $form = FormBuilder::create(VideoForm::class,[
            'url'=> route('admin.videos.store'),
            'method' => 'POST'
        ]);
        return view('admin.videos.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = FormBuilder::create(VideoForm::class);
        if (!$form->isValid()){
            return redirect()
                ->back()
                ->whithErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->create($data);
        $request->session()->flash('message', 'Vide Cadastrado com sucesso. ');
        return redirect()->route('admin.videos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \BluesFlix\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BluesFlix\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {

        /** @var Form  $form */
        $form = FormBuilder::create(VideoForm::class,[
            'url'=> route('admin.videos.update', ['video' => $video->id]),
            'method' => 'PUT',
            'model' => $video
        ]);
        return view('admin.videos.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BluesFlix\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(VideoForm::class);
        if (!$form->isValid()){
            return redirect()
                ->back()
                ->whithErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Video alterado com sucesso. ');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BluesFlix\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->repository->delete($id);
        return redirect()->route('admin.videos.index');
    }

    public function fileAsset(Video $video){
        return response()->download($video->file_path);
    }

    public  function thumbAsset(Video $video){
        return response()->download($video->thumb_path);
    }

    public  function thumbSmallAsset(Video $video){
        return response()->download($video->thumb_small_path);
    }
}
