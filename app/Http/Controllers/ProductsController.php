<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function index()
    {
        $productsString = file_get_contents(base_path('data.json'));
        $products = json_decode($productsString, true);

        return view('products', compact('products'));
        // $product = [
        //     'productName' => 'Product 1',
        //     'quantityInStock' => 3,
        //     'pricePerItem' => 500,
        // ];
        // array_push($products, $product);
        // $products = json_encode($products, JSON_PRETTY_PRINT);
        // file_put_contents(base_path('data.json'), stripslashes($products));
    }

    public function create(ProductRequest $request)
    {
        $productsString = file_get_contents(base_path('data.json'));
        $products = json_decode($productsString, true);
        $product = [
            'productId' => Str::uuid(),
            'productName' => request()->productName,
            'quantityInStock' => request()->quantityInStock,
            'pricePerItem' => request()->pricePerItem,
            'dateAdded' => date('Y-m-d H:i:s'),
        ];
        array_push($products, $product);
        $products = json_encode($products, JSON_PRETTY_PRINT);
        file_put_contents(base_path('data.json'), stripslashes($products));

        return response()->json($product);
    }

    public function update($productId, ProductRequest $request)
    {
        $productsString = file_get_contents(base_path('data.json'));
        $products = json_decode($productsString, true);

        $productDetails = null;
        foreach ($products as &$product) {
            if ($product['productId'] === $productId) {
                $product['productName'] = $request->productName;
                $product['quantityInStock'] = $request->quantityInStock;
                $product['pricePerItem'] = $request->pricePerItem;
                $productDetails = $product;
            }
        }
        $products = json_encode($products, JSON_PRETTY_PRINT);
        file_put_contents(base_path('data.json'), stripslashes($products));
        return response()->json($productDetails);
    }
}
