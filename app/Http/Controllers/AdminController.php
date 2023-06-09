<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $clients = User::where('role', 'client')->get();

        return view('clients.index', compact('clients'));
    }
    public function show($id)
    {
        $client = User::where('role', 'client')->findOrFail($id);
    
        return view('clients.show', compact('client'));
    }
    

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'client',
        ]);

        return redirect()->route('clients.index')->with('success', 'Client créé avec succès.');
    }

    public function edit($id)
    {
        $client = User::findOrFail($id);

        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
        ]);

        $client = User::findOrFail($id);
        $client->name = $validatedData['name'];
        $client->email = $validatedData['email'];
        if (!empty($validatedData['password'])) {
            $client->password = bcrypt($validatedData['password']);
        }
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client modifié avec succès.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
    public function dashboard()
{
    $user = auth()->user();

    $orders = Order::all();
    $months = $orders->groupBy(function($order) {
        return Carbon::parse($order->created_at)->format('M Y');
    })->keys();
    $totals = $orders->groupBy(function($order) {
        return Carbon::parse($order->created_at)->format('M Y');
    })->map(function($orders) {
        return $orders->sum('amount');
    })->values();

    return view('admin_dashboard', compact('orders','months','totals','user'));
}
}

