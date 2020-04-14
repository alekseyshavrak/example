<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Airlock\HasApiTokens;

/**
 * An Eloquent Model: 'User'
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'avatar_file_id', 'surname', 'phone', 'password', 'offer', 'description', 'hometown', 'location', 'birthday'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'birthday' => 'date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    /**
     * Get the file avatar for the User.
     *
     */
    public function avatar()
    {
        return $this->belongsTo(File::class, 'avatar_file_id');
    }

    /**
     * Get the expertise for the User.
     *
     */
    public function expertise()
    {
        return $this->belongsToMany(Practice::class)->wherePivot('type', 'expertise');
    }

    /**
     * Get the intersection expertise -> expertise for the User.
     *
     */
    public function intersectionExpertiseExpertise()
    {
        return $this->belongsToMany(Practice::class)
            ->wherePivotIn('practice_id', auth()->user()->expertise->pluck('id'))
            ->wherePivot('type', 'expertise');
    }

    /**
     * Get the intersection expertise -> request for the User.
     *
     */
    public function intersectionExpertiseRequest()
    {
        return $this->belongsToMany(Practice::class)
            ->wherePivotIn('practice_id', auth()->user()->request->pluck('id'))
            ->wherePivot('type', 'expertise');
    }

    /**
     * Get the requests for the User.
     *
     */
    public function request()
    {
        return $this->belongsToMany(Practice::class)->wherePivot('type', 'request');
    }

    /**
     * Get the intersection request -> expertise for the User.
     *
     */
    public function intersectionRequestExpertise()
    {
        return $this->belongsToMany(Practice::class)
            ->wherePivotIn('practice_id', auth()->user()->expertise->pluck('id'))
            ->wherePivot('type', 'request');
    }

    /**
     * Set Filter attribute Phone.
     *
     * @var string
     * @return void
     */
    public function setPhoneAttribute($value): void
    {
        $this->attributes['phone'] = (string) Str::of($value)
            ->replaceMatches('/[^0-9]++/', '')
            ->trim();
    }

    /**
     * Set Filter attribute Name.
     *
     * @var string
     * @return void
     */
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = (string) Str::of($value)
            ->trim();
    }

    /**
     * Set Filter attribute Surname.
     *
     * @var string
     * @return void
     */
    public function setSurnameAttribute($value): void
    {
        $this->attributes['surname'] = (string) Str::of($value)
            ->trim();
    }

    /**
     * Set Filter attribute Offer.
     *
     * @var string
     * @return void
     */
    public function setOfferAttribute($value): void
    {
        $this->attributes['offer'] = (string) Str::of($value)
            ->trim();
    }

    /**
     * Set Filter attribute Description.
     *
     * @var string
     * @return void
     */
    public function setDescriptionAttribute($value): void
    {
        $this->attributes['description'] = (string) Str::of($value)
            ->trim();
    }

    /**
     * Set Filter attribute Hometown.
     *
     * @var string
     * @return void
     */
    public function setHometownAttribute($value): void
    {
        $this->attributes['hometown'] = (string) Str::of($value)
            ->trim();
    }

    /**
     * Set Filter attribute Location.
     *
     * @var string
     * @return void
     */
    public function setLocationAttribute($value): void
    {
        $this->attributes['location'] = (string) Str::of($value)
            ->trim();
    }
}
