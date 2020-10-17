<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
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
        return view('admin.categories.CategoriesManagment', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
    {
        // $users = User::where('roles_id', '=', '5')->get();
        // $sports = Sport::where('type', '=', 'جماعيه')->get();
        return view('admin.categories.createCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
           
        ], [
            'name.required' => 'من فضلك ادخل اسم القسم',
          
        ], [

        ]);

        Category::create([
            'name' => $request->name,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
            'admin_id' => $request->admin_id,

        ]);


        session()->flash('message', 'تم اضافة الفريق');
        return redirect('admin/Categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $category = Category::find($id);
    
        return view('admin.categories.editCategory', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
   
        ], [
            'name.required' => 'من فضلك ادخل اسم القسم',
            
        ], [

        ]);

       $category = Category::find($id);


        $category->name = $request->name;
     
        $category->status = $request->status;
      
        $category->save();
        session()->flash('message', 'تم تعديل البيانات بنجاح');
        return redirect('admin/Categories');
    }
      public function active($id)
    {
       $category = Category::find($id);
        $category->status = 0;
        $category->save();

        session()->flash('message', 'تم الغاء تفعيل  القسم ');
        return back();
    }

    public function unactive($id)
    {
       $category = Category::find($id);
       $category->status = 1;
       $category->save();

        session()->flash('message', 'تم تفعيل القسم بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
       public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        session()->flash('message', 'تم حذف بيانات القسم بنجاح');
        return back();
    }
}
