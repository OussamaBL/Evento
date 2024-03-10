<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class CategoryController extends Controller
{
   
    public function index()
    {
        $categories = Category::paginate(10);
        return view('dashboard.categories.categories',compact('categories'));
    }

    
    public function create()
    {
        return view('dashboard.categories.add_category');
    }

   
    public function store(Request $request)
    {
        $form=$request->validate([
            'name'=>'required|string'
        ]);
        $category=Category::where('name',$form['name'])->first();
        if(!$category) Category::create($form);
        return redirect()->route('dashboard.categories');
    }

   
    public function show(Category $category)
    {
        
    }

    
    public function edit($id)
    {
        $category=Category::find($id);
        return view('dashboard.categories.edit_category',compact('category'));
    }

    
    public function update(Request $request,$id)
    {
        $form = $request->validate([
            'name' => 'required|string|unique:categories,name,' . $id,
        ]);
        $category=Category::find($id);
        $category->update($form);
        return redirect()->route('dashboard.categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        return redirect()->route('dashboard.categories');
    }
}
