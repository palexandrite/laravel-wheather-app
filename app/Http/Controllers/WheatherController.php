<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responses\WheatherResponse;

class WheatherController extends Controller
{
    public function askWheather(Request $request)
    {
        $validated = collect($request->validate([
            'city'          => ['string', 'max:20'],
            'language'      => ['string', 'max:20'],
            'measureSystem' => ['in:metric,imperial'],
        ]))->filter(fn ($value) => !empty($value));
    
        return WheatherResponse::ask(
            $validated->get('city'), 
            $validated->get('language'), 
            $validated->get('measureSystem')
        );
    }
}
