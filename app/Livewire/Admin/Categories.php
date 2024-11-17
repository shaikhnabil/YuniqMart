<?php

namespace App\Livewire\Admin;

use App\Models\Subcategories;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Categories extends Component
{
    use WithFileUploads;
    public $name;
    public $image;
    public $view = 'categories';
    public $id, $subcategory_id;
    public $category, $category_id, $subcategory = "";
    public function mount()
    {
        if ($this->id) {
            $this->category = \App\Models\Categories::findOrFail($this->id);
            $this->name = $this->category->name;
            // $this->image = $this->category->image;
        }
    }

    #[On('setSubcategory')]
    public function setSubcategory($subcat_id)
    {
        $subcategory = Subcategories::findOrFail($subcat_id);
        $this->subcategory = $subcategory->subcategory;
        $this->subcategory_id = $subcategory->id;
        $this->dispatch('openeditmodel');
    }

    //update subcategory
    public function update_subcat()
    {
        $subcategory = Subcategories::findOrFail($this->subcategory_id);
        $this->validate([
            'subcategory' => 'required|string|max:100',
        ]);

        $slug = Str::slug($this->subcategory);
        if ($subcategory->slug !== $slug) {
            $count = Subcategories::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
        }

        $subcategory->update([
            'subcategory' => $this->subcategory,
            'slug' => $slug,
        ]);
        $this->dispatch('closeeditmodel');
        session()->flash('success', 'Sub Category updated successfully.');
        return $this->redirect('/admin/categories', navigate: true);
    }

    //sub category delete
    public function subdelete()
    {
        $subcategory = Subcategories::findOrFail($this->subcategory_id);
        $subcategory->delete();
        session()->flash('success', 'Sub Category deleted successfully.');
        return $this->redirect('categories', navigate: true);
    }

    //save subcategory
    public function subcat_save()
    {
        $this->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory' => [
                'required',
                'string',
                'max:100',
                Rule::unique('subcategories')->where(function ($query) {
                    return $query->where('category_id', $this->category_id);
                }),
            ],
        ]);


        $slug = Str::slug($this->subcategory);

        $originalSlug = $slug;
        $count = 1;

        while (Subcategories::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        Subcategories::create([
            'subcategory' => $this->subcategory,
            'slug' => $slug,
            'category_id' => $this->category_id,
        ]);
        session()->flash('success', 'Child Category Added successfully.');
        return $this->redirect('/admin/categories', navigate: true);
    }

    //update category
    public function update($id)
    {
        $category = \App\Models\Categories::findOrFail($id);

        $this->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'image' => 'nullable|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $name = $this->name;
        $slug = Str::slug($name);

        if ($category->slug !== $slug) {
            $count = \App\Models\Categories::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
        }

        // Handle image upload
        $imagePath = $category->image;
        if ($this->image) {
            // Delete old image if it exists
            if ($category->image && file_exists(public_path('storage/' . $category->image))) {
                unlink(public_path('storage/' . $category->image));
            }

            // Store new image file
            $imageName = Str::slug($name) . '-' . time() . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('categories', $imageName, 'public');

            if (!$imagePath) {
                session()->flash('error', 'Image upload failed.');
                return;
            }
        }

        // Update the category
        $category->update([
            'name' => $name,
            'slug' => $slug,
            'image' => $imagePath,
        ]);

        session()->flash('success', 'Category updated successfully.');
        return $this->redirect('/admin/categories', navigate: true);
    }

    //delete category
    public function delete($id)
    {
        $category = \App\Models\Categories::find($id);
        $category->delete();
        session()->flash('success', 'Category Deleted successfully.');
        return $this->redirect('categories', navigate: true);
    }

    //store category
    public function store()
    {

        $this->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'image' => 'nullable|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $name = $this->name;
        $slug = Str::slug($name);

        $count = \App\Models\Categories::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $imagePath = '';
        if ($this->image) {
            $imageName = Str::slug($name) . '-' . time() . '.' . $this->image->getClientOriginalExtension();

            $imagePath = $this->image->storeAs('categories', $imageName, 'public');


            if (!$imagePath) {
                session()->flash('error', 'Failed to upload image.');
                return;
            }
        }

        \App\Models\Categories::create([
            'name' => $name,
            'slug' => $slug,
            'image' => $imagePath,
        ]);

        session()->flash('success', 'Category added successfully.');
        return $this->redirect('/admin/categories', navigate: true);
    }

    //render view
    public function render()
    {
        $categories = \App\Models\Categories::with('subcategories')->latest()->paginate(10);
        return view('livewire.admin.' . $this->view, compact('categories'))->layout('components.layouts.adminapp');
    }
}




// #[On('setSubcategory')]
// public function setSubcategory($subcat_id)
// {
//     dd($subcat_id);
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

//     // Update the category
//     $subcategory->update([
//         'subcategory' => $this->subcategory,
//         'slug' => $slug,
//     ]);
//     $this->dispatch('closeeditmodel');
//     session()->flash('success', 'Sub Category updated successfully.');
//     return $this->redirect('/admin/categories', navigate: true);
// }

//save subcategory
// public function subcat_save()
// {
//     $this->validate([
//         'category_id' => 'required|exists:categories,id',
//         'subcategory' => 'required|string|max:100',
//     ]);


//     $slug = Str::slug($this->subcategory);

//     $count = Subcategories::where('slug', $slug)->count();
//     if ($count > 0) {
//         $slug = $slug . '-' . ($count + 1);
//     }

//     Subcategories::create([
//         'subcategory' => $this->subcategory,
//         'slug' => $slug,
//         'category_id' => $this->category_id,
//     ]);
//     session()->flash('success', 'Child Category Added successfully.');
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
