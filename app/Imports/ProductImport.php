<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductImport implements ToCollection
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Product::create([
                'id' => $row[0],
                'name' => $row[1],
                'description' => $row[2],
                'price' => $row[3],
                'image' => $row[4],
                'stock' => $row[5],
                'category_id' => $row[6],
            ]);
        }
    }

    /**
     * Import data into the database.
     *
     * @param mixed $file
     * @return void
     */
    public function import($file)
    {
        $rows = \Maatwebsite\Excel\Facades\Excel::toCollection(new ProductImport, $file);
        $this->collection($rows->first());
    }
}
