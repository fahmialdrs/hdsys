<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Log;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $category = Category::paginate(15);
        return view('category.create')->with('data',$category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $category = new Category;
        $input = $request->all();

        $category->fill($input)->save();

        Log::info('Create Category #.'.$category->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$category->toArray()
        ]);

        return redirect()->back()->withSucces("<strong>Success</strong> Create New Category");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $categories = Category::paginate(15);
        $category = Category::findOrFail($id);
        return view('category.edit')->with(['datas' => $categories, 'data' => $category ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $input = $request->all();
        $temp = $category;
        $category->fill($input)->save();
        Log::info('Update Category #.'.$category->id.' Stack trace:',[
            'from'=>$temp->toArray(),
            'to'=>$category->toArray()
        ]);
        return redirect()->back()->withSucces("<strong>Success</strong> Edit Category #".$category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        Log::info('Delete Category #.'.$category->id.' Stack trace:',[
            //'from'=>$temp->toArray(),
            'to'=>$category->toArray()
        ]);

        return redirect()->route('category::add')->withSucces("<strong>Success Delete</strong> Category");
    }
}
