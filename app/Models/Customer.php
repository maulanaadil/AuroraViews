<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * 
 * @property int $cust_id
 * @property string $cust_code123
 * @property int|null $cust_code
 * @property string|null $cust_name
 * @property string|null $cust_address
 * @property string|null $cust_telp
 * @property string|null $cust_hp
 * @property int $trfType_id
 * @property int|null $cust_numofoccupants
 * @property int|null $cust_numoftaps
 * @property string|null $cust_wmno
 * @property int $cust_wmsizeid
 * @property int $wm_id
 * @property Carbon|null $cust_installdate
 * @property string|null $cust_wmsn
 * @property int|null $diangsur
 * @property Carbon|null $cust_balancedate
 * @property float|null $cust_balancebp
 * @property float|null $cust_dp
 * @property int|null $cust_factorbp
 * @property int $cust_status
 * @property float|null $cust_guarantee
 * @property int|null $cust_isgoodwater
 * @property int|null $cust_standmtr
 * @property Carbon|null $cust_activedate
 * @property int $cgroup_id
 * @property int|null $of_id
 * @property int|null $rgn_id
 * @property int|null $block_id
 * @property int|null $cust_justrecognition
 * @property int|null $cust_useadm
 * @property int|null $cust_usedwm
 * @property int|null $cust_usetax
 * @property int|null $transfered
 * @property string|null $op
 * @property Carbon|null $real_input
 * @property string|null $geo_long
 * @property string|null $geo_lat
 * @property int|null $status_photo
 * @property int|null $jum_blntunggak
 * @property int|null $bln_awaltunggak
 * @property int|null $thn_awaltunggak
 * @property int|null $rata2
 * @property Carbon|null $cust_daftar
 * @property string|null $cust_noregister
 * @property string|null $trftype_code
 * @property float|null $besaran_angsuran
 * @property int|null $id_kolektor
 * @property float|null $biaya_cicilanperbln
 * @property int|null $sisa_cicilan
 * @property float|null $besaran_cicilan
 * @property string|null $cust_kecamatan
 * @property string|null $cust_kelurahan
 *
 * @package App\Models
 */
class Customer extends Model
{
	protected $table = 'customer';
	protected $primaryKey = 'cust_id';
	public $timestamps = false;

	protected $casts = [
		'cust_code' => 'int',
		'trfType_id' => 'int',
		'cust_numofoccupants' => 'int',
		'cust_numoftaps' => 'int',
		'cust_wmsizeid' => 'int',
		'wm_id' => 'int',
		'cust_installdate' => 'date',
		'diangsur' => 'int',
		'cust_balancedate' => 'date',
		'cust_balancebp' => 'float',
		'cust_dp' => 'float',
		'cust_factorbp' => 'int',
		'cust_status' => 'int',
		'cust_guarantee' => 'float',
		'cust_isgoodwater' => 'int',
		'cust_standmtr' => 'int',
		'cust_activedate' => 'date',
		'cgroup_id' => 'int',
		'of_id' => 'int',
		'rgn_id' => 'int',
		'block_id' => 'int',
		'cust_justrecognition' => 'int',
		'cust_useadm' => 'int',
		'cust_usedwm' => 'int',
		'cust_usetax' => 'int',
		'transfered' => 'int',
		'real_input' => 'date',
		'status_photo' => 'int',
		'jum_blntunggak' => 'int',
		'bln_awaltunggak' => 'int',
		'thn_awaltunggak' => 'int',
		'rata2' => 'int',
		'cust_daftar' => 'date',
		'besaran_angsuran' => 'float',
		'id_kolektor' => 'int',
		'biaya_cicilanperbln' => 'float',
		'sisa_cicilan' => 'int',
		'besaran_cicilan' => 'float'
	];

	protected $fillable = [
		'cust_code123',
		'cust_code',
		'cust_name',
		'cust_address',
		'cust_telp',
		'cust_hp',
		'trfType_id',
		'cust_numofoccupants',
		'cust_numoftaps',
		'cust_wmno',
		'cust_wmsizeid',
		'wm_id',
		'cust_installdate',
		'cust_wmsn',
		'diangsur',
		'cust_balancedate',
		'cust_balancebp',
		'cust_dp',
		'cust_factorbp',
		'cust_status',
		'cust_guarantee',
		'cust_isgoodwater',
		'cust_standmtr',
		'cust_activedate',
		'cgroup_id',
		'of_id',
		'rgn_id',
		'block_id',
		'cust_justrecognition',
		'cust_useadm',
		'cust_usedwm',
		'cust_usetax',
		'transfered',
		'op',
		'real_input',
		'geo_long',
		'geo_lat',
		'status_photo',
		'jum_blntunggak',
		'bln_awaltunggak',
		'thn_awaltunggak',
		'rata2',
		'cust_daftar',
		'cust_noregister',
		'trftype_code',
		'besaran_angsuran',
		'id_kolektor',
		'biaya_cicilanperbln',
		'sisa_cicilan',
		'besaran_cicilan',
		'cust_kecamatan',
		'cust_kelurahan'
	];
}
