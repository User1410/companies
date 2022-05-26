<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        return response()->json(Company::paginate(10));
    }

    public function store(StoreCompanyRequest $request)
    {
        $validated = $request->validated();

        $filepath = $this->storeInPublic($request->file('logo'));

        $company = Company::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'logo' => $filepath,
            'website' => $request->input('website')
        ]);

        return response()->json(['success' => "Company \"$company->name\" was created successfuly"]);
    }

    public function update(Company $company, StoreCompanyRequest $request)
    {
        $validated = $request->validated();

        $filepath = $this->storeInPublic($request->file('logo'));

        $company->update([
            'name' => $request->input('name'), 
            'email' => $request->input('email'),
            'logo' => $filepath,
            'website' => $request->input('website')
        ]);

        return response()->json(['success' => 'Company updated successfuly']);
    }

    public function destroy(Company $company)
    {
        $companyName = $company->name;

        $company->delete();

        return response()->json(['success' => "Company \"$companyName\" was deleted successfuly"]);
    }

    private function storeInPublic($file)
    {
        if($file){
            $filepath = Storage::putFile('public', $file, 'public');
            $filepath = str_replace('public', 'storage', $filepath);
        }

        return $filepath ?? null;
    }
}
