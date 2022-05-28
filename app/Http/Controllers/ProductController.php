<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\PriceType;
use Illuminate\Support\Str;
use App\Models\ProductPrice;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $_getColumns = (['id', 'name','category_id', 'user_id','image', 'is_active']);

    public function index()
    {
     $viewBag['products']=Product::with('users','category','productPrices')->orderBy('id', 'ASC')->get($this->_getColumns);
        return view('admin.products.index', $viewBag);
    }

    public function create()
   
    {
        $viewBag['categories'] = Category::where('is_active', 1)->Orderby('id', 'DESC')->get(['id', 'name']);
        $viewBag['price_types'] = PriceType::where('is_active', 1)->Orderby('id', 'ASC')->get(['id', 'name']);

        return view('admin.products.create',$viewBag);
    }

    public function store(Request $request)
    {
    //   return $request;

        try {

            $imageName = null;

            if($request->hasFile('image')){
                $image = $request->file('image');
                $imageName = $this->_getFileName($image->getClientOriginalExtension());
                $image->move(public_path('product-images'), $imageName);
            }

            $product = new Product;
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->image = $imageName;
            $product->user_id = auth()->id();
            $product->save();

        

        // Product Price Type Store
        $getAllPrices = $request->amount;
        $price_type_ids = $request->price_type_id;

        $values = [];

        if(($getAllPrices !== NULL) && ($price_type_ids !== NULL)){
            foreach ($getAllPrices as $index => $amount) {
                $values[] = [
                    'product_id' => $product->id,
                    'amount' => $amount,
                    'price_type_id' => $price_type_ids[$index],
                ];
            }
        }

        if ( ($amount !== NULL) && ($price_type_ids[$index] !== NULL) ){
            $product->productPrices()->insert($values);
        }

        } catch (QueryException $e) {
            return back()->withErrors(['errors' => $e->getMessage()]);

        }
        flash('Product  Created Successfully ')->success();
        return redirect()->route('products.index');

    }

    public function show(Product $product)
    {
        $viewBag['product'] = $product;

       return view('admin.products.show', $viewBag);
    }

 
    public function edit(Product $product)
    {
        $viewBag['product']=$product;
        $viewBag['categories'] = $this->_getCategories();
        $viewBag['price_types'] = PriceType::where('is_active', 1)->Orderby('id', 'ASC')->get(['id', 'name']);
       return view('admin.products.edit', $viewBag);
    }

    
    public function update(Request $request, Product $product)
    {
        try {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $this->_getFileName($image->getClientOriginalExtension());
                $image->move(public_path('product-images'), $imageName);

                if ($product->image !== NULL) {
                    if (file_exists(public_path('product-images/'. $product->image ))) {
                        unlink(public_path('product-images/'. $product->image ));
                    }
                }

                $product->image = $imageName;
            }

            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->user_id = auth()->id();
            $product->update();

            // Product Price Type Update
            $product_price_id = $request->product_price_id;

            if($product_price_id){
                for ($i = 0; $i < count($product_price_id); $i++) {

                    $values = [
                        'product_id' => $product->id,
                        'amount' => $request->amount[$i],
                        'price_type_id' => $request->price_type_id[$i],
                    ];

                    $check_id = ProductPrice::find($product_price_id[$i]);

                    if ($check_id) {
                        $product->productPrices()->where('id', $check_id->id)->update($values);
                    }
                }
            }

            $price_type_new_id = $request->price_type_new_id;

            if($price_type_new_id){
                for ($i = 0; $i < count($price_type_new_id); $i++) {
                    $values2 = [
                        'product_id' => $product->id,
                        'amount' => $request->new_amount[$i],
                        'price_type_id' => $request->price_type_new_id[$i],
                    ];

                    if ( ($request->new_amount[$i] !== NULL) && ($request->price_type_new_id[$i] !== NULL) ){
                      $product->productPrices()->insert($values2);
                    }
                }
            }


        } catch (QueryException $e) {
            // $errorCode = $e->errorInfo[1];
            flash('Something want Wrong')->error();

            return redirect()->route('products.index');
        
        }

        return redirect()->route('products.index')->with('status', 'Product has been Updated Successfully.');
    }

    
    public function destroy(Product $product)
    {
        $product->delete();

        flash('Product  Delete Successfully ')->success();

        return redirect()->route('products.index');
    }


    public function toggleStatus(Product $product)
    {
        if ($product->is_active == 1){
            $product->is_active = 0;
        } else {
            $product->is_active = 1;
        }

        $product->update();

        flash('Product  Status Change Successfully ')->success();

        return redirect()->route('products.index');

    }


     // Get Categories
     private function _getCategories(){
        return Category::active()->get(['id', 'name']);
    }

    // Get File Name
    private function _getFileName($fileExtension){

        // Image name format is - p-05042022121515.jpg
        return 'p-'. date("dmYhis") . '.' . $fileExtension;
    }

    public function priceListDestroy($price_id)
    {
        $price = ProductPrice::find($price_id);
        $price->delete();

        return response()->json([
            'success' => 'Product Price Deleted Successfully !'
        ]);
    }
}
