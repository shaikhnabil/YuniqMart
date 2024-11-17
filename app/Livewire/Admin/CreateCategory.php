<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
class CreateCategory extends Component
{
    use WithFileUploads;
    public $name;
    public $image;
    public function store()
    {
        dd($this->image);
        $this->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'image' => 'nullable|mimes:jpg,png,jpeg,webp|max:2048',
        ]);
        $name = $this->name;
        $slug = Str::slug($name);

        $count = Categories::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $imagePath = '';
        if ($this->image) {
            $image = $this->image;
            $imageName = Str::slug($name) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('categories', $imageName, 'public');
        }

        \App\Models\Categories::create([
            'name' => $name,
            'slug' => $slug,
            'image' => $imagePath,
        ]);
        session()->flash('success', 'Category Added successfully.');
        return $this->redirect('/admin/categories', navigate:true);
    }

    public function render()
    {
        $categories = \App\Models\Categories::with('subcategories')->latest()->get();
        return view('livewire.admin.create-category', compact('categories'))->layout('components.layouts.adminapp');
    }
}
