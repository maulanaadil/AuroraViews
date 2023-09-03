<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Alasan
 *
 * @property int $alasan_id
 * @property string|null $alasan
 */
class Alasan extends Model
{
    protected $table = 'alasan';

    protected $primaryKey = 'alasan_id';

    public $incrementing = true;

    public $timestamps = false;

    protected $casts = [
        'alasan_id' => 'int',
    ];

    protected $fillable = [
        'alasan',
    ];
}
