<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Faq
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property string $image
 * @property int $admin_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Admin $admin_details
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereAdminId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereAnswer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereQuestion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Faq whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Faq extends Model
{
    public function admin_details() {
    	return $this->hasOne('App\Admin', 'id', 'admin_id');
    }
}
