<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Company;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

   // protected $company;

    /* public function __construct(){
        $this->company = new CompanyRepository();
    } */

    //Other Method to inject Repositry Class in Constructor
   /*  public function __construct(CompanyRepository $company){
        $this->company = $company;
    } */

    //Other Method to inject Repositry Class in Constructor
    // public function __construct(protected CompanyRepository $company){
    // }

    protected function userCompanies()
    {
        return Company::forUser(auth()->user())->orderBy('name')->pluck('name', 'id');
    }

    //Call Repositiry Class in Method Directly
    public function index(CompanyRepository $company, Request $request){

        //Get the Login User
        //dd(Auth::user());
        //dd(Auth::id());
        //dd(Auth::user()->email);
        //dd(auth()->user());
        //dd(auth()->id());
        //dd($request->user());

        // if(Auth::check()){
        //     dd('Sign In');
        // } else {
        //     dd('Guest');
        // }

        // $companies = [
        //     1 => ['name' => 'Company One'],
        //     2 => ['name' => 'Company Two'],
        //     3 => ['name' => 'Company Three']
        // ];

        //Call Method from Repository
        //$companies = $company->pluck();

        $companies = $this->userCompanies(); 

        // echo '<pre>';
        // print_r($companies);
        // echo '</pre>';
        // die;

        //Call method from same class
        //$contacts = $this->getContacts();

        //$contacts = Contact::orderBy('first_name')->get();

        //DB::enableQueryLog();
        
        /* $query = Contact::query();

        if (request()->query('trash')) {
            $query->onlyTrashed();
        } */

        //Pagination
        /* // $contacts = $query->orderBy('first_name')->where(function($query){
        //$contacts = $query->latest()->where(function($query){
            $companyId = request()->query('company_id');

            if($companyId){
                $query->where(['company_id' => $companyId ]);
            }
            
        })->where(function ($query) {
            if ($search = request()->query('search')) {
                $query->where("first_name", "LIKE", "%{$search}%");
                $query->orWhere("last_name", "LIKE", "%{$search}%");
                $query->orWhere("email", "LIKE", "%{$search}%");
            }
        })->paginate(10); */

        $contacts = Contact::allowedTrash() 
            //->allowedSorts('first_name')
            ->allowedSorts(['first_name','last_name', 'email'], "-id")
            ->allowedFilters('company_id')
            //->allowedSearch(['first_name', 'last_name', 'email'])
            ->allowedSearch('first_name', 'last_name', 'email')
            ->forUser(auth()->user())   
            ->paginate(10);

        //dump(DB::getQueryLog());

        // $companyId = request()->query('company_id');

        // if($companyId){

        //     $coompnay = Company::findOrFail($companyId);

        //     dd($coompnay->contacts()->get());
        // }

        //Custom Pagination
        /* $contactsCollection = Contact::orderBy('first_name')->get();

        $perPage = 10;
        $total = $contactsCollection->count();
        
        //Get by request instance
        $currentPage = request()->query('page', 1);
        $items = $contactsCollection->slice( ($currentPage * $perPage) - $perPage, $perPage);

        // parameters will be in same order in same order
        $contacts = new LengthAwarePaginator($items, $total, $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query()
        ]); */

        return view('contacts.index', ['contacts' => $contacts, 'companies' => $companies]);

   }

   /* public function index(){

        // $companies = [
        //     1 => ['name' => 'Company One'],
        //     2 => ['name' => 'Company Two'],
        //     3 => ['name' => 'Company Three']
        // ];

        //Call Method from Repository
        $companies = $this->company->pluck();

        //Call method from same class
        $contacts = $this->getContacts();

        return view('contacts.index', ['contacts' => $contacts, 'companies' => $companies]);

   } */
   
    // protected function getContacts(){
    //     return [
    //         1 => ['name' => 'Name 1', 'phone' => '1234567890'],
    //         2 => ['name' => 'Name 2', 'phone' => '2345678901'],
    //         3 => ['name' => 'Name 3', 'phone' => '3456789012'],
    //     ];
    // }

    public function create(CompanyRepository $company, Request $request){

        //dd($request->is('contacts*'));
        //dd($request->RouteIs('contacts.'));
        //dd($request->url());
        //dd($request->fullUrl());
        //dd($request->method());

        //Instance of Contact CLass
        $contact = new Contact();

        $companies = $company->getCompanies();

        return view('contacts.create', ['companies' => $companies, 'contact' => $contact]);
    }

    public function show($id){
        //$contacts = $this->getContacts();

        $contact = Contact::findOrFail($id);

        //$contact = $this->findContact($id);

        //$contact = Contact::find($id);

        // echo '<pre>';
        // print_r($contact);
        // echo '</pre>';
   
        //abort_if(!isset($contacts[$id]), 404);
        
        //abort_if(empty($contact), 404);

        //abort_unless(isset($contacts[$id]), 404);
    
        return view('contacts.show')->with('contact', $contact);
    }

    //Route Model Binding - Implicit Way (Direct Call the Model with Route)
     /* public function show(Contact $contact){    
        return view('contacts.show')->with('contact', $contact);
    } */

    protected function findContact($id){
        return Contact::findOrFail($id); 
    }


    public function store(ContactRequest $request){
       //public function store(Request $request){
     
        //dd($request->path());
        //dd($request->is('contacts'));
        //dd($request->RouteIs('contacts.*'));
        //dd($request->url());
        //dd($request->fullUrl());
        //dd($request->method());
        //dd($request->IsMethod('post'));
        //dd($request->ip());

        //dd($request->input('first_name'));

        //dd($request->input());

        //dd($request->all());

        //dd($request->collect());

        //dd($request->only('first_name', 'last_name'));

        //dd($request->except('first_name', 'last_name'));

        //dd($request->first_name);

        // if($request->has('first_name')){

        //     dd($request->first_name);
        // }

        // if($request->filled('first_name')){

        //     dd($request->first_name);
        // }

        /* $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id'
        ]); */

        //$request->validate($this->rules());
        //dd($request->all());

        //Contact::create($request->all());
        $request->user()->contacts()->create($request->all());

        return redirect()->route('contacts.index')->with('message', 'Contact has been added successfully');

    }

   /*  protected function rules(){
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id'
        ];
    } */

    public function edit($id, CompanyRepository $company){

        $companies = $company->getCompanies();

        $contact = Contact::findOrFail($id);
        
        return view('contacts.edit')->with('contact', $contact)->with('companies', $companies);
    }

    //public function update(Request $request, $id){
    public function update(ContactRequest $request, $id){

        $contact = Contact::findOrFail($id);

       /* $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id'
        ]); */

        //$request->validate($this->rules());

        //dd($request->all());

        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('message', 'Contact has been updated successfully');

    }

    public function destroy($id){
        $contact = Contact::findOrFail($id);
        $contact->delete();
        //return redirect()->route('contacts.index')->with('message', 'Contact has been removed successfully');

        //If redirect to just one page before
        //return back()->with('message', 'Contact has been removed successfully');
        
        $redirect = request()->query('redirect');

        return ($redirect ? redirect()->route($redirect) : back())
        //return redirect()->route('contacts.index')
            ->with('message', 'Contact has been moved to trash.')
            //->with('undoRoute', route('contacts.restore', $contact->id));
            ->with('undoRoute', $this->getUndoRoute('contacts.restore', $contact));
    }

    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();

        return back()
            ->with('message', 'Contact has been restored from trash.')
            //->with('undoRoute', route('contacts.destroy', $contact->id));
            ->with('undoRoute', $this->getUndoRoute('contacts.destroy', $contact));
    }

    /* public function forceDelete($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();

        return back()
            ->with('message', 'Contact has been removed permanently.');
    } */

    public function forceDelete(Contact $contact)
    {
        //$contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();

        return back()
            ->with('message', 'Contact has been removed permanently.');
    }

    protected function getUndoRoute($name, $resource)
    {
        return request()->missing('undo') ? route($name, [$resource->id, 'undo' => true]) : null;
    }

}
