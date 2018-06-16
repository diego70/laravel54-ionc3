<?php

namespace BluesFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class SerieForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text')
            ->add('description', 'textarea');
    }
}
