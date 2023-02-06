<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

//use App\Models\Product;
//use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function __invoke()
    {
        /*
        $data = Product::query()
            ->select([DB::raw('count(DISTINCT products.id) as order_number')])
            ->leftJoin('order_product', 'products.id', '=', 'order_product.product_id')
            ->leftJoin('orders', 'orders.id', '=', 'order_product.order_id')
            ->whereYear('orders.created_at', '2022')
            ->groupBy(DB::raw('year(orders.created_at)'))
            ->get()
        ;

        if ($data) {
            $data = $data->toArray();
        }
        dd($data);

        //*/

        return view('welcome');
    }
}
