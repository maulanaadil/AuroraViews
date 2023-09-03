<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hak
 *
 * @property int|null $id
 * @property string|null $nama_hak
 */
class Hak extends Model
{
    protected $table = 'hak';

    public $incrementing = true;

    public $timestamps = false;

    protected $casts = [
        'id' => 'int',
    ];

    protected $fillable = [
        'id',
        'nama_hak',
    ];
}
