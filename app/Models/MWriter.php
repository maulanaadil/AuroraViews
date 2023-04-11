<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MWriter
 * 
 * @property int $writer_id
 * @property string|null $writer_user_name
 * @property string|null $writer_name
 * @property string|null $password
 * @property string|null $no_telp
 * @property string|null $alamat
 * @property string|null $photo
 * @property int|null $of_id
 *
 * @package App\Models
 */
class MWriter extends Model
{
	protected $table = 'm_writer';
	protected $primaryKey = 'writer_id';
	public $timestamps = false;

	protected $casts = [
		'of_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'writer_user_name',
		'writer_name',
		'password',
		'no_telp',
		'alamat',
		'photo',
		'of_id'
	];
}
