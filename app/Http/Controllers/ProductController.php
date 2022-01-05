<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Http\Resources\PRODUCTResource;
use App\Events\ProductViewer;
class ProductController extends Controller
{
    
    public function index()
    {
      $products = Product::all();
      return response([ 'Products' => PRODUCTResource::collection($products), 'message' => 'Retrieved successfully'], 200);
    }

    public function store()
    {
        $data = request()->validate([
            'name'=>'required',
            'image'=>['required','image'],
            'expireDate'=>'date',
            'phoneNumber'=>'required',
            'category'=>'required',
            'quantity'=>['required','integer','min:1'],
            'price'=>['required','numeric','min:0'],
            'minNoDaysFirstOffer' => ['required','integer','min:1'],
            'minNoDaysSecondOffer' => ['required','integer','min:1'],
            'minNoDaysThirdOffer' => ['required','integer','min:1'],
            'firstOfferPrice' => ['required','numeric','between:0,1'],
            'secondOfferPrice' => ['required','numeric','between:0,1'],
            'thirdOfferPrice' => ['required','numeric','between:0,1'],
        ]);
       $imagePath = request('image')->store('uploads','public');
        auth()->user()->products()->create([
            'name' => $data['name'],
            'image' => $data['image'],
            'expireDate' => $data['expireDate'],
            'phoneNumber' => $data['phoneNumber'],
            'category' => $data['category'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'minNoDaysFirstOffer' => $data['minNoDaysFirstOffer'],
            'minNoDaysSecondOffer' => $data['minNoDaysSecondOffer'],
            'minNoDaysThirdOffer' => $data['minNoDaysThirdOffer'],
            'firstOfferPrice' => $data['firstOfferPrice'],
            'secondOfferPrice' => $data['secondOfferPrice'],
            'thirdOfferPrice' => $data['thirdOfferPrice'],
        ]);

        return response(200); 
    }
    //route model pinding
    public function show(Product $product)
    {
      event(new ProductViewer($product));
      return response([ 'Product' => new PRODUCTResource($product), 'message' => 'Retrieved successfully'], 200);
    } 

    public function update(Product $product)
    {
      $this->authorize('update',$product);
      $data = request()->validate([
        'name'=>'required',
        'image'=>['required'],
        'phoneNumber'=>'required',
        'category'=>'required',
        'quantity'=>['required','integer','min:1'],
        'price'=>['required','numeric','min:0'],
        'minNoDaysFirstOffer' => ['required','integer','min:1'],
        'minNoDaysSecondOffer' => ['required','integer','min:1'],
        'minNoDaysThirdOffer' => ['required','integer','min:1'],
        'firstOfferPrice' => ['required','numeric','between:0,1'],
        'secondOfferPrice' => ['required','numeric','between:0,1'],
        'thirdOfferPrice' => ['required','numeric','between:0,1'],
      ]);
      $product->update($data);
      return $product;
    }
    
    public function destroy(Product $product)
    {
      $this->authorize('delete',$product);
      $product->delete();
      return response(['message' => 'Deleted']);
    }

    public function search(Request $request)
    {
      $request->validate([
        'qwery' => 'required|min:3']);

      $qwery = $request->input('qwery');

      $products = Product::where('name','like',"%$qwery%")->get();
      
      if(!isset($products[0]))
      {
          $products = Product::where('category','like',"%$qwery%")->get();
      }

      if(!isset($products[0]))
      {
          $products = Product::where('expireDate','like',"%$qwery%")->get();
      }

      if(!isset($products[0]))
      {
          return response()->json(['message' => 'Not Found']);
      }

      return response([ 'Products' => new PRODUCTResource($products), 'message' => 'Retrieved successfully'], 200);
    }
}
