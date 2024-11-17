<?php

namespace App\Livewire\Admin;

use App\Models\Categories;
use App\Models\Subcategories;
use App\Models\User;
use App\Notifications\NewProductNotification;
use Auth;
use Livewire\Component;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class Products extends Component
{
    public $name;
    public $images = [];
    public $price, $stock, $brand, $size, $color;
    public $description, $product;
    public $categories = [], $subcategories = [];
    public $category, $view = 'products';
    public $product_id = null;
    public $products;
    public $subcategory;
    public $subcategory_ids = [];
    public $subcategory_id, $is_active;
    public $bulkFile;

    use WithFileUploads;

    public function mount($product_id = null)
    {
        $this->categories = Categories::all();
        if ($this->view == 'edit-product' && $product_id) {
            $this->product = \App\Models\Products::with('category', 'subcategories')->findOrFail($product_id);
            $this->product_id = $this->product->id;
            $this->name = $this->product->name;
            $this->price = $this->product->price;
            $this->description = $this->product->description;
            $this->color = $this->product->color;
            $this->size = $this->product->size;
            $this->brand = $this->product->brand;
            $this->stock = $this->product->stock;
            $this->category = $this->product->category_id;
            $this->subcategory_ids = $this->product->subcategories->pluck('id')->toArray();
            $this->subcategories = Categories::find($this->category)->subcategories ?? [];
            $this->is_active = $this->product->is_active;
        }

        if ($this->view == 'trashed-products') {
            $this->products = \App\Models\Products::onlyTrashed()->with('category')->get();
        }
    }

    //enabled or disabled product
    public function toggleStatus()
    {
        $this->is_active = $this->is_active == 0 ? 1 : 0;

        \App\Models\Products::where('id', $this->product_id)
            ->update(['is_active' => $this->is_active]);

        session()->flash('message', 'Product status updated successfully.');
    }


    public function show($id) //fetch subcategory based on category
    {
        $subcategories = Subcategories::where('category_id', $id)->pluck('subcategory', 'id');
        return response()->json($subcategories);
    }

    //save product
    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'images' => 'required|array|min:1',
            'images.*' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'price' => 'required',
            'description' => 'required|string',
            'brand' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'category' => 'nullable|exists:categories,id',
            'stock' => 'nullable|integer|min:0',
            'subcategory_ids' => 'nullable|array|exists:subcategories,id',
            'subcategory_ids.*' => 'nullable|exists:subcategories,id',
        ], [
            'images.required' => 'At least one image is required.',
            'images.*.mimes' => 'Only jpeg, jpg, png, and webp images are allowed.',
            'images.*.max' => 'Each image may not be greater than 2 MB.',
        ]);


        $imagePaths = [];
        if ($this->images) {
            foreach ($this->images as $index => $image) {
                $imageName = Str::slug($this->name) . '-' . ($index + 1) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('products', $imageName, 'public');
                $imagePaths[] = $imagePath;
            }
        }


        $slug = Str::slug($this->name);
        $existProdCount = \App\Models\Products::where('slug', $slug)->count();
        if ($existProdCount > 0) {
            $slug .= '-' . ($existProdCount + 1);
        }

        $product = \App\Models\Products::create([
            'name' => $this->name,
            'image' => json_encode($imagePaths),
            'price' => $this->price,
            'description' => $this->description,
            'brand' => $this->brand,
            'color' => implode(',', array_map('trim', explode(',', $this->color))),
            'size' => implode(',', array_map('trim', explode(',', $this->size))),
            'category_id' => $this->category,
            'stock' => $this->stock,
            'slug' => $slug,
            'created_by' => Auth::user()->id
        ]);
        // Attach subcategories to the product
        if ($this->subcategory_ids) {
            $product->subcategories()->sync($this->subcategory_ids);
        }
        $users = User::get();
        foreach ($users as $user) {
            $user->notify(new NewProductNotification($product));
        }
        Session::flash('success', 'Product created successfully!');
        return $this->redirect('/admin/products', navigate: true);
    }


    public function importProducts()
    {
        $this->validate([
            'bulkFile' => 'required|file|mimes:csv,xlsx',
        ]);

        try {
            Excel::import(new ProductsImport, $this->bulkFile);
            session()->flash('success', 'Products imported successfully!');
        } catch (\Exception $e) {
            Log::error('Import error: ' . $e->getMessage());
            session()->flash('error', 'Failed to import products: ' . $e->getMessage());
        }

        return $this->redirect('/admin/products', navigate: true);
    }



    /**
     * Update the specified resource in storage.
     */

    //update product
    public function update()
    {
        $product = \App\Models\Products::findOrFail($this->product_id);

        $this->validate([
            'name' => 'required|string|max:100',
            'images' => 'required|array|min:1',
            'images.*' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'brand' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'category' => 'nullable|exists:categories,id',
            'stock' => 'nullable|integer|min:0',
            'subcategory_ids' => 'nullable|array|exists:subcategories,id',
            'subcategory_ids.*' => 'nullable|exists:subcategories,id',
        ], [
            'images.required' => 'At least one image is required.',
            'images.*.mimes' => 'Only jpeg, jpg, png, and webp images are allowed.',
            'images.*.max' => 'Each image may not be greater than 2 MB.',
        ]);

        $product->name = $this->name;
        $product->price = $this->price;
        $product->description = $this->description;
        $product->brand = $this->brand;
        $product->color = implode(',', array_map('trim', explode(',', $this->color)));
        $product->size = implode(',', array_map('trim', explode(',', $this->size)));
        $product->category_id = $this->category;
        $product->stock = $this->stock;


        if ($this->images) {
            // Delete old images if they exist
            if ($product->image) {
                $oldImages = json_decode($product->image);

                foreach ($oldImages as $oldImage) {
                    if (Storage::exists('public/' . $oldImage)) {
                        Storage::delete('public/' . $oldImage);
                    }
                }
            }

            $imagePaths = [];
            $images = $this->images;
            foreach ($images as $index => $image) {
                $imageName = Str::slug($this->name) . '-' . ($index + 1) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('products', $imageName, 'public');
                $imagePaths[] = $imagePath;
            }
            $product->image = json_encode($imagePaths);
        }


        $slug = Str::slug($product->name);
        $existProdCount = \App\Models\Products::where('slug', $slug)->count();
        if ($existProdCount > 0) {
            $slug .= '-' . ($existProdCount + 1);
        }
        $product->slug = $slug;
        $product->save();
        $product->subcategories()->sync($this->subcategory_ids);
        session()->flash('success', 'Product updated successfully.');
        return $this->redirect('/admin/products', navigate: true);
    }

    //trashed product
    public function delete($id)
    {
        $product = \App\Models\Products::findOrFail($id);
        $product->delete();
        session()->flash('success', 'Product Trashed successfully.');
        return $this->redirect('/admin/products', navigate: true);
    }

    //fetch all products yajra datatable
    public function products()
    {
        $products = \App\Models\Products::with('category', 'subcategories');
        return DataTables::of($products)
            ->addColumn('image', function ($product) {
                $images = $product->image ? json_decode($product->image) : [];
                $firstImage = !empty($images) ? $images[0] : 'products/default.png';
                return '<img src="' . asset('storage/' . $firstImage) . '" class="product-image" style="width: 100px; height: auto; object-fit: cover;">';
            })
            ->addColumn('name', function ($product) {
                return Str::words($product->name, 12);
            })
            ->addColumn('description', function ($product) {
                return Str::words($product->description, 12) .
                    ' <button class="btn btn-light btn-sm view-description" data-description="' .
                    htmlspecialchars($product->description) . '"><i class="bi bi-box-arrow-up-right"></i></button>';
            })
            ->addcolumn('price', function ($product) {
                return '₹' . number_format($product->price, 2);
            })
            ->addColumn('category', function ($product) {
                return $product->category->name ?? '';
            })
            ->addColumn('subcategories', function ($product) {
                return $product->subcategories->map(function ($subcategory) {
                    return '<span class="badge bg-secondary">' . $subcategory->subcategory . '</span>';
                })->implode(' ');
            })
            ->addColumn('status', function ($product) {
                return '
                    <div class="form-check form-switch">
                        <input
                            class="form-check-input toggle-status"
                            type="checkbox"
                            wire:click="changeStatus(' . $product->id . ')"
                            ' . ($product->is_active == 0 ? 'checked' : '') . '
                            role="switch">
                        <label class="form-check-label text-muted">
                            ' . ($product->is_active == 0 ? 'Enabled' : 'Disabled') . '
                        </label>
                    </div>';
            })
            ->addColumn('created_by', function ($product) {
                return $product->admin->name ?? '';
            })
            ->addColumn('actions', function ($product) {
                return '
                <a href="' . route('products.show', $product->slug) . '" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>
                <a href="' . route('products.edit', ['view' => 'edit-product', 'product_id' => $product->id]) . '" wire:navigate class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                <form wire:submit="delete(' . $product->id . ')" wire:confirm="Are you sure you want to delete this product?"  method="post" class="d-inline delete-form">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                </form>
            ';
            })
            ->rawColumns(['image', 'description', 'subcategories', 'status', 'actions'])
            ->make(true);
    }

    public function changeStatus($id)
    {
        $product = \App\Models\Products::findOrFail($id);
        $product->is_active = $product->is_active == 0 ? 1 : 0;
        $product->save();
        session()->flash('message', 'Product status updated successfully.');
        return $this->redirect('/admin/products', navigate: true);
    }

    public function restore($id)
    {
        $product = \App\Models\Products::withTrashed()->findOrFail($id);
        $product->restore();
        session()->flash('success', 'Product Restored successfully.');
        return $this->redirect('/admin/products', navigate: true);
    }

    public function force_delete($id)
    {
        $product = \App\Models\Products::withTrashed()->findOrFail($id);
        if ($product->image) {
            $images = json_decode($product->image);
            foreach ($images as $image) {
                Storage::delete('public/' . $image);
            }
        }
        $product->forceDelete();
        session()->flash('success', 'Product Deleted successfully.');
        return $this->redirect('/admin/products', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.' . $this->view)->layout('components.layouts.adminapp');
    }
}

// return '
//                     <div class="form-check form-switch">
//                         <input class="form-check-input toggle-status"
//                                type="checkbox"
//                                role="switch"
//                                data-id="' . $product->id . '"
//                                ' . ($product->is_active == 0 ? 'checked' : '') . '>
//                         <label class="form-check-label text-muted">' . ($product->is_active == 0 ? 'Enabled' : 'Disabled') . '</label>
//                     </div>';


// #[On('setSubcategory')]
// public function setSubcategory($subcat_id)
// {
//     $subcategory = Subcategories::findOrFail($subcat_id);
//     $this->subcategory = $subcategory->subcategory;
//     $this->subcategory_id = $subcategory->id;
//     $this->dispatch('openeditmodel');
// }

// //update subcategory
// public function update_subcat()
// {
//     $subcategory = Subcategories::findOrFail($this->subcategory_id);
//     $this->validate([
//         'subcategory' => 'required|string|max:100',
//     ]);

//     $slug = Str::slug($this->subcategory);
//     if ($subcategory->slug !== $slug) {
//         $count = Subcategories::where('slug', $slug)->count();
//         if ($count > 0) {
//             $slug = $slug . '-' . ($count + 1);
//         }
//     }

//     $subcategory->update([
//         'subcategory' => $this->subcategory,
//         'slug' => $slug,
//     ]);
//     $this->dispatch('closeeditmodel');
//     session()->flash('success', 'Sub Category updated successfully.');
//     return $this->redirect('/admin/categories', navigate: true);
// }

// //sub category delete
// public function subdelete()
// {
//     $subcategory = Subcategories::findOrFail($this->subcategory_id);
//     $subcategory->delete();
//     session()->flash('success', 'Sub Category deleted successfully.');
//     return $this->redirect('categories', navigate: true);
// }

//    if (request()->routeIs('products.create')) {
//         $categories = Categories::all();
//         $subcategories = Subcategories::all();
//         return view('livewire.admin.create_product', compact('categories', 'subcategories'))->layout('components.layouts.adminapp');
//     }
