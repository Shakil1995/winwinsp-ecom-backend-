<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\PriceType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $_getColumns = (['id', 'name','category_id', 'user_id', 'is_active']);

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
        return $request;
    }

    public function show(Product $product)
    {
        //
    }

 
    public function edit(Product $product)
    {
        //
    }

    
    public function update(Request $request, Product $product)
    {
        //
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
}
