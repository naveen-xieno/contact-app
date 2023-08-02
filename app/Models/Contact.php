<?php

namespace App\Models;

use App\Models\Scopes\AllowedFilterSearch;
use App\Models\Scopes\AllowedSort;
use App\Models\Scopes\SimpleSoftDeletes;
use App\Models\Scopes\SimpleSoftDeletingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuild; 
use Illuminate\Database\Eloquent\Builder; 

class Contact extends Model
{
    //use HasFactory, SoftDeletes;
    //use HasFactory, SimpleSoftDeletes;
    use HasFactory, SoftDeletes, AllowedFilterSearch, AllowedSort; 
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'company_id'];

    public function company(){

        // return $this->belongsTo(Company::class);
        return $this->belongsTo(Company::class)->withTrashed();

    }

    public function tasks(){

        return $this->hasMany(Task::class); 

    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    /* public static function booted(){

        static::addGlobalScope(new SimpleSoftDeletingScope);

        // static::addGlobalScope('softDeletes', function(Builder $builder){

           // $builder->whereNull('deleted_at');

       // }); 

    } */

    //New Local Scope
    /* public function scopeSortByNameAlpha(Builder $query) 
    {
        return $query->orderBy('first_name'); 
    } */

    //Local Dynamic Scope
    /* public function scopeAllowedSorts(Builder $query, string $column) 
    {
        return $query->orderBy($column); 
    } */

    //New Local Scope
     /* public function scopeFilterByCompany(Builder $query)
    {
        if ($companyId = request()->query("company_id")) {
            $query->where("company_id", $companyId);
        }
        return $query;
    } */

    /* public function scopeAllowedFilters(Builder $query, string $key) 
    {
        if ($companyId = request()->query( $key)) {
            $query->where($key, $companyId);
        }
        return $query;
    }


    public function scopeAllowedFilters(Builder $query, ...$keys)
    {
        foreach ($keys as $key) {
            if ($value = request()->query($key)) {
                $query->where($key, $value);
            }
        }
        return $query;
    }

    public function scopeAllowedSearch(Builder $query, ...$keys)
    {
        if ($search = request()->query('search')) {
            foreach ($keys as $index => $key) {
                $method = $index === 0 ? 'where' : 'orWhere';
                $query->{$method}($key, "LIKE", "%{$search}%");
            }
        }
        return $query;
    }


    public function scopeAllowedSearch(Builder $query, array $keys)
    {
        if ($search = request()->query('search')) {
            foreach ($keys as $index => $key) {
                $method = $index === 0 ? 'where' : 'orWhere';
                $query->{$method}($key, "LIKE", "%{$search}%");
            }
        }
        return $query;
    }

    public function scopeAllowedTrash(Builder $query)
    {
        if (request()->query('trash')) {
            $query->onlyTrashed();
        }
        return $query;
    } */
}
