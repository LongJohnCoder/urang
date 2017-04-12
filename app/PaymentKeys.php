<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PaymentKeys
 *
 * @property int $id
 * @property string $login_id
 * @property string $transaction_key
 * @property bool $mode 1->live , 0->test
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentKeys whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentKeys whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentKeys whereLoginId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentKeys whereMode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentKeys whereTransactionKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PaymentKeys whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PaymentKeys extends Model
{
    //
}
