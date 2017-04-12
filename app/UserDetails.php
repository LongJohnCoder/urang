<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserDetails
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $address_line_1
 * @property string $personal_ph
 * @property int $cell_phone
 * @property int $off_phone
 * @property string $spcl_instructions
 * @property string $driving_instructions
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $school_id
 * @property int $social_id
 * @property string $social_network
 * @property string $social_network_name
 * @property string $referred_by
 * @property string $address_line_2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereAddressLine1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereAddressLine2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereCellPhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereDrivingInstructions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereOffPhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails wherePersonalPh($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereReferredBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereSocialId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereSocialNetwork($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereSocialNetworkName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereSpclInstructions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserDetails whereZip($value)
 * @mixin \Eloquent
 */
class UserDetails extends Model
{
    
}
