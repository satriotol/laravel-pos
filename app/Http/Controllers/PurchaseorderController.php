<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;
use App\purchase_order;
use App\supplier;
use App\Customer;
use App\gift_card;
use App\category;
use App\expensescategory;
use App\product;
use App\outlets;
use App\users;
use App\UserRoles;

class PurchaseorderController extends Controller
{
    
    public function purchase(){
        $purchase_order = DB::table('purchase_order')
        ->join('outlets', 'outlets.id', '=', 'purchase_order.id_outlet')
        ->join('supplier', 'supplier.id', '=', 'purchase_order.id_supplier')
        ->select('purchase_order.*', 'outlets.name_outlet', 'supplier.supplier_name')
        ->get();
        return view('pages.purchase_order',['purchase_order'=>$purchase_order]);    
    }

    public function editpurchaseorder(){
        $supplier = supplier::all();
        $outlets = outlets::all();
        $product = product::all();
        return view('pages.edit.editpurchase',['outlets'=> $outlets],['supplier' => $supplier])->with('product',$product);        
    }

    public function createpurchase(){
        $supplier = supplier::all();
        $outlets = outlets::all();
        $product = product::all();
        return view('tambah.createpurchase',['outlets'=> $outlets],['supplier' => $supplier])->with('product',$product); 
    }

    public function  createpurchasestore(Request $request)
    {
    	$this->validate($request,[
    		'po_number' => 'required',
            'id_outlet' => 'required',
            'id_supplier' => 'required',
            'datenow' => 'required',
            'note' => 'required',
    	]);

        purchase_order::create([
    		'po_number' => $request->po_number,
            'id_outlet' => $request->id_outlet,
            'id_supplier' => $request->id_supplier,
            'datenow' => $request->datenow,
            'note' => $request->note,
    	]);

    	return redirect('/purchase_order');
    }


}
