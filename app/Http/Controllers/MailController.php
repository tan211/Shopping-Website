<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use App\Models\Frontend\History;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Frontend\Products;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class MailController extends Controller
{
    //
    public function index() {
        $idUser = Auth::id();
        $users = User::findOrFail($idUser)->first();
        $total = 0;
        $cart = session()->get('Cart');
        $data = [];
        if (session()->has('Cart')) {
            foreach ($cart as $value) {
                $product = Products::where('id', $value['product_id'])->first();
                if ($product) {
                    $data[] = $product->toArray();
                }
            }
        }
        foreach ($data as $value) {
            $qty = 0;
            foreach ($cart as $value1) {
                if ($value1['product_id'] == $value['id']) {
                    $qty = $value1['qty']; 
                    $total += $value1['qty']*$value['price'];
                    break;
                }
            }
        }
        $email = $users->email;
        $name = $users->name;
        $phone = $users->phone;
        $id_user = $users->id;
        $price = $total;
        $cart = session()->get('Cart');
        $data = [];
        if (session()->has('Cart')) {
            foreach ($cart as $value) {
                $product = Products::where('id', $value['product_id'])->first();
                if ($product) {
                    $data[] = $product->toArray();
                }
            }
        }
        $title = [
            'subject' => 'Cambo Tutorial Mail',
            'body' => 'Hello This is my email delivery',
        ];
        try {
            Mail::to($email)->send(new MailNotify($data,$title,$cart,$email,$name));
            $history = new History();
            $history->email = $email;
            $history->phone = $phone;
            $history->name = $name;
            $history->id_user = $id_user;
            $history->price = $price;
            $history->save();
            return response()->json(['Great check your mail box']);
        } catch (Exception $th) {
            dd($th);
            return response()->json(['sorry']);
        }
    }
}
