<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PickUpTime
 *
 * @property int $id
 * @property string $day
 * @property string $opening_time
 * @property string $closing_time
 * @property bool $closedOrNot 0->open , 1->closed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\PickUpTime whereClosedOrNot($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PickUpTime whereClosingTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PickUpTime whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PickUpTime whereDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PickUpTime whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PickUpTime whereOpeningTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PickUpTime whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PickUpTime extends Model
{
    //
}
