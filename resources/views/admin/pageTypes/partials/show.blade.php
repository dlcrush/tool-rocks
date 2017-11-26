@foreach($rows as $row)
    <div class="form-group row">
        <label>{{ array_get($row, 'label') }}</label>
        <div class="form-control" readonly>{{ $model->{array_get($row, 'valueKey')} }}</div>
    </div>
@endforeach
