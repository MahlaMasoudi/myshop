<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\User;
use App\Models\Market\Copan;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\AmazingSale;
use App\Http\Controllers\Controller;
use App\Models\Market\CommonDiscount;
use App\Http\Requests\Admin\Market\CopanRequest;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Http\Requests\Admin\Market\CommonDiscountRequest;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function commonDiscount()
    {
        $commonDiscounts = CommonDiscount::all();
        return view('admin.market.discount.common', compact('commonDiscounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function commonDiscountCreate()
    {
        return view('admin.market.discount.common-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function commonDiscountStore(CommonDiscountRequest $request)
    {
        $inputs = $request->all();
         //date fixed
         $realTimestampStart = substr($request->start_date, 0, 10);
         $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
         $realTimestampEnd = substr($request->end_date, 0, 10);
         $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampEnd);
        $commonDiscount = CommonDiscount::create($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', 'کد تخفیف جدید شما با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function commonDiscountEdit(CommonDiscount $commonDiscount)
    {
        return view('admin.market.discount.common-edit', compact('commonDiscount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function commonDiscountUpdate(CommonDiscountRequest $request, CommonDiscount $commonDiscount)
    {
        $inputs = $request->all();
        //date fixed
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampEnd);
        $commonDiscount->update($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', 'کد تخفیف جدید شما با موفقیت ویرایش شد');
    }

 public function commonDiscountDestroy(CommonDiscount $commonDiscount)
    {
        $result = $commonDiscount->delete();
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', 'کد تخفیف  شما با موفقیت حذف شد');
    }




    public function amazingSale()
    {

        $amazingSales=AmazingSale::all();
        return view('admin.market.discount.amazing', compact('amazingSales'));

    }

    public function amazingSaleCreate(){

        $products=Product::all();
        return view('admin.market.discount.amazing-create', compact('products'));
    }

    public function amazingSaleStore(AmazingSaleRequest $request){

        $inputs = $request->all();
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampEnd);
       $amazingSale = AmazingSale::create($inputs);
       return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', ' تخفیف جدید شما با موفقیت ثبت شد');
    }

    public function amazingSaleEdit(AmazingSale $amazingSale)
    {
        $products = Product::all();
        return view('admin.market.discount.amazing-edit', compact('amazingSale', 'products'));
    }

    public function amazingSaleUpdate(AmazingSaleRequest $request, AmazingSale $amazingSale)
        {
            $inputs = $request->all();
            //date fixed
            $realTimestampStart = substr($request->start_date, 0, 10);
            $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
            $realTimestampEnd = substr($request->end_date, 0, 10);
            $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampEnd);
            $amazingSale->update($inputs);
            return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', ' تخفیف  شما با موفقیت ویرایش شد');
        }


        public function amazingSaleDestroy(AmazingSale $amazingSale)
        {
            $result = $amazingSale->delete();
            return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', ' تخفیف  شما با موفقیت حذف شد');
        }


        public function copan()
        {
            $copans=Copan::all();
            return view('admin.market.discount.copan', compact('copans'));

        }


        public function copanCreate()
        {
            $users=User::all();
            return view('admin.market.discount.copan-create', compact('users'));

        }

        public function copanStore(CopanRequest $request)
        {
            $inputs = $request->all();
             //date fixed
             $realTimestampStart = substr($request->start_date, 0, 10);
             $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
             $realTimestampEnd = substr($request->end_date, 0, 10);
             $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampEnd);
             if($inputs['type'] == 0){
                $inputs['user_id'] = null;
             }
            $copan = Copan::create($inputs);
            return redirect()->route('admin.market.discount.copan')->with('swal-success', ' کد تخفیف جدید شما با موفقیت ثبت شد');
        }


        public function copanUpdate(CopanRequest $request, Copan $copan)
        {
            $inputs = $request->all();
            //date fixed
            $realTimestampStart = substr($request->start_date, 0, 10);
            $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
            $realTimestampEnd = substr($request->end_date, 0, 10);
            $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampEnd);
            if($inputs['type'] == 0){
               $inputs['user_id'] = null;
            }
            $copan->update($inputs);
            return redirect()->route('admin.market.discount.copan')->with('swal-success', 'کد تخفیف  شما با موفقیت ویرایش شد');
        }


        public function copanDestroy(Copan $copan)
        {
            $result = $copan->delete();
            return redirect()->route('admin.market.discount.copan')->with('swal-success', ' تخفیف  شما با موفقیت حذف شد');
        }


}
