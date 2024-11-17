<?php

namespace App\Imports;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Subcategories;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $failures = [];

    public function model(array $row)
    {
        Log::info('Importing row: ', $row);
        DB::beginTransaction();

        try {
            // Accessing values using keys
            $slug = Str::slug($row['name']);
            $imagePaths = [];

            if (isset($row['image']) && !empty($row['image'])) {
                $imagePaths = $this->storeImages($row['image'],$row['name']);
            }


            // Exploding subcategories
            $subcategories = array_map('trim', explode(',', $row['subcategories']));
            $category = Categories::firstOrCreate(['name' => $row['category']],['slug' => Str::slug($row['category'])]);

            // Product Creation
            $product = Products::create([
                'name' => $row['name'],
                'image' => $imagePaths,
                'price' => $row['price'],
                'description' => $row['description'],
                'brand' => $row['brand'],
                'color' => $row['color'],
                'size' => $row['size'],
                'category_id' => $category->id,
                'stock' => $row['stock'],
                'slug' => $slug,
                'created_by' => auth()->user()->id,
            ]);

            // Sync Subcategories
            $subcategoryIds = [];
            foreach ($subcategories as $subcategoryName) {
                $subcategorySlug = Str::slug($subcategoryName);
                // Ensure unique slug
                $originalSlug = $subcategorySlug;
                $counter = 1;
                while (Subcategories::where('slug', $subcategorySlug)->where('category_id', $category->id)->exists()) {
                    $subcategorySlug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                $subcategory = Subcategories::firstOrCreate(
                    ['subcategory' => $subcategoryName, 'category_id' => $category->id],
                    ['slug' => $subcategorySlug]
                );
                $subcategoryIds[] = $subcategory->id;
            }

            if (!empty($subcategoryIds)) {
                $product->subcategories()->sync($subcategoryIds);
            }

            DB::commit();
            Log::info('Product created successfully with ID: ' . $product->id);
            return $product;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create product: ' . $e->getMessage());
            Log::error('Row data: ' . json_encode($row)); // Log the row data
            return null;
        }
    }

    protected function storeImages($images, $productName)
    {
        $imagePaths = [];

        foreach (explode(',', $images) as $index => $imagePath) {
            $imagePath = trim($imagePath);
            if (file_exists($imagePath)) {
               // $imageName = basename($imagePath);
               $imageName = Str::slug($productName) . '-' . ($index + 1) . '.' . pathinfo($imagePath, PATHINFO_EXTENSION);

                $destinationPath = 'products/' . $imageName;
                \Storage::disk('public')->putFileAs('products', $imagePath, $imageName);

                $imagePaths[] = $destinationPath;
            } else {
                Log::error('Image file does not exist: ' . $imagePath);
            }
        }

        return json_encode($imagePaths);
    }


    // Validation rules for each row
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'image' => 'required|nullable|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'brand' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'category' => 'nullable|string',
            'subcategories' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
        ];
    }
    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $row = $failure->row();
            $errors = $failure->errors();
            Log::error('Row ' . $row . ' failed with errors: ' . json_encode($errors));
        }
    }
}
