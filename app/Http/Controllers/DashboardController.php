<?php

namespace App\Http\Controllers;

use App\Models\LineItem;
use App\Models\Product;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::get();
        $invoice = SalesInvoice::get();

        return response()->json([
            'status' => 200,
            'product' => $products,
            'invoice' => $invoice,
        ]);
    }

    public function view($id)
    {
        $invoice = SalesInvoice::find($id);
        $products = Product::get();

        if ($invoice) {
            return response()->json([
                'status' => 200,
                'invoice' => $invoice,
                'lineItem' => $invoice->lineItems,
                'products' => $products
            ]);
        } else {
            return response()->json([
                'status' => 204,
                'message' => 'Invalid User',
            ]);
        }
    }

    public function addInvoice(Request $request)
    {
        $user = SalesInvoice::create([
            'customer_name' => $request->input("customer")['customer_name'],
            'address' => $request->input("customer")['address'],
        ]);


        foreach ($request->input('inputList') as $data) {

            $productPrice = Product::where('id', $data['product_id'])->value('price');

            $item = new LineItem();
            $item->customer_id = $user->id;
            $item->product_id = $data['product_id'];
            $item->product_quantity = $data['product_quantity'];
            $item->product_price =  $productPrice;
            $item->product_total_price =  $productPrice * $data['product_quantity'];
            $item->save();
        }

        return response()->json([
            'status' => 200,
            'message' => 'Invoice added successfully.'
        ]);
    }

    public function getProduct($id){

        $product = Product::find($id);

        if ($product) {
            return response()->json([
                'status' => 200,
                'products' => $product
            ]);
        } else {
            return response()->json([
                'status' => 204,
                'message' => 'Invalid product id',
            ]);
        }

    }

    public function deleteInvoice($id)
    {
        $lineItem = LineItem::where('customer_id', $id)->delete();

        $invoice  = SalesInvoice::where('id', $id)->delete();

        if ($invoice && $lineItem) {
            return response()->json([
                'status' => 200,
                'message' => 'Invoice deleted successfully.'
            ]);
        }
    }
}
