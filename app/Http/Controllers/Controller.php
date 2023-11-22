<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyRequest;
use App\Http\Requests\ChangeRequest;
use App\Models\Taxi;
use App\Models\UserTaxi;
use App\Services\TaxiColorChangingService;
use App\Services\TaxiService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home()
    {
        $taxis = Taxi::all();

        return view('taxi_list', [
            'taxis' => $taxis
        ]);
    }

    public function list()
    {
        return view('taxi_purchased', [
            'userTaxis' => Auth::user()->taxis
        ]);
    }

    public function buy(BuyRequest $request, Taxi $taxi)
    {
        $proccess = TaxiService::validateAndBuy(Auth::user(), $taxi);

        if ($proccess !== true) {
            return redirect()->route('app')->with('error', $proccess);
        }

        return redirect()->route('app')->with('success', 'Вы приобрели машину');
    }

    public function change(ChangeRequest $request, UserTaxi $userTaxi)
    {
        $proccess = TaxiColorChangingService::validateAndChange(Auth::user(), $userTaxi);

        if ($proccess !== true) {
            return redirect()->route('taxi.list')->with('error', $proccess);
        }

        return redirect()->route('taxi.list')->with('success', 'Вы поменяли цвет');
    }
}
