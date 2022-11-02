<?php

namespace Ignite\Http\Controllers;

use Illuminate\Http\Request;
use Ignite\Category;
use Ignite\Http\Request\CategoryRequest;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('assistant.categories.index',compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assistant.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try{
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('category.index')
                        ->with('registroC',"La categoria se ingreso correctamente.");
        }catch(\Exception $e){
            return redirect()->route('category.index')
                        ->with('registroCE',"Ocurrio un error al ingresar la categoría.");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('assistant.categories.show',['category'=>$category]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findorFail($id);
        return view('assistant.categories.edit',['category'=>$category]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);
            $status = $category->update($request->only('name', 'description'));

            DB::commit();
        } catch(\Throwable $e) {
            DB::rollback();
            $status = false;
        }

        if($status) {
            return redirect()->route('category.index')->with('modificarC',"La categoria fue modificada con éxito");
        } else {
            return redirect()->route('category.edit',$id)->with('modificarCE',"Ocurrio un error al modificar");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            if(Category::find($id)->delete()){
                return 1;
            }else{
                return 0;
            }
        }catch(\Exception $e){
            return 0;
        }
    }
}
