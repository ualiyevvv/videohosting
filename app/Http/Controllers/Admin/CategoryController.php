<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //dd($_SERVER);
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cat_name' => 'required'
        ]);
        $category = new Category;
        $category->cat_name = $request->cat_name;

        $category->save();
        return redirect()->route('admin.categories')->with('success', 'Категория добавлена');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if(!$category){
            return  redirect()->route('admin.categories')->withErrors('Вы куда-то не туда');
        }
        return view('admin.categoryedit', compact('category'));
        /*if($category->author_id !== \Auth::user()->id){
            return  redirect()->route('post.index')->withErrors('Вы не можете редактировать данный пост');
        }*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cat_name' => 'required'
        ]);
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('admin.categories')->with('success', 'Категория обновлена');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category){
            return  redirect()->route('admin.categories')->withErrors('Вы куда-то не туда');
        }
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Категория удалена');
        //
    }
}
