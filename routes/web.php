<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Profiler\Profiler;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* function getContacts(){
    return [
        1 => ['name' => 'Name 1', 'phone' => '1234567890'],
        2 => ['name' => 'Name 2', 'phone' => '2345678901'],
        3 => ['name' => 'Name 3', 'phone' => '3456789012'],
    ];
} */

/* Route::get('/', function () {

    // $html = "<h1>
    // <a href='" . route('contacts.index') . "'>All Contacts</a>
    // <a href='" . route('contacts.create') . "'>Create Contacts</a>
    // <a href='" . route('contacts.show', 1) . "'>Show Contacts</a>
    // </h1>";

    // return $html; 
    return view('welcome');
});  */


/* Route::get('/contacts', function () {
    //return "<h1>All Contacts</h1>";

    // $contacts = array(
    //     array('name' => 'Name 1', 'phone' => '1234567890'),
    //     array('name' => 'Name 2', 'phone' => '2345678901'),
    //     array('name' => 'Name 3', 'phone' => '3456789012')
    // );

    // $contacts = [
    //     1 => ['name' => 'Name 1', 'phone' => '1234567890'],
    //     2 => ['name' => 'Name 2', 'phone' => '2345678901'],
    //     3 => ['name' => 'Name 3', 'phone' => '3456789012'],
    // ];

    $companies = [
        1 => ['name' => 'Company One'],
        2 => ['name' => 'Company Two'],
        3 => ['name' => 'Company Three']
    ];

    $contacts = getContacts();

    return view('contacts.index', ['contacts' => $contacts, 'companies' => $companies]);

    //return view('contacts.index')->with('contacts', $contacts);

    // return view('contacts.index', compact('contacts'));

})->name('contacts.index'); */

//Route::get('/', [HomeController::class, 'home']);

/* If Controller have only Method */

Route::get('/', HomeController::class);

//Route::get('/dashboard', DashboardController::class);
//Route::get('/dashboard', DashboardController::class)->middleware(['auth']);

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', DashboardController::class);

    Route::get('/settings/profile-information', ProfileController::class)->name('user-profile-information.edit');

    Route::get('/settings/password', PasswordController::class)->name('user-password.edit');

    Route::resource('/contacts', ContactController::class);

    Route::delete('/contacts/{contact}/restore', [ContactController::class, 'restore'])
        ->name('contacts.restore');

    Route::delete('/contacts/{contact}/force-delete', [ContactController::class, 'forceDelete'])
        ->name('contacts.force-delete')
        ->withTrashed();

    Route::resource('/companies', CompanyController::class);
    Route::delete('/companies/{company}/restore', [CompanyController::class, 'restore'])
        ->name('companies.restore')
        ->withTrashed();
        
    Route::delete('/companies/{company}/force-delete', [CompanyController::class, 'forceDelete'])
        ->name('companies.force-delete')
        ->withTrashed();

    Route::resources([
        '/tags' => TagController::class,
        '/tasks' => TaskController::class
    ]);
    Route::resource('/activities', ActivityController::class)->except([
        'create', 'show', 'index', 'destroy'
    ]);

});

/* Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store'); 
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::get('/contacts/{id}', [ContactController::class, 'show'])->whereNumber('id')->name('contacts.show');

Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->whereNumber('id')->name('contacts.edit');

Route::put('/contacts/{id}', [ContactController::class, 'update'])->whereNumber('id')->name('contacts.update');
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->whereNumber('id')->name('contacts.destroy'); */

/* Route::resource('/contacts', ContactController::class);

Route::delete('/contacts/{contact}/restore', [ContactController::class, 'restore'])->name('contacts.restore'); */
// Route::delete('/contacts/{contact}/force-delete', [ContactController::class, 'forceDelete'])->name('contacts.force-delete');

/* // Route Binding Model
Route::delete('/contacts/{contact}/force-delete', [ContactController::class, 'forceDelete'])
    ->name('contacts.force-delete')
    ->withTrashed();*/

//Resource Controller
//Route::resource('/companies', CompanyController::class);


/* //Multiple Resources in one Route
Route::resources([
    '/tags' => TagController::class,
    '/tasks' => TaskController::class
]); 

//Resource Controller with Partial Methods (Only, Except)
/* Route::resource('/activities', ActivityController::class)->only([
    'create', 'show', 'index', 'destroy'
]); */

/* Route::resource('/activities', ActivityController::class)->except([
    'create', 'show', 'index', 'destroy'
]); */

//Change Route Names for Views
/* Route::resource('/activities', ActivityController::class)->names([
    'index' => 'activities.all',
    'show' => 'activities.view'
]); */

//Change Route Parameters for Views
/* Route::resource('/activities', ActivityController::class)->parameters([
    'activities' => 'active'
]); */

/* We can group the Controller If its uses same

Route::controller(ContactController::class)->name('contacts.')->group(function(){
    Route::get('/contacts', 'index')->name('index');
    Route::get('/contacts/create', 'create')->name('create');
    Route::get('/contacts/{id}', 'show')->whereNumber('id')->name('show');

});  */


/* Route::get('/contacts/create', function () {
    //return "<h1>Create New Contact</h1>";
    return view('contacts.create');

})->name('contacts.create'); */

/* Route::get('/contacts/{id}', function ($id) {

     //return "Contacts " . $id;

    $contacts = getContacts();

    //abort_if(!isset($contacts[$id]), 404);

    abort_unless(isset($contacts[$id]), 404);

    $contact = $contacts[$id];

    return view('contacts.show')->with('contact', $contact);

})->whereNumber('id')->name('contacts.show'); */


/* Route::prefix('admin')->group(function(){

    Route::get('/contacts', function(){
        return "<h1>All Contacts</h1>";
    })->name('contacts.index');
    
    Route::get('/contacts/create', function(){
        return "<h1>Create New Contact</h1>";
    })->name('contacts.create');

    Route::get('/contact/{id}', function($id){
        return "Contacts ".$id;
    })->whereNumber('id')->name('contacts.show');
    
}); */

/* Route::get('/contact/{id}', function($id){
    return "Contacts ".$id;
})->where('id', '[0-9]+');

Route::get('/companies/{name?}', function($name = null){
    if($name){
        return "Companies ".$name;
    } else {
        return "All Companies";
    }
})->where('name', '[a-zA-Z]+'); */


Route::get('/companies/{name?}', function ($name = null) {
    if ($name) {
        return "Companies " . $name;
    } else {
        return "All Companies";
    }
})->whereAlphaNumeric('name');

//Fallback for 404 Error Page
Route::fallback(function () {
    return "<h1>Sorry, the page does not exist</h1>";
});

// Route::get('/download', function(){
//  return Storage::download('myfile.txt');
// });