<?php
namespace BluesFlix\Http\Controllers\Admin\Auth;
use BluesFlix\Forms\UserSettingsForm;
use BluesFlix\Repositories\UserRepository;
use FormBuilder;
use Illuminate\Http\Request;
use BluesFlix\Http\Controllers\Controller;
class UserSettingsController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * UserSettingsController constructor.
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function edit()
    {
        /** @var Form $form */
        $form = FormBuilder::create(UserSettingsForm::class,[
            'url' => route('admin.user_settings.update'),
            'method' => 'PUT'
        ]);
        return view('admin.auth.setting', compact('form'));
    }
    public function update(Request $request)
    {
        /** @var form $form */
        $form = FormBuilder::create(UserSettingsForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        $this->repository->update($data, \Auth::user()->id);
        session()->flash('message', 'Senha alterada com sucesso!');
        return redirect()->route('admin.user_settings.edit');
    }
}