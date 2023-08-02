<?php

namespace App\Models;

use App\Models\Scopes\AllowedFilterSearch;
use App\Models\Scopes\AllowedSort;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes, AllowedFilterSearch, AllowedSort; 

    //protected $table = 'app_companies';
    //protected $primaryKey = '_id';

    //Mass Assignment

    /* Stop execution and provide error if insert Column data which is not avaialble in the Table */
    //protected $guarded = [''];

    /* Do not Stop execution not provide error if insert Column data which is not avaialble in the Table, wheras skip the new column
    */
    protected $fillable = ['name', 'email', 'address', 'website'];

    public function contacts(){
        return $this->hasMany(Contact::class);
    }

    public function user(){
        return $this->belongsTo(User::class);

    }
}
