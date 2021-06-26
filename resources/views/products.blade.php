<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Products</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-3 col-sm-12 col-xs-12"></div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div style="border: 1px solid rgb(199, 196, 196); border-radius: 10px; padding: 30px;">
                        <h5 class="text-center"><b>Add Product</b></h5>
                        <form id="productForm">
                            <div class="form-group">
                                <label for="productName"> Product name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="productName" placeholder="Enter Product name">
                                <small class="text-danger" id="productNameError"></small>
                            </div>
                            <div class="form-group">
                                <label for="quantityInStock">Quantity in stock <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="quantityInStock" placeholder="Enter quantity in stock">
                                <small class="text-danger" id="quantityInStockError"></small>
                            </div>
                            <div class="form-group">
                                <label for="pricePerItem">Price per item <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="pricePerItem" placeholder="Enter price per item">
                                <small class="text-danger" id="pricePerItemError"></small>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submitForm">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12"></div>
            </div>
            <div class="mt-5 px-5">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Product name</th>
                        <th scope="col"> Quantity in stock</th>
                        <th scope="col">Price per item</th>
                        <th scope="col">Date Added</th>
                        <th scope="col">Total value number</th>
                        </tr>
                    </thead>
                    <tbody id="productsTable">
                        @foreach($products as $product)
                        <tr id="{{$product['productId']}}">
                            <td >{{$product['productName'] ?? '-'}}</td>
                            <td>{{$product['quantityInStock'] ?? '-'}}</td>
                            <td>{{$product['pricePerItem'] ?? '-'}}</td>
                            <td>{{$product['dateAdded'] ?? '-'}}</td>
                            <td>{{$product['quantityInStock'] * $product['pricePerItem']}}</td>
                            <td>
                                <button  id="editProduct{{$product['productId']}}" class="editproductbtn btn btn-primary btn-sm" data-toggle="modal" data-target="#editProduct">Edit</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                     @if(count($products) > 0)
                    <tfoot>
                        <tr>
                            <td>Total:</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td id="totalSum">1
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
                @if(count($products) <= 0)
                <h3 class="text-center pt-5">No product available at this time.</h3>
                @endif
            </div>
        </div>
        @include('editproduct')
        <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="{{asset('js/main.js')}}"></script>
    </body>
</html>
