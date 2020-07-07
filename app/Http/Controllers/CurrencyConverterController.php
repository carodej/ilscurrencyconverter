<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\CurrencyConverterClient;
use App\Currency;
use Exception;

class CurrencyConverterController extends Controller
{
    protected $client;

    public function __construct(CurrencyConverterClient $client)
    {
        $this->client = $client;
    }

    public function index() {
        return View::make('welcome', array(
            'supportedCurrencies' => Currency::all(),
            'amount'=> null,
            'currencyIn' =>null,
            'currencyOut' => null,
            'convertedAmount' =>  null
				));
    }

    public function performConversion(Request $request)
    {
        $data = request()->validate([
            'amount' => 'required|numeric',
            'currencyIn' => 'required',
            'currencyOut' => 'required',
        ]);
        $rules['currency-in'] = "required";
        $amount = $request->get('amount');
        $baseCurrency = (string) $request->get('currencyIn');
        $toCurrency = (string) $request->get('currencyOut');
        
        try {
            $convertedAmount = $this->client->convertCurrency($amount, $baseCurrency, $toCurrency);

            return View::make('welcome', array(
                'supportedCurrencies' => Currency::all(),
                'amount'=> $amount,
                'currencyIn' => $baseCurrency,
                'currencyOut' => $toCurrency,
                'convertedAmount' =>  $convertedAmount
                    ));
        } catch (Exception $e) {
            return "We could not perform this conversion now, please bear with us";
        }
    }
}