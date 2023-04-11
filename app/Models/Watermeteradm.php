<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Watermeteradm
 * 
 * @property int $idx
 * @property int|null $trfType_id
 * @property int|null $dec_id
 * @property int|null $wmsize_id
 * @property float|null $WMA_ADM
 * @property float|null $WMA_DWM
 *
 * @package App\Models
 */
class Watermeteradm extends Model
{
	protected $table = 'watermeteradm';
	protected $primaryKey = 'idx';
	public $timestamps = false;

	protected $casts = [
		'trfType_id' => 'int',
		'dec_id' => 'int',
		'wmsize_id' => 'int',
		'WMA_ADM' => 'float',
		'WMA_DWM' => 'float'
	];

	protected $fillable = [
		'trfType_id',
		'dec_id',
		'wmsize_id',
		'WMA_ADM',
		'WMA_DWM'
	];
}
