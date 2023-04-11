<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MWriterArea
 * 
 * @property int $wr_area_id
 * @property int $writer_id
 * @property int|null $block_id
 * @property int|null $rgn_id
 * @property int|null $of_id
 * @property int|null $tgl_download
 * @property int|null $tgl_max_upload
 *
 * @package App\Models
 */
class MWriterArea extends Model
{
	protected $table = 'm_writer_area';
	protected $primaryKey = 'wr_area_id';
	public $timestamps = false;

	protected $casts = [
		'writer_id' => 'int',
		'block_id' => 'int',
		'rgn_id' => 'int',
		'of_id' => 'int',
		'tgl_download' => 'int',
		'tgl_max_upload' => 'int'
	];

	protected $fillable = [
		'writer_id',
		'block_id',
		'rgn_id',
		'of_id',
		'tgl_download',
		'tgl_max_upload'
	];
}
