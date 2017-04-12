<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SiteConfig
 *
 * @property int $id
 * @property string $site_title
 * @property string $site_url
 * @property string $site_email
 * @property string $meta_keywords
 * @property string $meta_description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereMetaDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereMetaKeywords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereSiteEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereSiteTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereSiteUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SiteConfig whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SiteConfig extends Model
{
    //
}
