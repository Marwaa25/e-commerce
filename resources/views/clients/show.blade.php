{{-- @extends('layouts.app')

@section('content') --}}
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $client->name }}</div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Nom:</label>
                            <div class="col-md-6">
                                {{ $client->name }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Email:</label>
                            <div class="col-md-6">
                                {{ $client->email }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Numéro de téléphone:</label>
                            <div class="col-md-6">
                                {{ $client->phone_number }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">Supprimer le client</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- @endsection --}}
