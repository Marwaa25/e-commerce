<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Création du client
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
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
        ]);

        // Mise à jour du client
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
        // Suppression du client
        User::findOrFail($id)->delete();

        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
    public function dashboard()
    {
        // récupérer les données nécessaires pour le dashboard
        $totalUsers = User::count();
        // $totalOrders = Order::count();
        // $totalRevenue = Order::sum('total_price');
        
        // retourner la vue avec les données
        return view('admin_dashboard');
    }

}
