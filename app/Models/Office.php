<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Office
 * 
 * @property int $of_id
 * @property string $of_code
 * @property string $of_name
 * @property string|null $of_telp
 * @property string|null $of_addr
 * @property string|null $of_cp
 * @property int|null $of_type
 * @property string|null $ip
 * @property string|null $db
 * @property int|null $port
 * @property string|null $usernm
 * @property string|null $passwd
 * @property int|null $online
 *
 * @package App\Models
 */
class Office extends Model
{
	protected $table = 'office';
	protected $primaryKey = 'of_id';
	public $timestamps = false;

	protected $casts = [
		'of_type' => 'int',
		'port' => 'int',
		'online' => 'int'
	];

	protected $fillable = [
		'of_code',
		'of_name',
		'of_telp',
		'of_addr',
		'of_cp',
		'of_type',
		'ip',
		'db',
		'port',
		'usernm',
		'passwd',
		'online'
	];
}
