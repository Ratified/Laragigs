<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'title',
        'location',
        'email',
        'website',
        'tags',
        'logo',
        'description'
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request()->input('tag') . '%');
        }

        if($filters['search'] ?? false){
            $query->where('title', 'like', '%' . request()->input('search') . '%')
                ->orWhere('description', 'like', '%' . request()->input('search') . '%')
                ->orWhere('tags', 'like', '%' . request()->input('search') . '%');
        }
    }
}
