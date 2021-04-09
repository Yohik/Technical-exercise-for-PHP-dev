<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCompanies() {
        $user = Auth::user();
        return response()->json($user::find($user->id)->commpanies);
    }

    public function addCompany(Request $request) {
        $this->validate($request, [
            'title'       => 'required|string',
            'phone'       => 'required|string',
            'description' => 'required|string',
        ]);
        try {
            $user = Auth::user();
            $company = new Company();

            $company->title = $request->input('title');
            $company->phone = $request->input('phone');
            $company->description = $request->input('description');
            $company->user_id = $user->id;
            $company->save();

            return response()->json(['company' => $company, 'message' => 'CREATED'], 201);
        } catch(\Exception $e) {
            return response()->json(['message' => 'Failed!'], 409);
        }
    }
}
