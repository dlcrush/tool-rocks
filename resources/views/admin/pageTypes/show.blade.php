@extends('admin/layouts/app')

@section('content')
    <div class="row">
        <h1>{{ $title }}</h1>
    </div>

    <form>
        @include('admin.pageTypes.partials.show', [
            'rows' => $rows,
            'model' => $model
        ])
        <div class="form-group row">
            <div class="col-md-6">
                <a class="btn btn-lg btn-block btn-primary" href="#">Edit</a>
            </div>
            <div class="col-md-6">
                <a class="btn btn-lg btn-block btn-default" href="#">Back</a>
            </div>
        </div>
    </form>
@endsection
