<?php

namespace App\Models;

use App\Http\Requests\StoreLotRequest;
use App\Http\Requests\UpdateLotRequest;
use App\Http\Traits\ModelPaginateTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lot extends Model
{
    use HasFactory, ModelPaginateTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];


    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }


    /**
     * Return count categories
     *
     * @return false|int
     */
    public function checkCategories()
    {
        $categories = $this->categories()->count();

        if ($categories !== 0) {
            return $categories;
        } else {
            return false;
        }
    }
}
