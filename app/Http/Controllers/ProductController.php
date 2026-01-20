<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Categories;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Feefixer;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class ProductController extends Controller
{
    // public function AddCategory(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => ['required', 'string', 'max:255'],
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'status' => 'required|boolean',
    //     ]);

    //     if($validator->fails()){
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $category = new Categories();
    //     $category->name = $request->input('name');
    //     $category->slug = Str::slug($request->input('name')); // ✅ generate slug
    //     $category->status = $request->input('status');

    //     // Optional: handle image upload
    //     if ($request->hasFile('image')) {
    //         $imageName = time() . '.' . $request->image->extension();
    //         $request->image->move(public_path('images/categories'), $imageName);
    //         $category->image = 'images/categories/' . $imageName;
    //     }

    //     $category->save();

    //     return redirect('/brand-admin')->with('status', 'Category added successfully!');
    // }

    // public function ShowCategories()
    // {

    //     $categories = Categories::all();
    //     return view('Admin.Productlisting', compact('categories'));

    // }


    // ----------------------------------
    // ----------------------------------



    public function AddCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = new Categories();
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name')); // ✅ generate slug
        $category->status = $request->input('status');

        // Save image if uploaded
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images/categories'), $imageName);
            $category->image = 'images/categories/'.$imageName;
        }

        $category->save();

        return redirect('/brand-admin')->with('status', 'Category added successfully!');
    }

    // Fetch active categories for frontend
    public function ShowCategories()
    {
        $categories = Categories::where('status', 1)->get(); // only active
        return view('Admin.Productlisting', compact('categories'));
    }

    // Optional: Show products for a category
    public function CategoryProducts($slug)
    {
        $category = Categories::where('slug', $slug)->firstOrFail();
        $products = $category->products()->where('status', 1)->get(); // if you have products relation
        return view('frontend.category-products', compact('category', 'products'));
    }



    // ----------------------------------
    // ----------------------------------




    public function ListProduct(Request $request)
    {
        
        $request->validate([
            'productname' => 'required|string',
            'productdescription' => 'required|string',
            'stockquantity' => 'string',
            'totalprice' => 'required|string',
            'costprice' => 'string',
            'discount' => 'string',
            'category' => 'string',
            'size' => 'string',
            'tags' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'preview_image1' => 'mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'preview_image2' => 'mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'preview_image3' => 'mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        try{

            $feefixer = Feefixer::first();
            if($feefixer){
                $tax_price = $feefixer->tax_price;
                $shipping_cost = $feefixer->shipping_cost;
            }
            else{
                $tax_price = 0;
                $shipping_cost = 0;
            }

            $product = new Product;
            $product->productname = $request->input('productname');
            $product->productdescription = $request->input('productdescription');
            $product->stockquantity = $request->input('stockquantity');
            $product->totalprice = $request->input('totalprice');
            $product->costprice = $request->input('costprice');
            $product->discount = $request->input('discount');
            $product->category = $request->input('category');
            $product->size = $request->input('size');
            $product->tags = $request->input('tags');
            $product->status = $request->input('status');
            $product->tax_price = $tax_price; 
            $product->shipping_cost = $shipping_cost;
            
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('ProductImages', 'public');
                $product->image = $imagePath;
                // $imageUrl = Storage::url($imagePath);
            }
            if ($request->hasFile('preview_image1')) {
                $imagePath = $request->file('preview_image1')->store('ProductImages', 'public');
                $product->preview_image1 = $imagePath;
            }
            if ($request->hasFile('preview_image2')) {
                $imagePath = $request->file('preview_image2')->store('ProductImages', 'public');
                $product->preview_image2 = $imagePath;
            }
            if ($request->hasFile('preview_image3')) {
                $imagePath = $request->file('preview_image3')->store('ProductImages', 'public');
                $product->preview_image3 = $imagePath;
            }       

            $product->save();
        }
        catch (\Exception $e) {
            dd($e->getMessage()); 
        }

        return redirect('/brand-admin')->with('success', 'Product added successfully');
    }

    public function updateProduct(Request $request, $id){
        $request->validate([
            'productname' => 'required|string',
            'productdescription' => 'required|string',
            'stockquantity' => 'string',
            'totalprice' => 'required|string',
            'costprice' => 'string',
            'discount' => 'string',
            'category' => 'string',
            'size' => 'string',
            'tags' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'preview_image1' => 'mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'preview_image2' => 'mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'preview_image3' => 'mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        try {

        $feefixer = Feefixer::first();
        if($feefixer){
            $tax_price = $feefixer->tax_price;
            $shipping_cost = $feefixer->shipping_cost;
        }
        else{
            $tax_price = 0;
            $shipping_cost = 0;
        }
        
        $update_product = Product::FindOrFail($id);
        $update_product->productname = $request->input('productname');
        $update_product->productdescription = $request->input('productdescription');
        $update_product->stockquantity = $request->input('stockquantity');
        $update_product->totalprice = $request->input('totalprice');
        $update_product->costprice = $request->input('costprice');
        $update_product->discount = $request->input('discount');
        $update_product->category = $request->input('category');
        $update_product->size = $request->input('size');
        $update_product->tags = $request->input('tags');
        $update_product->status = $request->input('status');
        $update_product->tax_price = $tax_price; 
        $update_product->shipping_cost = $shipping_cost;
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ProductImages', 'public');
            $update_product->image = $imagePath;
            // $imageUrl = Storage::url($imagePath);
        }
        if ($request->hasFile('preview_image1')) {
            $imagePath = $request->file('preview_image1')->store('ProductImages', 'public');
            $update_product->preview_image1 = $imagePath;
        }
        if ($request->hasFile('preview_image2')) {
            $imagePath = $request->file('preview_image2')->store('ProductImages', 'public');
            $update_product->preview_image2 = $imagePath;
        }
        if ($request->hasFile('preview_image3')) {
            $imagePath = $request->file('preview_image3')->store('ProductImages', 'public');
            $update_product->preview_image3 = $imagePath;
        }
        $update_product->save();
    }
        catch (\Exception $e) {
            dd($e->getMessage()); 
        }

        return redirect()->back()->with('success', 'Product added successfully');      
    }


    public function ShowProducts()
    {
        $setting = WebsiteSetting::first();
        $featuredProducts = Product::where('category', 'Featured')
            ->where('status', 'active')
            ->get();
        
        $categories = Categories::where('status', 1)->get();
        
        return view('Pages.Index', [
            'products' => $featuredProducts,
            'categories' => $categories,
            'setting' => $setting
        ]);
    }

    // public function showCategoryProducts($category)
    // {
    //     $products = Product::where('category', $category)
    //                       ->where('status', 'active')
    //                       ->get();

    //     $categories = Categories::where('status', 1)->get();
        
    //     return view('Pages.Category', compact('products', 'category', 'categories'));
    // }

    public function showCategoryProducts($category)
    {
        $categoryObj = Categories::where('slug', $category)->first();

        if (!$categoryObj) {
            abort(404, 'Category not found');
        }

        $products = Product::where('category', $categoryObj->name)
                            ->where('status', 'active')
                            ->get();

        $categories = Categories::where('status', 1)->get();

        return view('Pages.Category', [
            'products' => $products,
            'category' => $categoryObj->name,
            'categories' => $categories
        ]);
    }

    
    public function showProductDetail($id)
    {
        $product = Product::findOrFail($id);
        
        $relatedProducts = Product::where('category', $product->category)
                                 ->where('id', '!=', $id)
                                 ->where('status', 'active')
                                 ->limit(4)
                                 ->get();
        
        return view('Pages.shopdetail', [
            'products' => $product, 
            'relatedProducts' => $relatedProducts
        ]);
    }

    public function ShowAllProductstoAdmin()
    {

        $all_products = Product::all();
        return view('Admin.AllProducts', compact('all_products'));
    }

    public function ShowAllCategoriestoAdmin()
    {

        $all_categories = Categories::all();
        return view('Admin.AllCategories', compact('all_categories'));
    }
    
    public function ShowMostOrderItemstoAdmin()
    {               

        $most_order_items = OrderItem::all();
        return view('Admin.MostOrderItems', compact('most_order_items'));
    }

    public function EditProduct($id)
    {
        $products = Product::findOrFail($id);
        $categories = Categories::all();
        return view('Admin.UpdateProduct', compact('products', 'categories'));
    }

    public function deleteProduct(Request $request, $id){
        $userId = session()->get('id');

        if(!$userId){
        return redirect()->route('signin')->with('error', 'Please login toperform this action!');
        }
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    public function deleteCategory(Request $request, $id){
        $userId = session()->get('id');

        if(!$userId){
            return redirect()->route('signin')->with('error', 'Please login toperform this action!');
        }
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    public function deleteFeeFixer(Request $request, $id){
        $userId = session()->get('id');

        if(!$userId){
            return redirect()->route('signin')->with('error', 'Please login toperform this action!');
        }
        $feefixer = FeeFixer::findOrFail($id);
        $feefixer->delete();

        return redirect()->back()->with('success', 'Fee deleted successfully.');
    }

    public function liveSearch(Request $request)
    {
        $search = trim($request->query('query'));

        if (empty($search)) {
            return response()->json([]);
        }

        $products = Product::where('status', 'active')
            ->where(function ($query) use ($search) {
                $query->where('productname', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('tags', 'like', "%{$search}%")
                    ->orWhere('totalprice', 'like', "%{$search}%");
            })
            ->select('id', 'productname', 'image', 'tags', 'totalprice')
            ->limit(10)
            ->get();


        return response()->json($products);
    }


}
