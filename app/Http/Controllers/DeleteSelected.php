<?php

namespace App\Http\Controllers;

use App\Models\Watermelon;
use Illuminate\Http\Request;

class DeleteSelected extends Controller
{
    public function __invoke(Request $request)
    {
        $selectedValues = $request->input('checkboxes');
        foreach ($selectedValues as $value){
            Watermelon::destroy($value);
        }
        return redirect()->route('watermelon.index');
    }
}
