@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de series</h3>
            {!! Button::primary('Nova series')->asLinkTo(route('admin.series.create')) !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($series->items())->striped()
                ->callback('Ações', function($field, $series){
                     $linkEdit = route('admin.series.edit',['serie' => $series->id]);
                    $linkShow = route('admin.series.show',['serie' => $series->id]);
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).'|'.
                        Button::link(Icon::create('remove'))->asLinkTo($linkShow);
                })
            !!}
            {!! $series->links() !!}
        </div>
    </div>
@endsection

@push('styles')
    <style type="text/css">
        table > thead > tr > th:nth-child(3){
            width: 50%;
        }
    </style>
@endpush