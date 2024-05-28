<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\product_variants;
use App\Models\ProductImages;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        $categories = Category::all();
        $products = Product::with('variants')->get();
        return view("Admin.Product.list", compact("products", "categories", "category"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("Admin.Product.add", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lấy tên của file hình ảnh từ request
        $fileName = $request->photo->getClientOriginalName();

        // Lưu trữ hình ảnh vào thư mục 'public/images' với tên là $fileName
        $request->photo->storeAs('public/images', $fileName);

        // Thêm tên file hình ảnh vào dữ liệu của request
        $request->merge(['image' => $fileName]);

        try {
            // Tạo một sản phẩm mới trong cơ sở dữ liệu sử dụng dữ liệu từ request
            $product = Product::create($request->only("name", "slug", "image", "category_id", "description", "status"));

            // Duyệt qua mảng các biến thể của sản phẩm từ request và tạo mới các biến thể trong cơ sở dữ liệu
            foreach ($request->variants as $variantData) {
                $variant = [
                    'size' => $variantData['size'],
                    'price' => $variantData['price'],
                    'sale_price' => $variantData['sale_price'],
                ];
                $product->variants()->create($variant);
            }

            // Chuyển hướng người dùng về trang danh sách sản phẩm và hiển thị thông báo thành công
            return redirect()->route('product.index')->with('success', 'Thêm mới sản phẩm thành công');
        } catch (\Throwable $th) {
            // Nếu có lỗi xảy ra trong quá trình xử lý, hiển thị thông báo lỗi và quay trở lại trang trước đó
            dd($th->getMessage());
            return back()->with('error', 'Đã xảy ra lỗi: ' . $th->getMessage());
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
    public function edit(Product $product)
    {
        $categories = Category::all(); //Lất tất cả danh mục
        // $ProductImages = ProductImages::where('product_id', $product->id)->get(); // Lấy tất cả ImgProduct của sản phẩm
        //Lấy tất cả ảnh của id đó
        // $products = Product::all();
        //Lấy sản phẩm
        return view('Admin.Product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        try {
            //Cập nhật thông tin sản phẩm từ dữ liệu được gửi từ form
            $product->update($request->all());
            //Nếu có ảnh thì sử lý
            if ($request->hasFile('photo')) {
                // Xóa ảnh cũ nếu tồn tại
                if ($product->image) {
                    Storage::delete('public/images/' . $product->image);
                }
                $fileName = $request->photo->getClientOriginalName();
                $request->photo->storeAs('public/images', $fileName);
                $product->image = $fileName;
                $product->save();
            }
            if ($request->hasFile('photos')) {
                foreach ($request->photos as $photo) {
                    $fileName = $photo->getClientOriginalName();
                    $photo->storeAs('public/images', $fileName);
                    ProductImages::create([
                        'product_id' => $product->id,
                        'image' => $fileName,
                    ]);
                }
            }
            return redirect()->route("product.index")->with("success", "Cập nhật sản phẩm thành công");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Cập nhật sản phẩm thất bại");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $ProductImages = ProductImages::where('product_id', $product->id)->delete();
        // dd($ProductImages);
        try {
            $product->delete();
            return redirect()->route("product.index")->with("success", "Xoá sản phẩm thành công");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Xóa sản phẩm thất bại");
        }
    }
    // public function destroy(Product $product)
    // {
    //     try {
    //         // Lấy tất cả các ảnh liên quan đến sản phẩm
    //         $images = ProductImages::where('product_id', $product->id)->get();
    //         dd($images);
    //         // Xóa tất cả các ảnh từ storage
    //         foreach ($images as $image) {
    //             Storage::delete('public/images/' . $image->image);
    //         }

    //         // Xóa các bản ghi ảnh từ cơ sở dữ liệu
    //         ProductImages::where('product_id', $product->id)->delete();

    //         // Kiểm tra xem tất cả các ảnh đã được xóa thành công
    //         $remainingImages = ProductImages::where('product_id', $product->id)->count();
    //         if ($remainingImages === 0) {
    //             // Nếu không còn ảnh nào liên quan, xóa sản phẩm
    //             $product->delete();
    //             return redirect()->route("product.index")->with("success", "Xoá sản phẩm thành công");
    //         } else {
    //             // Nếu còn ảnh liên quan, hiển thị thông báo lỗi
    //             return redirect()->back()->with("error", "Xóa sản phẩm thất bại: Không thể xóa tất cả các ảnh liên quan");
    //         }
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with("error", "Xóa sản phẩm thất bại: " . $th->getMessage());
    //     }
    // }
    // Phương thức xóa tất cả ảnh trong storage khi xóa sản phẩm
    // public function destroyImg(ProductImages $image, Request $request)
    // {
    //     $img_name = $image->image;

    //     if ($image->delete()) {
    //         $image_path = public_path('public/images') . '/' . $img_name;
    //         if (file_exists($image_path)) {
    //             unlink($image_path);
    //         }
    //         return redirect()->back()->with("success", "Xoá anh thành công");
    //     }
    //     return redirect()->back()->with("error", "Xoá anh that bai");
    // }
    public function destroyImg(ProductImages $image, Request $request)
    {
        $img_name = $image->image;
        try {
            $image->delete();
            if ($request->hasFile('photos')) {
                foreach ($request->photos as $photo) {
                    $fileName = $photo->getClientOriginalName();
                    $photo->storeAs('public/images', $fileName);
                }
            }
            // Xóa ảnh gốc sau khi tất cả các ảnh mới đã được lưu trữ
            Storage::delete('public/images/' . $img_name);
            return redirect()->back()->with("success", "Xoá ảnh thành công");
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with("error", "Xóa sản phẩm thất bại");
        }
    }



    public function trash()
    {
        $products = Product::onlyTrashed()->get();
        // dd($categories);
        return view('Admin.Product.trash', compact('products'));
    }

    public function restore($id)
    {
        try {
            Product::withTrashed()->where('id', $id)->restore();
            // Khôi phục ảnh liên quan
            ProductImages::withTrashed()->where('product_id', $id)->restore();
            return redirect()->route('product.index')->with('success', 'Khôi phục thành công');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Khôi phục thất bại');
        }
    }


    // public function forceDelete($id)
    // {
    //     $category = Product::withTrashed()->findOrFail($id);
    //     $category->forceDelete();
    //     return redirect()->route('product.index')->with('success', 'Xóa thành công');
    // }



    // public function forceDelete($id)
    // {
    //     try {
    //         // Tìm sản phẩm đã bị xóa
    //         $product = Product::withTrashed()->findOrFail($id);

    //         // Tìm và xóa tất cả các bản ghi ảnh liên quan của sản phẩm
    //         $productImages = ProductImages::where('product_id', $product->id)->get();

    //         // Kiểm tra xem có bản ghi ảnh sản phẩm nào không
    //         if ($productImages->isNotEmpty()) {
    //             foreach ($productImages as $image) {
    //                 // Xóa ảnh từ storage
    //                 Storage::delete('public/images/' . $image->image);
    //                 // Xóa bản ghi ảnh từ cơ sở dữ liệu
    //                 $image->delete();
    //             }
    //         }

    //         // Sau khi xóa hết các bản ghi ảnh liên quan, thì mới xóa sản phẩm
    //         $product->forceDelete();

    //         return redirect()->route('product.trash')->with('success', 'Xóa thành công');
    //     } catch (\Throwable $th) {
    //         // Xử lý ngoại lệ nếu cần
    //         dd($th->getMessage());
    //         return redirect()->route('product.trash')->with('error', 'Xóa thất bại');
    //     }
    // }
    // public function forceDelete($id)
    // {
    //     try {
    //         // Tìm sản phẩm đã bị xóa
    //         $product = Product::withTrashed()->findOrFail($id);

    //         // Lấy tất cả các bản ghi ảnh liên quan đến sản phẩm và xóa chúng
    //         $images = ProductImages::where('product_id', $product->id)->delete();
    //         // $images->delete();
    //         // foreach ($images as $image) {
    //         //     // Xóa ảnh từ storage
    //         //     Storage::delete('public/images/' . $image->image);
    //         //     // Xóa bản ghi ảnh từ cơ sở dữ liệu
    //         //     $image->delete();
    //         // }

    //         // Xóa sản phẩm
    //         $product->forceDelete();

    //         return redirect()->route('product.index')->with('success', 'Xóa thành công');
    //     } catch (\Throwable $th) {
    //         // Xử lý ngoại lệ nếu cần
    //         return redirect()->back()->with('error', 'Xóa thất bại: ' . $th->getMessage());
    //     }
    // }
    // public function forceDelete($id, Product $product, Request $request)
    // {
    //     $product = Product::withTrashed()->findOrFail($id);
    //     $imageProductData = [];

    //     // Duyệt qua từng hình ảnh của sản phẩm và lấy dữ liệu của mỗi hình ảnh
    //     foreach ($product->images as $image) {
    //         $imageProductData[] = [
    //             'id' => $image->id,
    //             'product_id' => $image->product_id,
    //             // Thêm các trường dữ liệu khác của hình ảnh nếu cần
    //         ];
    //     }

    //     dd($imageProductData);
    // }
    public function forceDelete(Request $request, $id, Product $product)
    {
        try {
            $product = Product::withTrashed()->findOrFail($id);
            // dd($product);
            // Lấy danh sách các đường dẫn đến hình ảnh liên quan đến sản phẩm
            $images = ProductImages::withTrashed()->where('product_id', $product->id)->get();
            $imagePro = Product::withTrashed()->get();
            // dd($imagePro);
            // Xóa tất cả các ảnh từ storage
            foreach ($images as $image) {
                Storage::delete('public/images/' . $image->image);
            }
            foreach ($imagePro as $image) {
                Storage::delete('public/images/' . $image->image);
            }

            // Xóa hẳn các hình ảnh liên quan đến sản phẩm từ cơ sở dữ liệu
            ProductImages::where('product_id', $product->id)->forceDelete();

            // Kiểm tra xem tất cả các ảnh đã được xóa thành công
            $imgCount = ProductImages::where('product_id', $product->id)->count();
            if ($imgCount === 0) {
                // Nếu không còn ảnh nào liên quan, xóa sản phẩm
                $product->forceDelete();
                return redirect()->route("product.index")->with("success", "Xoá sản phẩm và ảnh thành công");
            } else {
                // Nếu còn ảnh liên quan, hiển thị thông báo lỗi
                return redirect()->back()->with("error", "Xóa sản phẩm thất bại: Không thể xóa tất cả các ảnh liên quan");
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa sản phẩm và hình ảnh');
        }
    }
}
