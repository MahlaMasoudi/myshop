<?php

namespace App\Http\Controllers\Admin\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket\TicketCategory;
use App\Http\Requests\Admin\Ticket\TicketCategoryRequest;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticketCategories=TicketCategory::all();
        return view('admin.ticket.category.index',compact('ticketCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ticket.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketCategoryRequest $request)
    {
        $inputs = $request->all();
        $ticketCategory = TicketCategory::create($inputs);
        return redirect()->route('admin.ticket.category.index')->with('swal-success', 'دسته بندی جدید شما با موفقیت ثبت شد');
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
    public function edit(TicketCategory $ticketCategory)
    {
        return view('admin.ticket.category.edit', compact('ticketCategory'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketCategoryRequest $request, TicketCategory $ticketCategory)
    {
        $inputs = $request->all();
        $ticketCategory->update($inputs);
        return redirect()->route('admin.ticket.category.index')->with('swal-success', 'دسته بندی شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketCategory $ticketCategory)
    {
        $result = $ticketCategory->delete();
       return redirect()->route('admin.ticket.category.index')->with('swal-success', 'دسته بندی شما با موفقیت حذف شد');
    }


    public function status(TicketCategory $ticketCategory){

        $ticketCategory->status = $ticketCategory->status == 0 ? 1 : 0;
        $result = $ticketCategory->save();
        if($result){
                if($ticketCategory->status == 0){
                    return response()->json(['status' => true, 'checked' => false]);
                }
                else{
                    return response()->json(['status' => true, 'checked' => true]);
                }
        }
        else{
            return response()->json(['status' => false]);
        }

    }
}
