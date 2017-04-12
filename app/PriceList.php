<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PriceList
 *
 * @property int $id
 * @property int $admin_id
 * @property string $category_id
 * @property string $item
 * @property float $price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $image
 * @property-read \App\Admin $admin
 * @property-read \App\Categories $categories
 * @method static \Illuminate\Database\Query\Builder|\App\PriceList whereAdminId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceList whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceList whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceList whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceList whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceList whereItem($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceList wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceList whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PriceList extends Model
{
    public function categories() {
    	return $this->hasOne('App\Categories', 'id', 'category_id');
    }
    public function admin() {
    	return $this->hasOne('App\Admin', 'id', 'admin_id');
    }
}
