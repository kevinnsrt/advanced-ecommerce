<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;

class crud extends Controller
{
    public function create(){

        return view('crud.create');
    }

    public function read(){

        $stock = Stock::all();
        return view('crud.read',compact('stock'));
    }


    public function history(){

        return view('crud.history');
    }

    public function store(Request $request){

        $validation = $request->validate([
            'name' => 'required|max:255',
            'jumlah' => 'required|max:255',
            'harga' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif'
        ]);

        $path = $request->file('image')->store('post-images', 'public');
        $validation['image'] = $path;

        Stock::create($validation);

        return view('dashboard');
    }

    public function update(Request $request){

        $stock = Stock::where('id',$request->id);

        $validation = $request->validate([
            'name' => 'required|max:255',
            'jumlah' => 'required|max:255',
            'harga' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif'
        ]);

        $image = Stock::where('id',$request->id)->value('image');

        Storage::delete("public/$image");

        $path = $request->file('image')->store('post-images', 'public');
        $validation['image'] = $path;

        $stock->update($validation);

        return redirect('dashboard');

    }

    public function edit($id){
        $stock = Stock::findOrFail($id);
        return view('crud.edit',compact('stock'));
    }

    public function delete(Request $request){

        $image = Stock::where('id',$request->id)->value('image');
        Storage::delete("public/$image");

        $stock = Stock::where('id',$request->id);
        $stock->delete();
        return view('dashboard');
    }

    public function home(){
        $stock = Stock::where('jumlah','>',0)->get();

        return view('client',compact('stock'));
    }

    public function cart(){

        $cart = Cart::where('user_id',auth()->id())->get();

        return view('crud.cart',compact('cart'));
    }

    public function cartStore(Request $request){
        $validation = $request->validate([
            'id' => 'required',
            'user_id' => 'required',
            'name' => 'required|max:255',
            'harga' => 'required',
        ]);

        Cart::create($validation);

        return redirect(route('user.cart'));
    }

    public function deleteCart(Request $request){
        Cart::where('id',$request->id)->delete();
        return redirect(route('user.cart'));
    }

    public function order(Request $request){

        $validation = $request->validate([
            'username' => 'required|max:255',
            'pesanan' => 'required|max:255',
            'harga' => 'required',
            'jumlah'=> 'required',
            'status' => 'required',

        ]);


        Order::create($validation);

        Cart::where('id',$request->id)->delete();

        return redirect(route('user.dashboard'));
    }

    public function comeOrder(){
        $order = Order::all();
        return view('crud.history',compact('order'));
    }

    public function userOrder(){
        $order = Order::where('username',auth()->user()->name)->get();
        return view('crud.userOrder',compact('order'));
    }

    public function prosesOrder(Request $request){
        $order = Order::where('id',$request->id);

        $validation = $request->validate([
            'username' => 'required|max:255',
            'pesanan' => 'required|max:255',
            'harga' => 'required',
            'jumlah'=> 'required',
            'status' => 'required',

        ]);

        $order->update($validation);
        return redirect(route('come.order'));
    }


    public function bayarOrder(Request $request){
        $order = Order::where('id',$request->id);

        $validation = $request->validate([
            'username' => 'required|max:255',
            'pesanan' => 'required|max:255',
            'harga' => 'required',
            'jumlah'=> 'required',
            'status' => 'required',

        ]);

        $order->update($validation);
        return redirect(route('user.order'));
    }

    public function confirmOrder(Request $request){

        $validation = $request->validate([
            'username' => 'required|max:255',
            'pesanan' => 'required|max:255',
            'harga' => 'required',
            'jumlah'=> 'required',
            'status' => 'required',

        ]);

        $stock = Stock::where('name',$request->pesanan);

        $stock->update($validation);


        return redirect(route('user.order'));
    }

    public function confirmOrderFinal(Request $request){
        $order = Order::where('id',$request->id);

        $validation = $request->validate([
            'username' => 'required|max:255',
            'pesanan' => 'required|max:255',
            'harga' => 'required',
            'jumlah'=> 'required',
            'status' => 'required',

        ]);

        $stock = Stock::where('name',$request->pesanan)->value('jumlah');

        if($stock > 0){

            Stock::where('name',$request->pesanan)->decrement('jumlah', $request->jumlah);
            $order->update($validation);
            return redirect(route('user.order'));
        }
        else
        return redirect(route('user.order'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');

        $searchResults = Stock::where('name', 'LIKE', "%{$keyword}%")
                     ->orWhere('deskripsi', 'LIKE', "%{$keyword}%")
                     ->orWhere('harga', 'LIKE', "%{$keyword}%")
                     ->paginate(10);

    return view('crud.search', compact('searchResults'));

    }


}
