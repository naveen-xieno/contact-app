<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $companies = Company::allowedTrash()
              ->AllowedSorts(['name', 'website', 'email'], '-id')
              ->AllowedSearch('name', 'website', 'email')
              ->forUser(auth()->user())
              ->paginate(10);

        return view('companies.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = new Company();

        return view('companies.create', ['company' => $company]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {

        $request->user()->companies()->create($request->all());

        return redirect()->route('companies.index')->with('message', 'Company has been added successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show', ['company'=> $company]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {

        //$company->update($request->all());
        $company->update($request->validated());
        
        return redirect()->route('companies.index')->with('message', 'Company has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        $redirect = request()->query('redirect');

        return ($redirect ? redirect()->route($redirect) : back())
            ->with('message', 'Company has been moved to trash.')
            ->with('undoRoute', $this->getUndoRoute('contacts.restore', $company));

    }

    public function restore(Company $company)
    {
        $company->restore();
        return back()
            ->with('message', 'Company has been restored from trash.')
            ->with('undoRoute', $this->getUndoRoute('companies.destroy', $company));
    }

    /* public function restore($id)
    {
        $company = Company::onlyTrashed()->findOrFail($id);
        $company->restore();

        return back()
            ->with('message', 'Company has been restored from trash.')
            ->with('undoRoute', $this->getUndoRoute('companies.destroy', $company));
    } */

    public function forceDelete(Company $company)
    {
        $company->forceDelete();

        return back()
            ->with('message', 'Company has been removed permanently.');

    }

    protected function getUndoRoute($name, $resource)
    {
        return request()->missing('undo') ? route($name, [$resource->id, 'undo' => true]) : null;
    }
}