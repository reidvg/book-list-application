@extends('layouts.app')
<style>
    tr td:first-child {
        width: 20%;
    }
    tr td:last-child {
        width: 10%;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="col-md-3 col-xs-3 col-sm-3 col-md-offset-2 col-xs-offset-2 col-sm-offset-2">
            @if($model->image)
                <img src="/images/{{ $model->image }}"/><span hidden>{{$model->image}}</span>
            @else
                No Image
            @endif
        </div>
        <div class="col-md-5 col-xs-5 col-sm-5">
            <h2>{{ $model->title }}</h2>
            <p>{{$model->author}}</p>
            <p>{{$model->description}}</p>
            <p>{{$model->publication_date}}</p>
        </div>
    </div>
@endsection