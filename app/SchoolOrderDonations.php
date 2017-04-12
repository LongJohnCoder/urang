<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SchoolOrderDonations
 *
 * @property int $id
 * @property int $school_id
 * @property int $donation_amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolOrderDonations whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolOrderDonations whereDonationAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolOrderDonations whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolOrderDonations whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolOrderDonations whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SchoolOrderDonations extends Model
{
    // public function neighborhood(){
    // 	return $this->hasOne('App\Neighborhood', 'id' , 'neighborhood_id');
    // }
}
