<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Decree
 * 
 * @property int $dec_id
 * @property string|null $dec_no
 * @property Carbon|null $dec_date
 * @property Carbon|null $dec_activedate
 * @property int|null $dec_active
 *
 * @package App\Models
 */
class Decree extends Model
{
	protected $table = 'decree';
	protected $primaryKey = 'dec_id';
	public $timestamps = false;

	protected $casts = [
		'dec_date' => 'date',
		'dec_activedate' => 'date',
		'dec_active' => 'int'
	];

	protected $fillable = [
		'dec_no',
		'dec_date',
		'dec_activedate',
		'dec_active'
	];
}
