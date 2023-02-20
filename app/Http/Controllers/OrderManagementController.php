<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderManagementController extends Controller
{

    public function listOrderByUser($userId)
    {

        $orders = DB::table('orders')
            ->select('*')
            ->where('userId', '=', $userId)
            ->get();

        $output = array();
        for ($i = 0; $i < count($orders);) {
            $tmparray = array();
            $tmparray["orderId"] = $orders[$i]->orderId;
            $tmparray["status"] = $orders[$i]->status;
            $tmparray["payment_method"] = $orders[$i]->payment_method;
            $tmparray["userId"] = $orders[$i]->userId;
            $tmparray["created_at"] = $orders[$i]->created_at;
            $tmparray["update_at"] = $orders[$i]->update_at;
            $tmparray["shiptime_start_at"] = $orders[$i]->shiptime_start_at;
            $tmparray["completed_at"] = $orders[$i]->completed_at;
            $tmparray["paytime"] = $orders[$i]->paytime;
            $tmparray["order_time"] = $orders[$i]->order_time;
            $tmparray["DistrictID"] = $orders[$i]->DistrictID;
            $tmparray["ProvinceID"] = $orders[$i]->ProvinceID;
            $tmparray["WardCode"] = $orders[$i]->WardCode;
            $tmparray["detailAddress"] = $orders[$i]->detailAddress;
            $tmparray["total_price"] = $orders[$i]->total_price;
            $tmparray["comment"] = $orders[$i]->comment;
            $tmparray["rate"] = $orders[$i]->rate;
            $tmpProduct = array();
            $tmparray["products"] = array();
            for ($j = $i; $j < count($orders); $j++) {

                if ($orders[$j]->orderId == $orders[$i]->orderId) {
                    $tmpProduct["productId"] = $orders[$j]->productId;
                    $tmpProduct["productName"] = $orders[$j]->productName;
                    $tmpProduct["productStatus"] = $orders[$j]->productStatus;
                    $tmpProduct["price"] = $orders[$j]->price;
                    $tmpProduct["quantity"] = $orders[$j]->quantity;
                    $tmpProduct["img"] = $orders[$j]->img;
                    $tmpProduct["size"] = $orders[$j]->size;
                    $tmpProduct["color"] = $orders[$j]->color;
                    array_push($tmparray["products"], $tmpProduct);
                    // return "co den day";
                } else {
                    break;
                }
            }

            $i = $j;
            array_push($output, $tmparray);
        }
        return view('orders.order')->with('output', $output);
    }



    public function getOrderByStatus($status)
    {
        $orders = DB::table('orders')
            ->select('*')
            ->where('status', '=', $status)
            ->get();
        $output = array();
        for ($i = 0; $i < count($orders);) {
            $tmparray = array();
            $tmparray["orderId"] = $orders[$i]->orderId;
            $tmparray["status"] = $orders[$i]->status;
            $tmparray["payment_method"] = $orders[$i]->payment_method;
            $tmparray["userId"] = $orders[$i]->userId;
            $tmparray["created_at"] = $orders[$i]->created_at;
            $tmparray["update_at"] = $orders[$i]->update_at;
            $tmparray["shiptime_start_at"] = $orders[$i]->shiptime_start_at;
            $tmparray["completed_at"] = $orders[$i]->completed_at;
            $tmparray["paytime"] = $orders[$i]->paytime;
            $tmparray["order_time"] = $orders[$i]->order_time;
            $tmparray["DistrictID"] = $orders[$i]->DistrictID;
            $tmparray["ProvinceID"] = $orders[$i]->ProvinceID;
            $tmparray["WardCode"] = $orders[$i]->WardCode;
            $tmparray["detailAddress"] = $orders[$i]->detailAddress;
            $tmparray["total_price"] = $orders[$i]->total_price;
            $tmparray["comment"] = $orders[$i]->comment;
            $tmparray["rate"] = $orders[$i]->rate;
            $tmpProduct = array();
            $tmparray["products"] = array();
            for ($j = $i; $j < count($orders); $j++) {

                if ($orders[$j]->orderId == $orders[$i]->orderId) {
                    $tmpProduct["productId"] = $orders[$j]->productId;
                    $tmpProduct["productName"] = $orders[$j]->productName;
                    $tmpProduct["productStatus"] = $orders[$j]->productStatus;
                    $tmpProduct["price"] = $orders[$j]->price;
                    $tmpProduct["quantity"] = $orders[$j]->quantity;
                    $tmpProduct["img"] = $orders[$j]->img;
                    $tmpProduct["size"] = $orders[$j]->size;
                    $tmpProduct["color"] = $orders[$j]->color;
                    array_push($tmparray["products"], $tmpProduct);
                    // return "co den day";
                } else {
                    break;
                }
            }

            $i = $j;
            array_push($output, $tmparray);
        }
        return view('orders.orderByState')->with('output', $output);
    }


    public function rateComment($userId){
        // $orders = Order::all();
        return view('rate_comment.rateComment',[
            'userId'=> $userId,
            // 'userId'=> $userId
        ]);
    }

    public function rateCommentUpdate(Request $request, $userId){

        // $userId = Order::all();
        $rate = $request['rate'];
        DB::table('orders')->where('userId', $userId)
        ->update(['rate'=> $rate]);
        // return "diep";
        // dd($orders->rate);
        $cmt = $request['comment'];
        DB::table('orders')->where('userId', $userId)
        ->update(['comment'=> $cmt]);
        // return "successfull";
        // return redirect('listOrderByUser/{{$userId}}');

        $orders = DB::table('orders')
            ->select('*')
            ->where('userId', '=', $userId)
            ->get();

        $output = array();
        for ($i = 0; $i < count($orders);) {
            $tmparray = array();
            $tmparray["orderId"] = $orders[$i]->orderId;
            $tmparray["status"] = $orders[$i]->status;
            $tmparray["payment_method"] = $orders[$i]->payment_method;
            $tmparray["userId"] = $orders[$i]->userId;
            $tmparray["created_at"] = $orders[$i]->created_at;
            $tmparray["update_at"] = $orders[$i]->update_at;
            $tmparray["shiptime_start_at"] = $orders[$i]->shiptime_start_at;
            $tmparray["completed_at"] = $orders[$i]->completed_at;
            $tmparray["paytime"] = $orders[$i]->paytime;
            $tmparray["order_time"] = $orders[$i]->order_time;
            $tmparray["DistrictID"] = $orders[$i]->DistrictID;
            $tmparray["ProvinceID"] = $orders[$i]->ProvinceID;
            $tmparray["WardCode"] = $orders[$i]->WardCode;
            $tmparray["detailAddress"] = $orders[$i]->detailAddress;
            $tmparray["total_price"] = $orders[$i]->total_price;
            $tmparray["comment"] = $orders[$i]->comment;
            $tmparray["rate"] = $orders[$i]->rate;
            $tmpProduct = array();
            $tmparray["products"] = array();
            for ($j = $i; $j < count($orders); $j++) {

                if ($orders[$j]->orderId == $orders[$i]->orderId) {
                    $tmpProduct["productId"] = $orders[$j]->productId;
                    $tmpProduct["productName"] = $orders[$j]->productName;
                    $tmpProduct["productStatus"] = $orders[$j]->productStatus;
                    $tmpProduct["price"] = $orders[$j]->price;
                    $tmpProduct["quantity"] = $orders[$j]->quantity;
                    $tmpProduct["img"] = $orders[$j]->img;
                    $tmpProduct["size"] = $orders[$j]->size;
                    $tmpProduct["color"] = $orders[$j]->color;
                    array_push($tmparray["products"], $tmpProduct);
                    // return "co den day";
                } else {
                    break;
                }
            }

            $i = $j;
            array_push($output, $tmparray);
        return view('orders.order')->with('output', $output);
    }

    }

    public function createOrder($userId){

        $user_info = DB::table('orders')->where('userId',$userId)->get();
        
        return view('createOrder.create_order',[
            'userId'=>$userId,
            'user_info'=>$user_info
        ]);
    }
    public function saveOrder(Request $request, $userId){

        $data = array();
        $data['orderId'] = $request->orderId;
        $data['productId'] = $request->productId;
        $data['productName'] = $request->productName;
        $data['productStatus'] = $request->productStatus;
        $data['price'] = $request->price;
        $data['quantity'] = $request->quantity;
        $data['img'] = $request->img;
        $data['size'] = $request->size;
        $data['color'] = $request->color;
        $data['status'] = $request->status;
        $data['userId'] = $userId;
        $data['detailAddress'] = $request->detailAddress;
        $data['ship_price'] = $request->ship_price;
        $data['payment_method'] = $request->payment_method;
        $data['total_price'] = $request->total_price;
        $data['DistrictID'] = $request->DistrictID;
        $data['ProvinceID'] = $request->ProvinceID;
        $data['WardCode'] = $request->WardCode;

        $data['created_at'] = date("Y-m-d H:i:s");
        $data['update_at'] = date("Y-m-d H:i:s");
        $data['shiptime_start_at'] = date("Y-m-d H:i:s");
        $data['completed_at'] = date("Y-m-d H:i:s");
        $data['paytime'] = date("Y-m-d H:i:s");
        $data['order_time'] = date("Y-m-d H:i:s");

        // $data['created_at'] = $request->created_at;
        // $data['update_at'] = $request->update_at;
        // $data['shiptime_start_at'] = $request->shiptime_start_at;
        // $data['completed_at']  =$request->completed_at;
        // $data['paytime'] = $request->paytime;
        // $data['order_time'] = $request->order_time;

        $data['comment'] = $request->comment;
        $data['rate'] = $request->rate;
        


        DB::table('orders')->insert($data);
        Session::put('message', 'Thêm đơn hàng thành công!');

        return 'oke';

        $orders = DB::table('orders')
            ->select('*')
            ->where('userId', '=', $userId)
            ->get();
        
        $output = array();
        for ($i = 0; $i < count($orders);) {
            $tmparray = array();
            $tmparray["orderId"] = $orders[$i]->orderId;
            $tmparray["status"] = $orders[$i]->status;
            $tmparray["payment_method"] = $orders[$i]->payment_method;
            $tmparray["userId"] = $orders[$i]->userId;
            $tmparray["created_at"] = $orders[$i]->created_at;
            $tmparray["update_at"] = $orders[$i]->update_at;
            $tmparray["shiptime_start_at"] = $orders[$i]->shiptime_start_at;
            $tmparray["completed_at"] = $orders[$i]->completed_at;
            $tmparray["paytime"] = $orders[$i]->paytime;
            $tmparray["order_time"] = $orders[$i]->order_time;
            $tmparray["DistrictID"] = $orders[$i]->DistrictID;
            $tmparray["ProvinceID"] = $orders[$i]->ProvinceID;
            $tmparray["WardCode"] = $orders[$i]->WardCode;
            $tmparray["detailAddress"] = $orders[$i]->detailAddress;
            $tmparray["total_price"] = $orders[$i]->total_price;
            $tmparray["comment"] = $orders[$i]->comment;
            $tmparray["rate"] = $orders[$i]->rate;
            $tmpProduct = array();
            $tmparray["products"] = array();
            for ($j = $i; $j < count($orders); $j++) {

                if ($orders[$j]->orderId == $orders[$i]->orderId) {
                    $tmpProduct["productId"] = $orders[$j]->productId;
                    $tmpProduct["productName"] = $orders[$j]->productName;
                    $tmpProduct["productStatus"] = $orders[$j]->productStatus;
                    $tmpProduct["price"] = $orders[$j]->price;
                    $tmpProduct["quantity"] = $orders[$j]->quantity;
                    $tmpProduct["img"] = $orders[$j]->img;
                    $tmpProduct["size"] = $orders[$j]->size;
                    $tmpProduct["color"] = $orders[$j]->color;
                    array_push($tmparray["products"], $tmpProduct);
                    // return "co den day";
                } else {
                    break;
                }
            }

            $i = $j;
            array_push($output, $tmparray);
        }

        return view('orders.order',[
            'output' => $output,
        ]);
        
    }







    public function listOrder()
    {

        $orders = DB::table('orders')
            ->select('*')
            // ->where('userId', '=', $userId)
            ->get();

        $output = array();
        for ($i = 0; $i < count($orders);) {
            $tmparray = array();
            $tmparray["orderId"] = $orders[$i]->orderId;
            $tmparray["status"] = $orders[$i]->status;
            $tmparray["payment_method"] = $orders[$i]->payment_method;
            $tmparray["userId"] = $orders[$i]->userId;
            $tmparray["created_at"] = $orders[$i]->created_at;
            $tmparray["update_at"] = $orders[$i]->update_at;
            $tmparray["shiptime_start_at"] = $orders[$i]->shiptime_start_at;
            $tmparray["completed_at"] = $orders[$i]->completed_at;
            $tmparray["paytime"] = $orders[$i]->paytime;
            $tmparray["order_time"] = $orders[$i]->order_time;
            $tmparray["DistrictID"] = $orders[$i]->DistrictID;
            $tmparray["ProvinceID"] = $orders[$i]->ProvinceID;
            $tmparray["WardCode"] = $orders[$i]->WardCode;
            $tmparray["detailAddress"] = $orders[$i]->detailAddress;
            $tmparray["total_price"] = $orders[$i]->total_price;
            $tmparray["comment"] = $orders[$i]->comment;
            $tmparray["rate"] = $orders[$i]->rate;
            $tmpProduct = array();
            $tmparray["products"] = array();
            for ($j = $i; $j < count($orders); $j++) {

                if ($orders[$j]->orderId == $orders[$i]->orderId) {
                    $tmpProduct["productId"] = $orders[$j]->productId;
                    $tmpProduct["productName"] = $orders[$j]->productName;
                    $tmpProduct["productStatus"] = $orders[$j]->productStatus;
                    $tmpProduct["price"] = $orders[$j]->price;
                    $tmpProduct["quantity"] = $orders[$j]->quantity;
                    $tmpProduct["img"] = $orders[$j]->img;
                    $tmpProduct["size"] = $orders[$j]->size;
                    $tmpProduct["color"] = $orders[$j]->color;
                    array_push($tmparray["products"], $tmpProduct);
                    // return "co den day";
                } else {
                    break;
                }
            }

            $i = $j;
            array_push($output, $tmparray);
        }
        return view('orders.order')->with('output', $output);
    }



    public function listOrderByStatus($status)
    {
        $orders = DB::table('orders')
            ->select('*')
            ->where('status', '=', $status)
            ->get();
        $output = array();
        for ($i = 0; $i < count($orders);) {
            $tmparray = array();
            $tmparray["orderId"] = $orders[$i]->orderId;
            $tmparray["status"] = $orders[$i]->status;
            $tmparray["payment_method"] = $orders[$i]->payment_method;
            $tmparray["userId"] = $orders[$i]->userId;
            $tmparray["created_at"] = $orders[$i]->created_at;
            $tmparray["update_at"] = $orders[$i]->update_at;
            $tmparray["shiptime_start_at"] = $orders[$i]->shiptime_start_at;
            $tmparray["completed_at"] = $orders[$i]->completed_at;
            $tmparray["paytime"] = $orders[$i]->paytime;
            $tmparray["order_time"] = $orders[$i]->order_time;
            $tmparray["DistrictID"] = $orders[$i]->DistrictID;
            $tmparray["ProvinceID"] = $orders[$i]->ProvinceID;
            $tmparray["WardCode"] = $orders[$i]->WardCode;
            $tmparray["detailAddress"] = $orders[$i]->detailAddress;
            $tmparray["total_price"] = $orders[$i]->total_price;
            $tmparray["comment"] = $orders[$i]->comment;
            $tmparray["rate"] = $orders[$i]->rate;
            $tmpProduct = array();
            $tmparray["products"] = array();
            for ($j = $i; $j < count($orders); $j++) {

                if ($orders[$j]->orderId == $orders[$i]->orderId) {
                    $tmpProduct["productId"] = $orders[$j]->productId;
                    $tmpProduct["productName"] = $orders[$j]->productName;
                    $tmpProduct["productStatus"] = $orders[$j]->productStatus;
                    $tmpProduct["price"] = $orders[$j]->price;
                    $tmpProduct["quantity"] = $orders[$j]->quantity;
                    $tmpProduct["img"] = $orders[$j]->img;
                    $tmpProduct["size"] = $orders[$j]->size;
                    $tmpProduct["color"] = $orders[$j]->color;
                    array_push($tmparray["products"], $tmpProduct);
                    // return "co den day";
                } else {
                    break;
                }
            }

            $i = $j;
            array_push($output, $tmparray);
        }
        return view('orders.orderByState')->with('output', $output);
    }

    
}

