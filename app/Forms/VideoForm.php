<?php
namespace BluesFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class VideoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text', [
                'rules' => 'required|max:255'
            ])
            ->add('description', 'textarea', [
                'rules' => 'required'
            ]);
    }
}