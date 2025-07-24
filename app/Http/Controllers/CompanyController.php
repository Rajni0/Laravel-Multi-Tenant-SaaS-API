<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
     public function index(Request $request)
    {
        return $request->user()->companies()->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'industry' => 'required',
        ]);

        return $request->user()->companies()->create($data);
    }

    public function update(Request $request, Company $company)
    {
        $this->authorizeCompany($company, $request->user());

        $data = $request->validate([
            'name' => 'sometimes',
            'address' => 'sometimes',
            'industry' => 'sometimes',
        ]);

        $company->update($data);
        return $company;
    }

    public function destroy(Request $request, Company $company)
    {
        $this->authorizeCompany($company, $request->user());
        $company->delete();
        return response()->noContent();
    }

    public function setActive(Request $request, Company $company)
    {
        $this->authorizeCompany($company, $request->user());

        $request->user()->update(['active_company_id' => $company->id]);
        return response()->json(['message' => 'Active company set']);
    }

    protected function authorizeCompany(Company $company, $user)
    {
        if ($company->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }
    }
    
}
