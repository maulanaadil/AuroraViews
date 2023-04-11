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
 *
 * @package App\Models
 */
class Alasan extends Model
{
	protected $table = 'alasan';
	protected $primaryKey = 'alasan_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'alasan_id' => 'int'
	];

	protected $fillable = [
		'alasan'
	];
}
