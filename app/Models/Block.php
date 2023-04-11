<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Block
 * 
 * @property int $block_id
 * @property string|null $block_code
 * @property string|null $block_name
 * @property int|null $rgn_id
 * @property int|null $of_id
 * @property string|null $rgn_code
 * @property string|null $of_code
 * @property int|null $writer_Id
 *
 * @package App\Models
 */
class Block extends Model
{
	protected $table = 'blocks';
	protected $primaryKey = 'block_id';
	public $timestamps = false;

	protected $casts = [
		'rgn_id' => 'int',
		'of_id' => 'int',
		'writer_Id' => 'int'
	];

	protected $fillable = [
		'block_code',
		'block_name',
		'rgn_id',
		'of_id',
		'rgn_code',
		'of_code',
		'writer_Id'
	];
}
