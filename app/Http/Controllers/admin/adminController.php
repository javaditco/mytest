<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class adminController extends Controller
{

	public function index(){

		if (!Storage::disk('local')->exists('data.json')){
			$data = null;
		}else{
			$data_jason = Storage::disk('local')->get('data.json');
			$data = json_decode($data_jason,true);
		}
		// var_dump($data['ProductName']);
		return view('admin/products/manage', compact('data'));
	}


	public function productSubmit(Request $request)
	{
		$this->validate($request, [
			'ProductName' => 'required',
			'Quantity' => 'required',
			'Price' => 'required',
		]);


		if (!Storage::disk('local')->exists('data.json')){
			
			$data = [[
				'ProductName' => $request->ProductName,
				'Quantity' => $request->Quantity,
				'Price' => $request->Price,
				'Datetime' => Carbon::now('utc')->toDateTimeString(),
				'Total' => $request->Quantity*$request->Price,
			]];
			Storage::disk('local')->put('data.json', json_encode($data));
		}else{
			$data_jason = Storage::disk('local')->get('data.json');
			$data = json_decode($data_jason,true);
			array_push($data, [
				'ProductName' => $request->ProductName,
				'Quantity' => $request->Quantity,
				'Price' => $request->Price,
				'Datetime' => Carbon::now('utc')->toDateTimeString(),
				'Total' => $request->Quantity*$request->Price,
			]);
			Storage::disk('local')->put('data.json', json_encode($data));
		}
		
		$total = $request->Quantity*$request->Price;
		$time = Carbon::now('utc')->toDateTimeString();
		echo "
		<tr>
		    <th>$request->ProductName</th>
		    <th>$request->Quantity</th>
		    <th>$request->Price</th>
		    <th>$time</th>
		    <th>$total</th>

		</tr>
		";
		// return redirect(asset('/admin'));
	}

}