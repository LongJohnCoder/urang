<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Categories
 *
 * @property int $id
 * @property string $name
 * @property string $images
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PriceList[] $pricelists
 * @method static \Illuminate\Database\Query\Builder|\App\Categories whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Categories whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Categories whereImages($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Categories whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Categories whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Categories extends Model
{
    public function pricelists()
    {
    	return $this->hasMany('App\PriceList','category_id','id');
    }
}
