<?php

namespace App\Http\Controllers;

use App\Info;
use App\Mail\checkoutFormMail;
use App\order;
use App\Product;
use App\Provider;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $sessionKey;
    function __construct()
    {
        $this->sessionKey = config('variables.sessionKey');
    }

    public function cart()
    {
        $cartCollection = Cart::session($this->sessionKey)->getContent();
        $providers = Provider::where('publish', 1)->orderBy('sort_order', 'desc')->get();
        return view('frontend.cart')->with('providers', $providers)->with('cartCollection', $cartCollection);
    }

    public function postCart()
    {
        $product = Product::findOrFail(request()->product_id);

        $discount = null;

        if ($product->discount > 0 && $product->discount <= 100) {
            $discount = $product->price - ($product->price * $product->discount / 100);
        } else if ($product->discount > 100) {
            $discount = $product->price - $product->discount;
        } else {
            $discount = $product->price;
        }

        $cart = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $discount,
            'quantity' => request()->qty,
            'attributes' => array(
                'image' => $product->image,
                'discount' => $product->discount,
            )
        ];

        Cart::session($this->sessionKey)->add($cart);
        return redirect()->route('cart');
    }

    public function updateCart()
    {
        Cart::session($this->sessionKey)->update(request()->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => request()->value
            ),
        ));

        $itemUpdated = Cart::session($this->sessionKey)->get(request()->id);

        $total = number_format($itemUpdated->getPriceSum(), null, ',', '.') . ' VNĐ';

        $amount = number_format(Cart::getTotal(), null, ',', '.') . ' VNĐ';

        return response(['total' => $total, 'id' => request()->id, 'amount' => $amount], 200);
    }

    public function removeCart()
    {

        Cart::session($this->sessionKey)->remove(request()->id);

        $amount = number_format(Cart::getTotal(), null, ',', '.') . ' VNĐ';

        return response(['id' => request()->id, 'amount' => $amount], 200);
    }

    public function clearCart()
    {
        Cart::session($this->sessionKey)->clear();

        return redirect()->back();
    }

    public function checkout()
    {
        $cartCollection = Cart::session($this->sessionKey)->getContent();
        $providers = Provider::where('publish', 1)->orderBy('sort_order', 'desc')->get();
        return view('frontend.checkout')->with('providers', $providers)
            ->with('cartCollection', $cartCollection);
    }

    public function postCheckout()
    {
        // dd(route('result'));
        // dd(request()->all());

        $cartCollection = Cart::session($this->sessionKey)->getContent();
        $order = order::create([
            'name' => request()->fullname,
            'email' => request()->email,
            'phone' => request()->phone,
            'address' => request()->address,
            'message' => request()->message,
            'amount' => Cart::session($this->sessionKey)->getTotal(),
            'payment' => request()->payment,
            'payment_info' => request()->bank_code
        ]);

        $orderProduct = order::findOrFail($order->id);
        foreach ($cartCollection as $key => $item) {
            $orderProduct->order_detail()->attach($item->id, [
                'price' => $item->price,
                'qty' => $item->quantity,
                'amount' => $item->getPriceSum(),
                'status' => 0,
                'data' => $item->attributes->image,
            ]);
        }

        $info = Info::first();

        Mail::send('emails.contact.checkout-form', ['info' => $order, 'cart' => $cartCollection], function ($m) use ($info, $cartCollection, $order) {
            $m->from('hdpro1997@zohomail.com');
            $m->to('hdpro1997@zohomail.com')->subject('Đơn hàng văn phòng phẩm sài gòn!')->cc([$order['email'], $info['email']]);
        });

        Session::flash('success', 'Hoàn thành đơn hàng!');

        if (request()->payment == 'online') {
            $vnp_TmnCode = "VBUUFFO2"; //Mã website tại VNPAY 
            $vnp_HashSecret = "ILBPOXPIASFNOAGJEIEVJQYLLYLGHPBA"; //Chuỗi bí mật
            $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('response');
            $vnp_TxnRef = $order->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán hóa đơn phí dich vụ';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = Cart::session($this->sessionKey)->getTotal() * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = request()->bank_code;
            $vnp_IpAddr = request()->ip();

            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
                $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            // echo json_encode($returnData);
            Cart::session($this->sessionKey)->clear();
            return redirect($vnp_Url);

        } else {
            Cart::session($this->sessionKey)->clear();
            return redirect()->back();
        }
    }

    public function resultCheckout()
    {
        // $vnp_TmnCode = "VBUUFFO2"; //Mã website tại VNPAY 
        $vnp_HashSecret = "ILBPOXPIASFNOAGJEIEVJQYLLYLGHPBA"; //Chuỗi bí mật
        // $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        // $vnp_Returnurl = route('result');
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }
        $secureHash = hash('sha256', $vnp_HashSecret . $hashData);


        $providers = Provider::where('publish', 1)->orderBy('sort_order', 'desc')->get();

        return view('frontend.result_checkout')->with('secureHash', $secureHash)
            ->with('vnp_SecureHash', $vnp_SecureHash)
            ->with('providers', $providers);
    }

    public function responseCheckout()
    {
        $vnp_HashSecret = "ILBPOXPIASFNOAGJEIEVJQYLLYLGHPBA"; //Chuỗi bí mật
        $inputData = array();
        $returnData = array();
        $data = $_REQUEST;
        foreach ($data as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $secureHash = hash('sha256', $vnp_HashSecret . $hashData);
        $Status = 0;
        $orderId = $inputData['vnp_TxnRef'];

        try {
            //Check Orderid    
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId            
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                //Giả sử: $order = mysqli_fetch_assoc($result);   
                $order = NULL;
                $order = order::findOrFail($orderId);
                if ($order != NULL) {
                    // dd($order->status == 0);
                    if ($order["status"] !== NULL && $order["status"] == 0) {
                        if ($inputData['vnp_ResponseCode'] == '00') {
                            $Status = 1;
                    
                        } else {
                            $Status = 2;
                        
                        }
                        //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                        
                        if($Status == 1){
                            $order->status = 2;
                            $order->save();
                        }
                        //Trả kết quả về cho VNPAY: Website TMĐT ghi nhận yêu cầu thành công                
                        $returnData['RspCode'] = '00';
                        $returnData['Message'] = 'Confirm Success';
                    } else {
                        $returnData['RspCode'] = '02';
                        $returnData['Message'] = 'Order already confirmed';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Chu ky khong hop le';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
        //Trả lại VNPAY theo định dạng JSON
        echo json_encode($returnData);
        Session::flash('success', 'Hoàn thành đơn hàng!');
        return redirect()->route('home');
    }
}
