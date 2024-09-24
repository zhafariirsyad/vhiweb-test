<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\VendorService;

class AuthController extends Controller
{

    protected $vendorService;

    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;
    }

    public function getLogin(){
        return view('dashboard.auth.login');
    }

    public function postLogin(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->with('error', 'Wrong Credentials.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function dashboard(){
        $countPendingVendors = count($this->vendorService->getPendingVendors());
        return view('dashboard.index',[
            'countPendingVendors' => $countPendingVendors
        ]);
    }
}
