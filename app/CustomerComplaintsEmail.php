<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CustomerComplaintsEmail
 *
 * @property int $id
 * @property string $cover_image
 * @property string $company_info
 * @property string $website_link
 * @property string $address
 * @property int $phone_no
 * @property string $support_email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerComplaintsEmail whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerComplaintsEmail whereCompanyInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerComplaintsEmail whereCoverImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerComplaintsEmail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerComplaintsEmail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerComplaintsEmail wherePhoneNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerComplaintsEmail whereSupportEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerComplaintsEmail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerComplaintsEmail whereWebsiteLink($value)
 * @mixin \Eloquent
 */
class CustomerComplaintsEmail extends Model
{
    //
}
