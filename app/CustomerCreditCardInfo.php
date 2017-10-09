<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CustomerCreditCardInfo
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $card_no
 * @property string $card_type
 * @property string $cvv
 * @property string $exp_month
 * @property string $exp_year
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerCreditCardInfo whereCardNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerCreditCardInfo whereCardType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerCreditCardInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerCreditCardInfo whereCvv($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerCreditCardInfo whereExpMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerCreditCardInfo whereExpYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerCreditCardInfo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerCreditCardInfo whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerCreditCardInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerCreditCardInfo whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $card_id
 * @property string|null $card_fingerprint
 * @property string|null $card_country
 * @property string|null $stripe_customer_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerCreditCardInfo whereCardCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerCreditCardInfo whereCardFingerprint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerCreditCardInfo whereCardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CustomerCreditCardInfo whereStripeCustomerId($value)
 */
class CustomerCreditCardInfo extends Model
{
    //
}
