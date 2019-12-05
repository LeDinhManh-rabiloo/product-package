<?php

namespace Manhle\ProductPackage\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Category;
use App\Models\CategoryLang;
use App\Models\Product;
use App\Models\ProductLang;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $table)
    {
        return $table->render('backs.pages.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::where('activate', 1)->get();
        $category = [];
        foreach ($categories as $cate) {
            $category[$cate->id] = $cate->categoryLang[0]->name;
        }
        return view('backs.pages.product.create', compact(['product', 'category']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check_img = $request->validate([
           'image_product.*' => 'required|file|max:4096'
        ]);
        $data = $request->validate([
            'cate_product_id' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'active' => 'required'
        ]);
        $data['isNew'] = 1;
        $product = Product::create($data);
        if ($request->has('image_product')) {
            foreach ($request->file('image_product') as $file_key => $image) {
                $product->addMedia($image)->toMediaCollection('product');
            }
        }
        $product->category()->attach($request->cate_product_id);
        $category_lang = ProductLang::create([
            'product_id' => $product->id,
            'id_lang' => 1,
            'name' => $request->name,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description_en,
            'short_description' => $request->short_description,
            'url_key' => $request->url_key,
            'slug' => str_slug($request->name)
        ]);
        toastr()->success("Them thanh cong san pham");
        return redirect()->route('admin.products.index');
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
        $product = Product::findOrFail($id);
        $categories = Category::where('activate', 1)->get();
        $category = [];
        foreach ($categories as $cate) {
            $category[$cate->id] = $cate->categoryLang[0]->name;
        }
        return view('backs.pages.product.edit', compact(['product', 'category']));
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
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'cate_product_id' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'active' => 'required'
        ]);
        $data['isNew'] = 1;
        $product->update($data);
        $product_lang = ProductLang::where('product_id',$id)->where('id_lang', 1)->first();
        $product_lang->update([
            'name' => $request->name,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description_en,
            'short_description' => $request->short_description,
            'url_key' => $request->url_key,
            'slug' => str_slug($request->name)
        ]);
        foreach ($request->file_delete as $delete) {
            File::deleteDirectory(storage_path('app/public/' . $delete));
            Media::findOrFail($delete)->delete();
        }
        if ($request->has('image_product')) {
            foreach ($request->file('image_product') as $file_key => $image) {
                $product->addMedia($image)->toMediaCollection('product');
            }
        }
        toastr()->success("Cap nhat thanh cong");
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
