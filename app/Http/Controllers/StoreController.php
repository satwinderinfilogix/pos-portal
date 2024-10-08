<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Gate;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('view stores')) {
            abort(403);
        }

        $stores = Store::where('is_deleted',0)->get();
        return view('admin.stores.index',compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('create stores')) {
            abort(403);
        }

        return view('admin.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Store::Create([
            "name" => $request->name,
            "email" => $request->email,
            "contact_number" => $request->contact_number,
            "location" => $request->location,
        ]);
        
        return redirect()->route('stores.index')->with('success','Store Created Successfully');
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
    public function edit(string $id)
    {
        if (!Gate::allows('edit stores')) {
            abort(403);
        }

        $store = Store::find($id);
        return view('admin.stores.edit',compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $store = Store::where('id',$id)
        ->update([
            "name" => $request->name,
            "email" => $request->email,
            "contact_number" => $request->contact_number,
            "location" => $request->location,
        ]);
        return redirect()->route('stores.index')->with('success','Store Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::allows('delete stores')) {
            abort(403);
        }

        $store = Store::where('id','=',$id)->update([
            "is_deleted" => 1
        ]);
        
        return response()->json(['success'=>true]);
    }
}
