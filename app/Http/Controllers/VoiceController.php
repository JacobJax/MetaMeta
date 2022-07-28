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
        // Compose the response
        $response  = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<GetDigits finishOnKey="#" callbackUrl="https://ufxfolbhbt.sharedwithexpose.com/api/dial">';
        $response .= '<Say>Thank you fo calling metmeta. Dial 1 for account registration</Say>';
        $response .= '</GetDigits>';
        $response .= '</Response>';
    }

    public function event()
    {
        $this->dial();
    }
    public function callback(Request $request)
    {
        Log::debug($request);
        $this->dial();
    } 
}
