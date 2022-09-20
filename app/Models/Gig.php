<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gig extends Model
{
    use HasFactory;

    protected $fillable = ["company", "title", "location", "email", "tags", "website", "description", "logo", "user_id"];

    public function scopeFilter($query, array $filters) {
        if($filters["tag"] ?? false){
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters["search"] ?? false){
            $query->where('company', 'like', '%' . request('search') . '%')
                  ->orwhere('title', 'like', '%' . request('search') . '%')
                  ->orWhere('description', 'like', '%' . request('search') . '%')
                  ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }
    
    // relationship with user
    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
