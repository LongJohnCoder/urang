<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Neighborhood
 *
 * @property int $id
 * @property int $admin_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $url_slug
 * @property string $page_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property-read \App\Admin $admin
 * @method static \Illuminate\Database\Query\Builder|\App\Neighborhood whereAdminId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Neighborhood whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Neighborhood whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Neighborhood whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Neighborhood whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Neighborhood whereMetaDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Neighborhood whereMetaKeywords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Neighborhood whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Neighborhood wherePageTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Neighborhood whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Neighborhood whereUrlSlug($value)
 * @mixin \Eloquent
 */
class Neighborhood extends Model
{
    public function admin() {
    	return $this->hasOne('App\Admin', 'id', 'admin_id');
    }
}
