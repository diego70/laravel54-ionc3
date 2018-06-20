@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Ver serie</h3>
            <?php
            $iconEdit = Icon::create('pencil');
            $iconRemove = Icon::create('trash');
            ?>
            {!! Button::primary($iconEdit)->asLinkTo(route('admin.series.edit',['series'=>$series->id])) !!}
            {!!
                Button::danger($iconRemove)
                ->asLinkTo(route('admin.series.destroy',['series'=>$series->id]))
                ->addAttributes(['onclick'=>"event.preventDefault();document.getElementById(\"form-delete\").submit();"])
            !!}
            <?php $formDelete = FormBuilder::plain([
                'id' => 'form-delete',
                'method' => 'DELETE',
                'style' => 'display:none',
                'route'=>['admin.series.destroy','series'=>$series->id]
            ]);?>
            {!! form($formDelete) !!}
            <br/><br/>

            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">Thumb</th>
                    <td>
                        <img src="{{$series->thumb_asset}}" width="512" height="360">
                    </td>
                </tr>
                <tr>
                    <th scope="row">#</th>
                    <td>{{$series->id}}</td>
                </tr>

                <tr>
                    <th scope="row">Titulo</th>
                    <td>{{$series->title}}</td>
                </tr>

                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$series->description}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection