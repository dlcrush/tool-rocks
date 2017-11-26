@extends('admin/layouts/app')

@section('content')
    <div class="row">
        <h1>{{ $title }}</h1>
    </div>

    <div class="row">
        @include('admin.partials.alert', [
            'type' => 'warning',
            'title' => 'WARNING:',
            'message' => 'You are about to delete the following resource'
        ])
    </div>

    <form action="{{ $action }}" method="POST">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">
        @include('admin.pageTypes.partials.show', [
            'rows' => $rows,
            'model' => $model
        ])
        <div class="form-group row">
            <button type="submit" class="btn btn-danger btn-lg btn-block">Confirm Delete</button>
        </div>
    </form>
@endsection
