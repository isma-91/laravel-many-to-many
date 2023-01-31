<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation, metodo "esteso"
        $request->validate([
            'slug'          => 'required|string|max:100|unique:categories',
            'name'          => 'required|string|max:100',
            'description'   => 'nullable|string',
        ]);


        $data = $request->all();
        //create and save
        $category = new Category;
        $category->slug        = $data['slug'];
        $category->name        = $data['name'];
        $category->description = $data['description'];
        $category->save();

        //redirect
        return redirect()->route('admin.categories.show', [
            'category' => $category,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $posts = $category->posts()->paginate(5);

        return view('admin.categories.show', [
            'category' => $category,
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //validation, metodo "esteso"
        $request->validate([
            'slug'          =>
            [
                'required',
                'string',
                'max:100',
                Rule::unique('categories')->ignore($category),
            ],
            'name'          => 'required|string|max:100',
            'description'   => 'nullable|string',
        ]);


        $data = $request->all();
        //update
        $category->slug        = $data['slug'];
        $category->name        = $data['name'];
        $category->description = $data['description'];
        $category->update();

        //redirect
        return redirect()->route('admin.categories.show', [
            'category' => $category,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //impostare una categoria di default da poter dare a tutti i posts che "perdono" la categoria perchè viene cancellata
        $defaultCategory = Category::where('slug', 'nessuna-categoria')->first();
        //Facciamo un ciclo su tutti i post collegati ad una categoria, per ciascun post si va a cambiare la category. Impostando ad ogni post la defaultCategory che abbiamo creato prima con il suo id.
        foreach ($category->posts as $post) {
            $post->category_id = $defaultCategory->id;
            $post->update();
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success_delete', $category);
    }
}
