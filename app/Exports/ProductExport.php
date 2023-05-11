<?php

namespace App\Exports;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nom',
            'Prix',
            'Description',
            // Ajoutez ici d'autres noms de colonnes pour exporter d'autres champs de produits
        ];
    }
}
