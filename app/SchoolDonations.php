<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SchoolDonations
 *
 * @property int $id
 * @property int $neighborhood_id
 * @property string $school_name
 * @property string $image
 * @property float $pending_money
 * @property float $total_money_gained
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property float $actual_pending_money
 * @property float $actual_total_money_gained
 * @property-read \App\Neighborhood $neighborhood
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolDonations whereActualPendingMoney($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolDonations whereActualTotalMoneyGained($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolDonations whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolDonations whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolDonations whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolDonations whereNeighborhoodId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolDonations wherePendingMoney($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolDonations whereSchoolName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolDonations whereTotalMoneyGained($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolDonations whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SchoolDonations extends Model
{
    public function neighborhood(){
    	return $this->hasOne('App\Neighborhood', 'id' , 'neighborhood_id');
    }
}
