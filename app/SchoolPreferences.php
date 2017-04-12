<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SchoolPreferences
 *
 * @property int $id
 * @property int $user_id
 * @property int $school_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\SchoolDonations $schoolDonation
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolPreferences whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolPreferences whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolPreferences whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolPreferences whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SchoolPreferences whereUserId($value)
 * @mixin \Eloquent
 */
class SchoolPreferences extends Model
{
    public function schoolDonation(){
    	return $this->hasOne('App\SchoolDonations', 'id' , 'school_id');
    }
}
