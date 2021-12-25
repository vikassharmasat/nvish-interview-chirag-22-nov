<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','permissions'];

    // =============== create relationship for user table ================ //
    public function users()
    {
        return $this->belongsToMany(User::class,'role_users');
    }

    // =============== return boolean for role permission  ================ //

    public function hasAccess(array $permissions)
    {
       foreach ($permissions as $permission) {
           if($this->hasPermission($permission)){
               return true;
           }
       }
       return false;
    }
     // =========================================================== //

    // =============== varify permissions  ================ //

    protected function hasPermission(string $permission)
    {
        $permissions = json_decode($this->permissions,true);
        return $permissions[$permission] ?? false;
    }
    // ==================================================== //
}
