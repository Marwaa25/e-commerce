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
          $categories = [    [        'name' => 'Soin de la peau',        'description' => 'Catégorie des produits pour le soin de la peau'    ],
          [        'name' => 'Soin des cheveux',        'description' => 'Catégorie des produits pour le soin des cheveux'    ],
          [        'name' => 'Soin des lèvres',        'description' => 'Catégorie des produits pour les lèvres'    ],
          [        'name' => 'Soin des mains',        'description' => 'Catégorie des produits pour les mains'    ]

      ];
      

        foreach ($categories as $category) {
            Category::create($category);
        }
        $product = new Product;
        $product->name = 'Crème solaire Avène SPF 50+';
        $product->description = 'Crème solaire Avène pour peaux sensibles, protection très haute SPF 50+';
        $product->price = 14.99;
        $product->category_id = 1; // ID de la catégorie à laquelle appartient le produit
        $product->image = 'AVENE-SOLAIRE-ECRAN-CREME-TEINTEE-SPF50-50ML-NEW.jpg'; // nom de l'image du produit
        // $product->stock = 10;
        // $product->user_id = 1; // ID de l'utilisateur qui a créé le produit
        $product->save();

        $product = new Product;
        $product->name = 'Masque hydratant Caudalie';
        $product->description = 'Masque hydratant à l\'eau de raisin et huile de jojoba pour une peau douce et éclatante';
        $product->price = 25.99;
        $product->category_id = 1; // ID de la catégorie à laquelle appartient le produit
        $product->image = 'téléchargement.jpg'; // nom de l'image du produit
        // $product->stock = 10;
        // $product->user_id = 1; // ID de l'utilisateur qui a créé le produit
        $product->save();

        $product = new Product;
        $product->name = 'Eau micellaire Bioderma Sensibio H2O';
        $product->description = 'Eau micellaire démaquillante pour peaux sensibles';
        $product->price = 9.99;
        $product->category_id = 1; // ID de la catégorie à laquelle appartient le produit
        $product->image = 'bioderma-sensibio-h2o-500-ml.jpg'; // nom de l'image du produit
        // $product->stock = 10;
        // $product->user_id = 1; // ID de l'utilisateur qui a créé le produit
        $product->save();

        $product = new Product;
        $product->name = 'Soin contour des yeux La Roche-Posay';
        $product->description = 'Soin contour des yeux anti-cernes et anti-poches pour peaux sensibles';
        $product->price = 19.99;
        $product->category_id = 1; // ID de la catégorie à laquelle appartient le produit
        $product->image = 'la-roche-posay-redermic-c-yeux-15ml-soin-de-comblement-anti-age.jpg'; // nom de l'image du produit
        // $product->stock = 10;
        // $product->user_id = 1; // ID de l'utilisateur qui a créé le produit
        $product->save();

        $product = new Product;
        $product->name = 'Crème mains Neutrogena';
        $product->description = 'Crème mains Neutrogena pour les mains déchessés';
        $product->price = 11.99;
        $product->category_id = 4; // ID de la catégorie à laquelle appartient le produit
        $product->image = 'neutrogena-neutrogena-creme-mains-concentree-parfumee-50-ml-corps.jpg'; // nom de l'image du produit
        // $product->stock = 10;
        // $product->user_id = 1; // ID de l'utilisateur qui a créé le produit
        $product->save();

        
        $product = new Product;
        $product->name = 'Après-Shampoing Klorane';
        $product->description = 'Après-Shampoing éclaircissant pour cheveux blonds à la camomille';
        $product->price = 11.99;
        $product->category_id = 2; // ID de la catégorie à laquelle appartient le produit
        $product->image = '61grzIBMosS._SL1500_.jpg'; // nom de l'image du produit
        // $product->stock = 10;
        // $product->user_id = 1; // ID de l'utilisateur qui a créé le produit
        $product->save();


        $product = new Product;
        $product->name = 'Shampoing Klorane à la camomille';
        $product->description = 'Shampoing éclaircissant pour cheveux blonds à la camomille';
        $product->price = 12.99;
        $product->category_id = 2; // ID de la catégorie à laquelle appartient le produit
        $product->image = 'klorane-klorane-shampooing-a-la-camomille-blondissant-et-illuminateur-200-ml-shampooing-reflets-et-brillance.jpg'; // nom de l'image du produit
        // $product->stock = 10;
        // $product->user_id = 1; // ID de l'utilisateur qui a créé le produit

        $product->save();
        $product = new Product;
        $product->name = 'Soin anti-imperfections Vichy';
        $product->description = 'Soin anti-imperfections pour peaux grasses et à tendance acnéique';
        $product->price = 17.99;
        $product->category_id = 1; // ID de la catégorie à laquelle appartient le produit
        $product->image = 'normaderm-phytosolution.jpg'; // nom de l'image du produit
        // $product->stock = 10;
        // $product->user_id = 1; // ID de l'utilisateur qui a créé le produit

        $product->save();
        $product = new Product;
        $product->name = 'Baume à lèvres Biotherm';
        $product->description = 'Baume à lèvres hydratant et protecteur';
        $product->price = 7.99;
        $product->category_id = 3; // ID de la catégorie à laquelle appartient le produit
        $product->image = '14423676701.jpg'; // nom de l'image du produit
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
