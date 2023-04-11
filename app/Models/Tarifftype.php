<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarifftype
 * 
 * @property int $trfType_id
 * @property string|null $trfType_code
 * @property string|null $trfType_name
 * @property string|null $trfType_init
 * @property float|null $mwt_id
 * @property float|null $warningUsage1
 * @property float|null $warningUsage2
 * @property float|null $trftype_grp
 * @property float $denda
 *
 * @package App\Models
 */
class Tarifftype extends Model
{
	protected $table = 'tarifftype';
	protected $primaryKey = 'trfType_id';
	public $timestamps = false;

	protected $casts = [
		'mwt_id' => 'float',
		'warningUsage1' => 'float',
		'warningUsage2' => 'float',
		'trftype_grp' => 'float',
		'denda' => 'float'
	];

	protected $fillable = [
		'trfType_code',
		'trfType_name',
		'trfType_init',
		'mwt_id',
		'warningUsage1',
		'warningUsage2',
		'trftype_grp',
		'denda'
	];
}
