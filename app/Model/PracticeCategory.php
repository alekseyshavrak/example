<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * An Eloquent Model: 'PracticeCategory'
 *
 * @property integer $id
 * @property string $title
 */
class PracticeCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the Practice for the PracticeCategory.
     *
     */
    public function practices()
    {
        return $this->hasMany(Practice::class, 'category_id');
    }

    /**
     * Set Filter attribute Title.
     *
     * @var string
     * @return void
     */
    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = (string) Str::of($value)
            ->trim();
    }
}
