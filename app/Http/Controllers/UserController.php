<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index(){
        $years=Year::all();
        return view('index',compact('years'));
    }
    public function showGenerateCodeForm()
    {
        return view('generate_code');
    }
    public function generateCode(Request $request)
    {
        $hasGeneratedCode = $request->session()->get('hasGeneratedCode', false);

        if ($hasGeneratedCode) {
            $previousCode = $request->session()->get('randomCode');
            return redirect()->back()->withErrors(["You have already generated a code: $previousCode"]);
        }

        $randomCode = DB::table('users')->inRandomOrder()->where('is_active', "0")->where('status', '!=', 'admin')
        ->value('code');

        if (!$randomCode) {
            return redirect()->back()->withErrors(['No codes available.']);
        }

        DB::table('users')->where('code', $randomCode)->update(['is_active' => "1"]);

        $request->session()->put('randomCode', $randomCode);

        $request->session()->put('hasGeneratedCode', true);

        return view('generate_code', ['randomCode' => $randomCode]);
    }
    public function link(){
        return view('link');
    }


}
