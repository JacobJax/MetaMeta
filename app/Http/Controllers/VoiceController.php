<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoiceRequest;
use App\Http\Requests\UpdateVoiceRequest;
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
        $response .= '<Say>Thank you fo calling metmeta. Dial 1 for account registration followed by the hash sign</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';
    }

    public function dial_2()
    {
        
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="https://metameta8.herokuapp.com/api/dial_3">';
        $response .= '<Say>Enter your id number followed by the hash sign.</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';
    }
    public function dial_3()
    {
        
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="https://metameta8.herokuapp.com/api/dial_3">';
        $response .= '<Say>Enter your id number followed by the hash sign.</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';
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
