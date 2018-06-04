@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            {!! Table::withContents($users->items())->striped() !!}
        </div>
        {!! $users->Links() !!}
    </div>

@endsection