<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Category;

use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_list = Category:: where('created_by', Auth::id())->get();
        return view("categories.index" , compact('category_list'));
    }

    public function list()
    {
        // $model = Category::where('created_by', Auth::id());

        // return DataTables::eloquent($model)
        //             ->addIndexColumn()
        //             ->toJson();
        return DataTables::of(Category::where('created_by', Auth::id()))
            ->addIndexColumn()
            ->addColumn('action', function ($c) {
                return view("categories.action",compact("c"));
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
      $category = new Category();
      $category->name = $request->name;
      $category->created_by = Auth::id();
      $category->save();

      return redirect("/categories");
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
        $cat = Category::where('created_by', Auth::id())->find($id);
        if ($cat) {
            return view("categories.edit", compact("cat"));
        }
        return redirect()->back();
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
        $cat = Category::where('created_by', Auth::id())->find($id);
        if ($cat) {
            $cat->name = $request->name;
            $cat->save();
        }
        return redirect("/categories");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::where('created_by', Auth::id())->find($id);
        if ($cat) {
            $cat->tasks()->delete();
            $cat->delete();
        }
        return redirect("/categories");
    }
}
