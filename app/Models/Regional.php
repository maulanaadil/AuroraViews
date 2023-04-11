<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Regional
 * 
 * @property int $rgn_id
 * @property string|null $rgn_code
 * @property string|null $rgn_name
 * @property int $of_id
 * @property string|null $of_code
 *
 * @package App\Models
 */
class Regional extends Model
{
	protected $table = 'regional';
	protected $primaryKey = 'rgn_id';
	public $timestamps = false;

	protected $casts = [
		'of_id' => 'int'
	];

	protected $fillable = [
		'rgn_code',
		'rgn_name',
		'of_id',
		'of_code'
	];
}
