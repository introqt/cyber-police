<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Client;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;

class ClientPageController extends Controller
{
    /**
     * Show the service ordering form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Главная',
        ];
        return view('welcome', $data);
    }

//    public function makeOrder(OrderRequest $request)
//    {
//        $client = Client::firstOrCreate(
//            ['name' => $request->name],
//            ['email' => $request->email]
//        );
//        Order::create([
//            'client_id' => $client->id,
//            'service_id' => $request->service
//        ]);
//
//        return redirect('/')->with('status', 'Заказ успешно сохранен!');
//    }
}
