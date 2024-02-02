<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Models\Market\CategoryValue;
use App\Models\Market\CategoryAttribute;
use App\Http\Requests\Admin\Market\CategoryValueRequest;

class PropertyValueController extends Controller
{
    public function index(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.index',compact('categoryAttribute'));
    }
    public function create(CategoryAttribute $categoryAttribute)
    {
        
        return view('admin.market.property.value.create',compact('categoryAttribute'));
    }


    public function store(CategoryValueRequest $request,CategoryAttribute $categoryAttribute)
    {
        
        $inputs=$request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $inputs['category_attribute_id']=$categoryAttribute->id;
        $value = CategoryValue::create($inputs);
        return view('admin.market.property.value.index',compact('categoryAttribute'));
    }

    public function edit(CategoryAttribute $categoryAttribute, CategoryValue $value)
    {
        return view('admin.market.property.value.edit', compact('categoryAttribute', 'value'));
    }
    public function update(CategoryValueRequest $request ,CategoryAttribute $categoryAttribute, CategoryValue $value)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $inputs['category_attribute_id'] = $categoryAttribute->id;
        $value->update($inputs);
        return redirect()->route('admin.market.value.index', $categoryAttribute->id)->with('swal-success', 'مقدار فرم کالای  شما با موفقیت ویرایش شد');
    }

    public function destroy(CategoryAttribute $categoryAttribute, CategoryValue $value)
    {

        $result = $value->delete();
        return redirect()->route('admin.market.value.index', $categoryAttribute->id)->with('swal-success', 'مقدار فرم کالای  شما با موفقیت حذف شد');
    }

}
