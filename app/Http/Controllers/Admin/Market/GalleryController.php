<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Gallery;

class GalleryController extends Controller
{
    public function index(Product $product)
    {

        return view('admin.market.product.gallery.index', compact('product'));
    }


    public function create(Product $product)
    {

        return view('admin.market.product.gallery.create', compact('product'));
    }


    public function store(Request $request, Product $product, ImageService $imageService)
    {


        $validated = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,gif',
        ]);
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-gallery');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.market.gallery.index', $product->id)->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
        }
        Gallery::create([
            'image' => $result,
            'product_id' => $product->id
        ]);

        return redirect()->route('admin.market.gallery.index', $product->id)->with('swal-success', 'عکس شما با موفقیت ثبت شد');
    }



    public function destroy(Product $product,Gallery $gallery)
    {
        $result = $gallery->delete();
        return redirect()->route('admin.market.gallery.index', $product->id)->with('swal-success', 'عکس شما با موفقیت حذف شد');
    }
}
