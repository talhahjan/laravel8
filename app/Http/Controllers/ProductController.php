<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;

use App\Http\Requests\StoreProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Thumbnail;
use App\Models\Section;
use App\Models\Brand;
use Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = Product::with('thumbnails')->paginate(20);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



        $brands = Brand::select('id', 'title')->get();
        $sections = Section::select('id', 'title')->get();
        $sizes=config('services.sizes');
        $colors=config('services.colors');
        return view('admin.product.create', compact('brands', 'sections','sizes','colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // make stock by sizes jsone data 
        $stocks=str_replace("}", "", $request->stock);
        $stocks=str_replace("{", "", $stocks);
        $stocks=explode(',', $stocks);

    //    dd($request->slug);

       
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'price' => 'required|numeric',
           'discount_price' => 'required|numeric',
           'discount' => 'numeric',
            'product_color' => 'required',
            'size_range' => 'required',
            'stock' => 'required',
           'categories'=>'required'
        ]);




        //   dd($request->size_range);
        // creates an array of selected Ids f categories
        $product = Product::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'options' => isset($request->extras) ? json_encode($request->extras) : null,
            'brand_id' => $request->brand_id,
            'featured' => isset($request->featured) ? 1 : 0,
            'price' => $request->price,
            'discount_price'=>$request->discount_price,
            'discount'=>isset($request->discount) ? 1: 0,
            'color' => $request->product_color,
            'stock' => json_encode($stocks),
            'size_range' =>$request->size_range,
        ]);
 

        // attach categories in pivot table 
        $product->categories()->attach($request->categories);

        if (isset($request->thumbnails)) {
            foreach ($request->thumbnails as $thumbnail) {
                $extension = "." . $thumbnail->getClientOriginalExtension();
                $name = basename($thumbnail->getClientOriginalName(), $extension) . time();
                $name = $name . $extension;
                $path = $thumbnail->storeAs('products/thumbnails', $name, 'local');
                $thumb = Thumbnail::create([
                    'path' => 'uploads/' . $path,
                    'product_id' => $product->id,
                ]);
            }

            if ($product) {
                return back()->with('message', 'Product has been added successfully');
            } else {
                return back()->with('error', 'Error adding product');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $products = Product::with('thumbnails')->paginate(20);
        $brands = Brand::select('id', 'title')->get();
        $categories = Category::select('id', 'title')->where('parent_id', 0)->get();
        $sizes=config('services.sizes');
        $colors=config('services.colors');
return view('user.products.all', compact('products','brands','categories','sizes','colors'));
    }    
/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */


public function single(Product $product){
    $brands = Brand::select('id', 'title')->get();
    $categories = Section::select('id', 'title')->where('status', 1)->get();
    return view('user.products.single', compact('product','categories','brands'));
}


     public function edit(Product $product)
    {
     
        $brands = Brand::select('id', 'title')->get();
        $sections = Section::select('id', 'title')->where('status', 1)->get();
        $sizes=config('services.sizes');
        $colors=config('services.colors');
        $options = json_decode($product->options);
        $ids=($product->categories->count() > 0)  ? Arr::pluck($product->categories->toArray(), 'id') : null;
        return view('admin.product.edit', 
        compact('product', 'brands', 'sizes', 'colors', 'options','sections','ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'price' => 'required|numeric',
            'discount_price' => 'numeric',
            'discount' => 'numeric',
            'product_color' => 'required',
            'size_range' => 'required',
            'stock' => 'required',
           'categories'=>'required'

        ]);
        
        // make stock by sizes jsone data 
        $stocks=str_replace("}", "", $request->stock);
        $stocks=str_replace("{", "", $stocks);
        $stocks=explode(',', $stocks);

        if (isset($request->thumbnails)) {
            foreach ($request->thumbnails as $thumbnail) {
                $extension = "." . $thumbnail->getClientOriginalExtension();
                $name = basename($thumbnail->getClientOriginalName(), $extension) . time();
                $name = $name . $extension;
                $path = $thumbnail->storeAs('products/thumbnails', $name, 'local');
                $thumb = Thumbnail::create([
                    'path' => 'uploads/' . $path,
                    'product_id' => $product->id,
                ]);
            }
        }
            $updateProduct = Product::where("id", $product->id)->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'description' => $request->description,
                'status' => $request->status,
                'options' => isset($request->extras) ? json_encode($request->extras) : null,
                'brand_id' => $request->brand_id,
                'featured' => isset($request->featured) ? 1 : 0,
                'price' => $request->price,
                'discount_price'=>$request->discount_price,
                'discount'=>isset($request->discount) ? 1: 0,
                'color' => $request->product_color,
                'stock' => json_encode($stocks),
                'size_range' =>$request->size_range,
                //'size_range' =>str_replace('-', '_', $request->size_range),

    
            ]);

        // detach previously saved categories
        $product->categories()->detach();
       
        // attach updated categories 
         $product->categories()->attach($request->categories);

        if ($updateProduct) {
            return back()->with('message', 'Section has been updated success fully :)');
        } else {
            return back()->with('error', 'error updating Section');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $res = Product::where('id', $request->record_id)->update(['status' => $request->currentstatus == 1 ? 0 : 1]);
     
        $obj = array();
        $obj['msg'] = 'Error Updating Record';
        $obj['type'] = 'danger';

        if ($res) {

            $obj['msg'] = 'Record has been Updated successfully';
            $obj['type'] = 'success';
        }

        return $obj;
    }

    public function destroy(Request $request)
    {

$res = Product::where('id', $request->record_id)->delete();
$res2 = Thumbnail::where('product_id', $request->record_id)->delete();
        $obj = array();
        $obj['msg'] = 'Error deleting Record';
        $obj['type'] = 'danger';

        if ($res && $res2) {
            $obj['msg'] = 'Record has been deleted successfully';
            $obj['type'] = 'success';
        }
        return $obj;
    }

    


}
