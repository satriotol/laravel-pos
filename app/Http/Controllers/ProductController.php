<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\product;
use App\category;

class ProductController extends Controller
{
    public function listproduct(){
        $product = DB::table('product')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->select('product.*','category.category_name')
        ->get();
        return view('pages.product.listproduct',['product' => $product]); 
    }
    public function addProduct(){
        $category = category::all();
        return view('tambah.addproduct',['category' => $category]);
    }
    public function addProductstore(Request $request){
        $this->validate($request, [
            'code' => 'required|unique:product,code',
            'name_product' => 'required',
            'category_id' => 'required',
            'purchase_price' => 'required',
            'retail_price' => 'required',
            'thumbnail' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required'
        ]);

        $thumbnail = $request->file('thumbnail');
        $nama_thumbnail = time()."_".$thumbnail->getClientOriginalName();
        $tujuan_upload = 'product_image';
        $thumbnail->move($tujuan_upload,$nama_thumbnail);

        product::create([
            'code' => $request->code,
            'name_product' => $request->name_product,
            'category_id' => $request->category_id,
            'purchase_price' => $request->purchase_price,
            'retail_price' => $request->retail_price,
            'thumbnail' => $nama_thumbnail,
            'status' => $request->status
        ]);        
        return redirect('/product/ListProduct')->with(['success' => 'Data Berhasil Ditambahkan']); 
    }
    public function editProduct($id){
        $product = DB::table('product')->where('product.id_product', $id)->get();
        $category = category::all();
        return view('pages.product.editproduct')->with('product', $product)->with('category',$category);
    }
    
    public function editProductupdatebaru(Request $request, $id)
    {
        $rules = [
            'code' => 'required',
            'name_product' => 'required',
            'category_id' => 'required',
            'purchase_price' => 'required',
            'retail_price' => 'required',
            'status' => 'required'            
        ];
        $this->validate($request, $rules);
        $product = product::find($id);
        $product->code = $request->code;
        $product->name_product = $request->name_product;
        $product->category_id = $request->category_id;
        $product->purchase_price = $request->purchase_price;
        $product->retail_price = $request->retail_price;
        $product->status = $request->status;
        $product->save();
        return redirect('/product/ListProduct')->with('success', 'data updated');
    }
    public function editproductdelete($id){
        $product = product::where('id_product',$id)->first();
        File::delete('product_image/'.$product->thumbnail);
        product::where('id_product',$id)->delete();
        return redirect('/product/ListProduct')->with(['success' => 'Data Berhasil Dihapus']);
    }
    public function editProductupdate(Request $request, $id)
    {
        if($request->hasFile('thumbnail')){
            $this->validate($request,[
                'code' => 'required',
                'name_product' => 'required',
                'category_id' => 'required',
                'purchase_price' => 'required',
                'retail_price' => 'required',
                'thumbnail' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required'
            ]);

            $filename = $request->filename;
            $filepath = 'product_image/'.$filename;
            if(file_exists($filepath)){
                @unlink($filepath);
            } 

            $thumbnail = $request->file('thumbnail');
            $nama_thumbnail = time()."_".$thumbnail->getClientOriginalName();
            $tujuan_upload = "product_image/";
            $thumbnail->move($tujuan_upload,$nama_thumbnail);

            $product = product::find($id);
            $product->update([
                'code' => $request->code,
                'name_product' => $request->name_product,
                'category_id' => $request->category_id,
                'purchase_price' => $request->purchase_price,
                'retail_price' => $request->retail_price,
                'thumbnail' => $nama_thumbnail,
                'status' => $request->status
            ]);
        }
        else {
            $this->validate($request,[
                'code' => 'required',
                'name_product' => 'required',
                'category_id' => 'required',
                'purchase_price' => 'required',
                'retail_price' => 'required',
                'status' => 'required'
            ]);
            $product = product::find($id);
            $product->update([
                'code' => $request->code,
                'name_product' => $request->name_product,
                'category_id' => $request->category_id,
                'purchase_price' => $request->purchase_price,
                'retail_price' => $request->retail_price,
                'status' => $request->status
            ]);
        }
        return redirect('/product/ListProduct')->with('success', 'data updated');
    }
}