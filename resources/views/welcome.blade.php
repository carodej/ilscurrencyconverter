<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ILS Currency Converter</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .form-inline {
            display: flex;
            flex-flow: row wrap;
            align-items: center;
        }

        .form-inline h3 {
            margin: 5px 10px 5px 0;
        }

        .form-inline input,
        .form-inline select {
            vertical-align: middle;
            margin: 5px 10px 5px 0;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .form-inline button {
            padding: 10px 20px;
            background-color: dodgerblue;
            border: 1px solid #ddd;
            color: white;
            cursor: pointer;
        }

        .form-inline button:hover {
            background-color: royalblue;
        }

        @media (max-width: 800px) {
            .form-inline input {
                margin: 10px 0;
            }

            .form-inline {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">ILS Currency Converter</div>

            <form method="POST" class="form-inline"
                action="{{action('CurrencyConverterController@performConversion')}}">
                @csrf
                <h3>From </h3>
                <input required type="number" name="amount" id="amount" placeholder="Enter amount" value="{{$amount}}">

                <select required id="currency-in" name="currencyIn">
                    @if ($currencyIn)
                    <option selected value="{{$currencyIn}}">{{$currencyIn}}</option>
                    @else
                    <option disabled selected value="select">select currency</option>

                    @endif()
                    @foreach($supportedCurrencies as $currency)
                    {{ $currency["code"] }}
                    <option value="{{ $currency["code"] }}">{{ $currency["code"] }}</option>
                    @endforeach

                </select>
                <h3>To</h3>
                <input type="number" disabled placeholder="Result"
                    value="{{$convertedAmount ?  $convertedAmount : 'Result'}}">

                <select required id="currencyOut" name="currencyOut">
                    @if ($currencyIn)
                    <option selected value="{{$currencyOut}}">{{$currencyOut}}</option>
                    @else
                    <option disabled selected value="select">select currency</option>

                    @endif() @foreach($supportedCurrencies as $currency)
                    {{ $currency["code"] }}
                    <option value="{{ $currency["code"] }}">{{ $currency["code"] }}</option>
                    @endforeach
                </select>
                <button type="submit">Convert</button>
            </form>
            @error('currencyIn|currencyOut|amount') {{$message}} @enderror
        </div>
    </div>
</body>

</html>