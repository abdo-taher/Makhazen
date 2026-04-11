<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SocialMedia
 *
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string|null $icon
 * @property int $active_status
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CustomerSlice extends Model
{
    protected $table = 'customer_slices';

    protected $fillable = [
        'name',
        'status',
    ];

}
