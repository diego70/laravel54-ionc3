<?php

namespace BluesFlix\Http\Controllers\Admin;


use BluesFlix\Forms\SerieForm;
use BluesFlix\Models\Serie;
use BluesFlix\Repositories\SerieRepository;
use FormBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use BluesFlix\Http\Controllers\Controller;

/**
 * @property SerieRepository repository
 */
class SeriesController extends Controller
{

    public function __construct(SerieRepository $repository)
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
        $series = $this->repository->paginate();
        return view('admin.series.index', compact('series'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(SerieForm::class,[
            'url' =>route('admin.series.store'),
            'method' => 'POST'
        ]);
        return view('admin.series.create', compact('form'));
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
        $form = FormBuilder::create(SerieForm::class);
        if (!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        Model::unguard();
        $data['thumb'] = 'thumb.jpg';
        $this->repository->create($data);
        $request->session()->flash('message', 'Serie criada com sucesso.');
        return redirect()->route('admin.series.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \BluesFlix\Models\Serie  $series
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $series)
    {
        return view('admin.series.show', compact('series'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BluesFlix\Models\Serie  $series
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $series)
    {
        $form = FormBuilder::create(SerieForm::class,[
            'url' =>route('admin.series.update', ['category' => $series->id]),
            'method' => 'PUT',
            'model' => $series
        ]);
        return view('admin.series.create', compact('form'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BluesFlix\Models\Serie  $series
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Form $form */
        $form = FormBuilder::create(SerieForm::class);
        if (!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Serie alterada com sucesso.');
        return redirect()->route('admin.series.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \BluesFlix\Models\Serie  $series
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->repository->delete($id);
        $request->session()->flash('message', 'Serie excluída com sucesso.');
        return redirect()->route('admin.series.index');
    }

}
