<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\Failure;


class ProductImport implements ToCollection, WithValidation
{
    public function rules(): array
    {
        return [
            '1' => 'numeric', // Ensure that the second column is numeric
        ];
    }

    public function collection(Collection $rows)
    {
        $failures = [];

        foreach ($rows as $row) {
            try {
                $product = Product::create([
                    'name' => $row[0],
                    'price' => $row[1],
                    'description' => $row[2],
                ]);

                // ...
            } catch (\Exception $e) {
                $failures[] = new Failure(
                    $row,
                    $e->getMessage(),
                    'price' // Attribute causing the error
                );
            }
        }

        if (!empty($failures)) {
            throw new ValidationException(null, $failures);
        }
    }
}