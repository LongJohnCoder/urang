<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Cms
 *
 * @property int $id
 * @property string $title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $page_heading
 * @property string $tags
 * @property string $content
 * @property string $background_image
 * @property bool $identifier 0->dry clean page , 1-> wash and fold, 2->corporate page, 3-> tailoring page, 4-> wet cleaning page
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $page_name
 * @method static \Illuminate\Database\Query\Builder|\App\Cms whereBackgroundImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cms whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cms whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cms whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cms whereIdentifier($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cms whereMetaDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cms whereMetaKeywords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cms wherePageHeading($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cms wherePageName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cms whereTags($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cms whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cms whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cms extends Model
{
    //
}
