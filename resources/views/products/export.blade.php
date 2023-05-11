@extends('layouts.header')

@section('content')
<div class="card">
    <div class="card-header">
        Exporter des produits
    </div>
    <div class="card-body">
        <form action="{{ route('products.export') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="format">Format</label>
                <select class="form-control" id="format" name="format">
                    <option value="csv">CSV</option>
                    <option value="xls">Excel</option>
                    <option value="pdf">PDF</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Exporter</button>
        </form>
    </div>
</div>
@endsection
