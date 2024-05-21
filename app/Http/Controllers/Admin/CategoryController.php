<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequests;
use App\Http\Requests\Category\UpdateRequests;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        // return $categories;

        return view("Admin.Categrory.list", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("Admin.Categrory.add", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequests $request)
    {
        // dd($request->all());
        try {
            Category::create($request->all());
            return redirect()->route("category.index")->with("success", "Thêm danh mục thành công");
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with("error", 'Thêm mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('Admin.Categrory.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequests $request, Category $category)
    {
        try {
            $category->update($request->all());
            return redirect()->route("category.index")->with("success", "Cập nhật  danh mục thành công");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("error", 'Cập nhật danh mục thất bại ar thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route("category.index")->with("success", "Xóa thành công");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", 'Xóa thất bại');
        }
    }


    public function trash()
    {
        $categories = Category::onlyTrashed()->get();
        // dd($categories);
        return view('Admin.Categrory.trash', compact('categories'));
    }

    public function restore($id)
    {
        Category::withTrashed()->where('id', $id)->restore();
        return redirect()->route('category.index')->with('success', 'Khôi phục thành công ');
    }
    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete();
        return redirect()->route('category.trash')->with('success', 'Xóa thành công');
    }
}
