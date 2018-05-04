<?php
namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use App\Permissions;
class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->permissions = new Permissions();
    }
    public function index(Request $request)
    {
        $user = $this->permissions->get_user_data();
        $user = $user[0];
        if ($user->permission == "View Sales")
        {
            return redirect('admin');
        }
        $ccard = $request->input('ccard');
        $ccard = str_replace(" ","", $ccard);
        $payment_fail = 0;
        if ($ccard == "5105105105105100")
        {
            $redirect_page = 'thanks?pid=' . intval($request->input('pid')) . "&product=" . htmlspecialchars($request->input('product')) . "&first=" . htmlspecialchars($request->input('first')) . "&last=" . htmlspecialchars($request->input('last'));
            return redirect($redirect_page);
        }
        else if (!empty($request->input('checked_out')))
        {
            $payment_fail = 1;
        }
        return view('checkout', ['payment_fail'=>$payment_fail]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}