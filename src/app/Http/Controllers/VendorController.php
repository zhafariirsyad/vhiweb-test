<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VendorService;
use App\Services\VendorDocumentService;
use App\Enums\VendorStatus;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    protected $vendorService;
    protected $vendorDocumentService;
    protected $productService;

    public function __construct(VendorService $vendorService, VendorDocumentService $vendorDocumentService, ProductService $productService)
    {
        $this->vendorService = $vendorService;
        $this->vendorDocumentService = $vendorDocumentService;
        $this->productService = $productService;
    }

    public function index()
    {
        return view('vendor.register');
    }

    public function register(Request $request){
        $data = $request->validate([
            'company_name' => 'required|string',
            'contact_name' => 'required|string',
            'email' => 'required|email|unique:vendors',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'service_offered_description' => 'required|string',
            'website' => 'nullable|string',
            'password' => 'required|string|min:8',
            'agreement' => 'required',
        ]);

        $data['agreement'] = $request->has('agreement') ? 1 : 0;
        $data['status'] = VendorStatus::PENDING;
        $data['password'] = Hash::make($request->get('password'));

        $vendor = $this->vendorService->createVendor($data);

        if ($request->hasFile('documents')) {
            $this->vendorDocumentService->storeDocuments($vendor->id, $request->file('documents'));
        }

        return back()->with('success', 'Created Successfully.');
    }

    public function getLogin(){
        return view('vendor.auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('vendor')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('vendor.dashboard'));
        }

        return back()->with('error', 'Wrong Credentials.');
    }

    public function logout()
    {
        Auth::guard('vendor')->logout();
        return redirect()->route('vendor.login');
    }

    public function dashboard(){
        $products = $this->productService->getAllProducts();
        return view('vendor.index',[
            'products' => $products
        ]);
    }
}
