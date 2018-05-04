<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Order extends Model
{
    public $first_name;
    public $last_name;
    public $product;
    public function index()
    {
    }
    public function save_order($first_name, $last_name, $product)
    {
        $order = DB::table('orders')->insertGetId(
            ['first_name' => $first_name, 'last_name' => $last_name, 'product_name' => $product]
            );
        return $order;
    }
}