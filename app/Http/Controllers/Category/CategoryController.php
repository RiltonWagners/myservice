<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'  => 'required|max:255|min:5|unique:categories'
            ],
            [
                'name.required' => 'O campo \'Nome\' é de preenchimento obrigatório.',
                'name.unique'   => 'Já existe uma categoria com o nome \''. $request->name  .'\'.'
            ]
        );

        $category = new Category;   
        
        $category->name = $request->name;

        $category->save();

        return redirect(route('category.index'))->with('message', 'Categoria adicionada com sucesso!');
    }

    public function show(Category $category)
    {
        //
    }


    public function edit(Request $request)
    {
        $category = Category::findOrFail($request->id);

        return view('categories.create', ['category' => $category]);

    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'name'  => 'required|max:255|min:5|unique:categories'
            ],
            [
                'name.required' => 'O campo \'Nome\' é de preenchimento obrigatório.',
                'name.unique'   => 'Já existe uma categoria com o nome \''. $request->name  .'\'.'
            ]
        );

        $category = Category::find($request->id);        
        $category->name = $request->name;
        $category->save();

        return redirect(route('category.index'))->with('message', 'Categoria editada com sucesso!');
    }

    public function destroy(Request $request)
    {
        Category::findOrFail($request->id)->delete();

        return redirect(route('category.index'))->with('message', 'Categoria excluída com sucesso!');
    }
}
