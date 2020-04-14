<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'extra' => 'json',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->filename = uniqid() . '.jpg';
        });
    }

    /**
     * Return path for filename
     *
     * @return string
     */
    public function path(): string
    {
        return (string) Str::of($this->type)->replace('.', DIRECTORY_SEPARATOR)
            ->append(DIRECTORY_SEPARATOR, $this->filename);
    }

    /**
     * Get  path for filename
     *
     * @return string
     */
    public function url(): string
    {
        return Storage::drive($this->driver)->url($this->path());
    }
}
