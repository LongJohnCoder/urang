<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

/**
 * App\Staff
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $user_name
 * @property string $password
 * @property int $active
 * @property string $remember_token
 * @method static \Illuminate\Database\Query\Builder|\App\Staff whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Staff whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Staff whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Staff wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Staff whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Staff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Staff whereUserName($value)
 * @mixin \Eloquent
 */
class Staff extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable;
}
