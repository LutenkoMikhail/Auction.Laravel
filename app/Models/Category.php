<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];


    /**
     * @return BelongsToMany
     */
    public function lots()
    {
        return $this->belongsToMany(Lot::class)->withTimestamps();
    }

    static public function fullCategories()
    {
        return Category::orderBy('id')->get();
    }
}
