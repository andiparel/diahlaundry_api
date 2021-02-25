<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    //
    function get(){
        $Customer = Customer::all();

        if($Customer == null){
            return response() ->json([
                'message' => 'Empty Data'
            ]);
        }else{
            return response()->json([
                'message' => 'Success',
                'data' => $Customer
            ]);
        }
    }
    function post(Request $request){

        $Customer = new Customer();

        $Customer->nama_customer = $request->nama_customer;
        $Customer->tempat_tinggal = $request->tempat_tinggal;
        $Customer->notelepon = $request->notelepon;

        
        if($Customer->nama_customer == null || 
        $Customer->tempat_tinggal == null || 
        $Customer->notelepon == null){
            return response()->json([
                "message" => "Failed! plis insert nama, tempat tinggal, no telepon"
                ]);
            }else{
                $Customer->Save();
                return response()->json([
                        "message" => "Success",
                        "data" => $Customer
                    ]);
        }

    }
    function put(Request $request, $id) {
        $Customer = Customer::where('id_customer',$id)->first();

        if($Customer){
            $Customer->nama_customer = $request->nama_customer ? $request-> nama_customer : $Customer->nama_customer;
            $Customer->tempat_tinggal = $request->tempat_tinggal ? $request-> tempat_tinggal : $Customer->tempat_tinggal;
            $Customer->notelepon = $request->notelepon ? $request-> notelepon : $Customer->notelepon;
        
            $Customer->save();
            return response()->json([
                    "message" => "Success",
                    "data" => $Customer                
                ]);
        }else{
            return response()->json([
                "message" => "Failed, Wrond".$id.''              
            ]);
        }
    }
    function delete($id){
        $Customer = Customer::where('id_customer',$id)->first();

        if($Customer == null){
            return response()->json([
                'message' => 'id '.$id.' Not Found'
            ], 400);
        }else{
            return response()->json([
                'message' => 'success'
            ]);
        }
    }
}
