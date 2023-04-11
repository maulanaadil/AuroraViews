<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Watermetersize
 * 
 * @property int $wmz_id
 * @property float|null $wmz_size
 * @property string|null $wmz_code
 * @property float|null $bi_pemel
 *
 * @package App\Models
 */
class Watermetersize extends Model
{
	protected $table = 'watermetersize';
	protected $primaryKey = 'wmz_id';
	public $timestamps = false;

	protected $casts = [
		'wmz_size' => 'float',
		'bi_pemel' => 'float'
	];

	protected $fillable = [
		'wmz_size',
		'wmz_code',
		'bi_pemel'
	];
}
