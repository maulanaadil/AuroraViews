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
 *
 * @package App\Models
 */
class Hak extends Model
{
	protected $table = 'hak';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'id',
		'nama_hak'
	];
}
