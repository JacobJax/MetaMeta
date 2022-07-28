<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoiceRequest;
use App\Http\Requests\UpdateVoiceRequest;
use App\Models\Call;
use App\Models\Voice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VoiceController extends Controller
{
    public function dial()
    {
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="https://metameta8.herokuapp.com/api/dial_2">';
        $response .= '<Say>Thank you fo calling metmeta. Dial 1 for account registration followed by the hash sign. 2 to check an existing account followed by the hash sign. 3 for billing followed by the hash sign. 4 to talk to an agent followed by the hash sign</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';
        echo $response;

        // $response .= '<GetDigits finishOnKey="#" callbackUrl="https://metameta8.herokuapp.com/api/existing_2">';
        // $response .= '<Say>2 to check an existing account followed by the hash sign</Say>';
        // $response .= '</GetDigits>';
        // $response .= '</Response>';


        // $response .= '<GetDigits finishOnKey="#" callbackUrl="https://metameta8.herokuapp.com/api/billing">';
        // $response .= '<Say>3 for billing followed by the hash sign</Say>';
        // $response .= '</GetDigits>';
        // $response .= '</Response>';


        // $response .= '<GetDigits finishOnKey="#" callbackUrl="https://metameta8.herokuapp.com/api/agent">';
        // $response .= '<Say>4 to talk to an agent followed by the hash sign</Say>';
        // $response .= '</GetDigits>';

    }

    public function agent(Request $request)
    {
        $phone = $request->callerNumber;
        // $call = Call::where('phonenumber', $phone)->first();
        $phone = $request->callerNumber;
        $call = Call::where($phone)->exist();
        if (!$call) {
            $response = '<Say>That account does not exist. Please try again</Say>';
            $response .= '</Response>';
            echo  $response;

            $this->dial();
        }

        $response = '<Say>Thank you, you will receive a text message shortly.</Say>';
        $response .= '</Response>';
        echo  $response;
    }
    public function existing_2(Request $request)
    {
        $phone = $request->callerNumber;
        // $call = Call::where('phonenumber', $phone)->first();
        $phone = $request->callerNumber;
        $call = Call::where($phone)->exist();
        if (!$call) {
            $response = '<Say>That account does not exist. Please try again</Say>';
            $response .= '</Response>';
            echo  $response;

            $this->dial();
        }

        $response = '<Say>Thank you, you will receive a text message shortly.</Say>';
        $response .= '</Response>';
        echo  $response;
    }

    public function billing(Request $request)
    {
        $phone = $request->callerNumber;
        // $call = Call::where('phonenumber', $phone)->first();
        $phone = $request->callerNumber;
        $call = Call::where($phone)->exist();
        if (!$call) {
            $response = '<Say>That account does not exist. Please try again</Say>';
            $response .= '</Response>';
            echo  $response;

            $this->dial();
        }

        $response = '<Say>Thank you, you will receive a text message shortly.</Say>';
        $response .= '</Response>';
        echo  $response;
    }
    public function dial_2(Request $request)
    {
        if ($request->dtmfDigits == 1) {
            $phone = $request->callerNumber;
            $response  = '<?xml version="1.0" encoding="UTF-8"?>';
            $response .= '<Response>';
            $response .= '<GetDigits finishOnKey="#" callbackUrl="https://metameta8.herokuapp.com/api/dial_3">';
            $response .= '<Say>Enter your id number followed by the hash sign.</Say>';
            $response .= '</GetDigits>';
            $response .= '</Response>';

            $call = new Call();
            $call->phonenumber = $phone;
            $call->save();

            echo $response;
        } elseif ($request->dtmfDigits == 2) {
            $this->existing_2($request);
        } elseif ($request->dtmfDigits == 3) {
            $this->billing($request);
        } elseif ($request->dtmfDigits == 4) {
            $this->agent($request);
        }
    }
    public function dial_3(Request $request)
    {
        $phone = $request->callerNumber;
        $idnumber = $request->dtmfDigits;

        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<Say>Thank you for calling Meta meta. You will get an SMS with your account number</Say>';
        $response .= '</Response>';


        $call = Call::where('phonenumber', $phone)->first();
        $call->idnumber = $idnumber;
        $call->save();
        echo $response;
    }

    public function event()
    {
        $this->dial();
    }
    public function callback(Request $request)
    {
        $this->dial();
        Log::debug($request->all());
    }
}
