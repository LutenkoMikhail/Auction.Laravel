<?php

namespace App\Models;

use App\Http\Traits\ModelPaginateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory, ModelPaginateTrait;

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

    /**
     * Checking if a category can be deleted
     *
     * @return bool
     */
    public function canDeleteCategory()
    {
        if ($this->lots->count() === 0) {
            return true;
        } else {
            return false;
        }
    }


}
