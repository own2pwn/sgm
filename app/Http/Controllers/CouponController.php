<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

use App\Http\Requests\StoreCoupon;
use App\Traits\FlashModelAttributes;
use App\Http\Requests;
use App\Product;
use App\Coupon;

class CouponController extends Controller
{
    use FlashModelAttributes;

    /**
     * The Coupon instance.
     * @var App/Coupon
     */
    protected $coupon;

    /**
     * The Product instance.
     * @var App/Product
     */
    protected $product;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Coupon $coupon, Product $product)
    {
        $this->coupon = $coupon;
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('coupon.index')->with('coupons', $this->coupon->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Log::info('Show create coupon page');

        $request->session()->flash('products', $this->product->all());

        return view('coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCoupon  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoupon $request)
    {
        Log::info('Storing coupon');

        $coupon                       = $this->coupon;
        $coupon->code                 = $request->code;
        $coupon->percentage           = $request->percentage;
        $coupon->value                = $request->value;
        $coupon->selected_product_ids = $request->selected_product_ids;
        $coupon->date_of_issue        = $this->toDate($request->date_of_issue);
        $coupon->date_of_expiration   = $this->toDate($request->date_of_expiration);

        $coupon->save();

        return redirect('coupons')->withMessage('Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::info('Showing coupon id: '.$id);

        $coupon = $this->coupon->findOrFail($id);
        $products = $this->product->whereIn('id', explode(",", $coupon->selected_product_ids))->get(['brand', 'model']);
        
        return view('coupon.show', $coupon->toArray())->with('products', $products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Log::info('Editing coupon id: '.$id);

        $coupon = $this->coupon->findOrFail($id);

        $this->flashAttributesToSession($request, $coupon);
        $request->session()->flash('products', $this->product->all());

        return view('coupon.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http|Requests\StoreCoupon  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCoupon $request, $id)
    {
        Log::info('Updating coupon id: '.$id);

        $coupon                       = $this->coupon->findOrFail($id);
        $coupon->code                 = $request->code;
        $coupon->percentage           = $request->percentage;
        $coupon->value                = $request->value;
        $coupon->selected_product_ids = $request->selected_product_ids;
        $coupon->date_of_issue        = $this->toDate($request->date_of_issue);
        $coupon->date_of_expiration   = $this->toDate($request->date_of_expiration);

        $coupon->save();

        return redirect('coupons/'.$coupon->id)->withMessage('Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Log::info('Removing coupon id: '.$id);

        $coupon     = $this->coupon->findOrFail($id);
        $couponCode = $coupon->code;

        $this->coupon->destroy($id);

        return redirect('coupons')->withMessage('Deleted \''.$couponCode.'\'');
    }

    /**
     * Converts date string to date object with the following date format: Y-m-d.
     *
     * @param  String $dateStr the date in String representation
     * @return an instance of date object
     */
    private function toDate($dateStr) 
    {
        $time = strtotime($dateStr);
        return date('Y/m/d', $time);
    }
}
