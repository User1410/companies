<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\CompanyCreated;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Company::class, 'company');
    }

    public function index()
    {
        return CompanyResource::collection(Company::paginate(10));
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

        Auth::user()->notify(new CompanyCreated($company));

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
