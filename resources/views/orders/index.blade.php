@extends($header)

@section('content')
    <div class="container">
        <h1>Liste des commandes</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date de création</th>
                    @if (auth()->check() && !Auth::user()->isAdmin())

                    <th>Facture</th>
                    @endif
                    @if (auth()->check() && Auth::user()->isAdmin())
                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if (auth()->check() && !Auth::user()->isAdmin())

                            <!-- ... -->
                            <a href="{{ route('orders.download_invoice', $order->id) }}" class="btn btn-primary">
                                Télécharger la facture
                            </a>
                            @endif
                        </td>
                        <td>
                            @if (auth()->check() && Auth::user()->isAdmin())

                            {{-- <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">Voir</a> --}}
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-secondary btn-sm">Modifier</a>
                            {{-- <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">Supprimer</button>
                            </form> --}}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $orders->links() }} --}}
    </div>
@endsection
