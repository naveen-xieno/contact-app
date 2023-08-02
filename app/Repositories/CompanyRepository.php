<?php
namespace App\Repositories;
use App\Models\Company;

class CompanyRepository {
    public function pluck(){

        // return [
        //     1 => ['name' => 'Company One'],
        //     2 => ['name' => 'Company Two'],
        //     3 => ['name' => 'Company Three']
        // ];

        //return Company::orderBy('name')->get();

        $data = [];

        $companies = Company::orderBy('name')->get();

        //$companies = Company::forUser(auth()->user())->orderBy('name')->pluck('name', 'id');

        foreach ($companies as $company) {
            $data[$company->id] = $company->name. " (". $company->contacts()->count() .") ";
        }

        return $data;  

    }

    public function getCompanies(){

        // return [
        //     1 => ['name' => 'Company One'],
        //     2 => ['name' => 'Company Two'],
        //     3 => ['name' => 'Company Three']
        // ];

        //return Company::orderBy('name')->get();

        //$companies = Company::orderBy('name')->pluck('name', 'id');

        $companies = Company::forUser(auth()->user())->orderBy('name')->pluck('name', 'id');

        return $companies; 

    }
}