<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Discount; 
use App\Models\Product; 
use App\Models\Customer; 
use App\Models\ProductOrderHistory; 
use App\Models\InventoryReturnOrder;
class PDFController extends Controller
{
    public function download() {
       // $pdf = PDF::loadView('admin.sales.sales-pdf-template.cash-sales-receipt-pdf');
        //return $pdf->download('invoice.pdf');
      /*  echo '<pre>';
        $cart  = session('cart');
        print_r($cart['products']);

        foreach($cart['products'] as $product){
            $productDetails = Product::find($product['id']);
            $order = ProductOrderHistory::create([
                'order_id' => $invoice_id,
                'name' => $productDetails->name,
                'quantity_type' => $productDetails->quantity,
                'quantity' => $product['quantity'],
                'manufacture_date' => $productDetails->manufacture_date,
                'lot_number' => $productDetails->lot_number,
                'image' => $productDetails->image,
                'status' => $productDetails->status,
                'created_by' => $productDetails->created_by,
                'category_id' => $productDetails->category_id,
                'price' => $product['price'],
                'product_total_amount' => $product['product_total_amount']
            ]);
        }*/
        // if(isset($cart['discount'])){
        //     $discount = Discount::find($cart['discount']['id']);
        //     $discountDetails = ["name" => "Buy ".$discount->quantity." get ".$discount->discount."%", "discount_amount"=>$cart['discount']['discount_amount']];
        // }else{
        //     $discountDetails = '';
        // }
        
        $invoice_id = 'INV-000037';
        $returnStocks = InventoryReturnOrder::where('order_id','=',$invoice_id)->get();
        $totalProduct = InventoryReturnOrder::where('order_id','=',$invoice_id)->sum('quantity');
        $customer = Customer::where('id','=',37)->first();

        return view('admin.stocks.stock-transfer-pdf-template.stock-transfer-pdf',compact('returnStocks','customer','totalProduct'));
    }
}
