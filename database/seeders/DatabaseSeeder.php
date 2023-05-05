<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
          // Ajout de catégories
          $categories = [
            [
                'name' => 'Vêtements',
                'description' => 'Catégorie des vêtements'
            ],
            [
                'name' => 'Électronique',
                'description' => 'Catégorie de l\'électronique'
            ],
            [
                'name' => 'Sports',
                'description' => 'Catégorie des articles de sport'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
        $product = new Product;
        $product->name = 'Nom du produit';
        $product->description = 'Description du produit';
        $product->price = 19.99;
        $product->category_id = 1; // ID de la catégorie à laquelle appartient le produit
        $product->image = 'AVENE-SOLAIRE-ECRAN-CREME-TEINTEE-SPF50-50ML-NEW.jpg'; // nom de l'image du produit
        // $product->stock = 10;
        // $product->user_id = 1; // ID de l'utilisateur qui a créé le produit
        $product->save();
        $product = new Product;
        $product->name = 'Nom du produit';
        $product->description = 'Description du produit';
        $product->price = 19.99;
        $product->category_id = 1; // ID de la catégorie à laquelle appartient le produit
        $product->image = 'cerave-gel-moussant-peaux-normales-a-grasses-473ml.jpg'; // nom de l'image du produit
        // $product->stock = 10;
        // $product->user_id = 1; // ID de l'utilisateur qui a créé le produit
        $product->save();
        $user = new User();
        $user->name = "Manal";
        $user->email = "manal@gmail.com";
        $user->email_verified_at = now();
        $user->password = bcrypt('password');
        $user->role = 'admin';
        $user->save();

        $user = new User();
        $user->name = "Ahmad";
        $user->email = "ahmad@gmail.com";
        $user->email_verified_at = now();
        $user->role = 'client';
        $user->password = bcrypt('password');
        $user->save();
    }
    
    
}
