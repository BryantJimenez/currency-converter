<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Account extends Model
{
    use SoftDeletes, HasSlug;

    protected $fillable = ['number', 'slug', 'bank', 'state', 'user_id'];

    /**
     * Get the state.
     *
     * @return string
     */
    public function getStateAttribute($value)
    {
        if ($value=='1') {
            return 'Activo';
        } elseif ($value=='0') {
            return 'Inactivo';
        }
        return 'Desconocido';
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $account=$this->with(['user' => function($query) {
            $query->withTrashed();
        }])->where($field, $value)->first();
        if (!is_null($account)) {
            return $account;
        }

        return abort(404);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('number')->saveSlugsTo('slug')->slugsShouldBeNoLongerThan(191)->doNotGenerateSlugsOnUpdate();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
