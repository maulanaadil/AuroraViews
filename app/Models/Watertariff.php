<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Watertariff
 * 
 * @property int $wt_id
 * @property int $trfType_id
 * @property int $wt_bottom1
 * @property int $wt_top1
 * @property float $wt_cost1
 * @property int $wt_bottom2
 * @property int $wt_top2
 * @property float|null $wt_cost2
 * @property int $wt_bottom3
 * @property int $wt_top3
 * @property float $wt_cost3
 * @property int $wt_bottom4
 * @property int $wt_top4
 * @property float $wt_cost4
 * @property int|null $wt_bottom5
 * @property int $wt_top5
 * @property float $wt_cost5
 * @property int $wt_isactive
 * @property int|null $dec_id
 * @property int|null $min
 *
 * @package App\Models
 */
class Watertariff extends Model
{
	protected $table = 'watertariff';
	protected $primaryKey = 'wt_id';
	public $timestamps = false;

	protected $casts = [
		'trfType_id' => 'int',
		'wt_bottom1' => 'int',
		'wt_top1' => 'int',
		'wt_cost1' => 'float',
		'wt_bottom2' => 'int',
		'wt_top2' => 'int',
		'wt_cost2' => 'float',
		'wt_bottom3' => 'int',
		'wt_top3' => 'int',
		'wt_cost3' => 'float',
		'wt_bottom4' => 'int',
		'wt_top4' => 'int',
		'wt_cost4' => 'float',
		'wt_bottom5' => 'int',
		'wt_top5' => 'int',
		'wt_cost5' => 'float',
		'wt_isactive' => 'int',
		'dec_id' => 'int',
		'min' => 'int'
	];

	protected $fillable = [
		'trfType_id',
		'wt_bottom1',
		'wt_top1',
		'wt_cost1',
		'wt_bottom2',
		'wt_top2',
		'wt_cost2',
		'wt_bottom3',
		'wt_top3',
		'wt_cost3',
		'wt_bottom4',
		'wt_top4',
		'wt_cost4',
		'wt_bottom5',
		'wt_top5',
		'wt_cost5',
		'wt_isactive',
		'dec_id',
		'min'
	];
}
