<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Billing
 * 
 * @property int $bill_id
 * @property Carbon|null $bill_date
 * @property int|null $cust_id
 * @property string $cust_code123
 * @property string|null $cust_code
 * @property string|null $cust_name
 * @property int|null $bill_stand1
 * @property int|null $bill_stand2
 * @property int|null $bill_totalusage
 * @property float|null $bill_usage1
 * @property float|null $bill_usage2
 * @property float|null $bill_usage3
 * @property float|null $bill_usage4
 * @property float|null $bill_usage5
 * @property float|null $bill_cost1
 * @property float|null $bill_cost2
 * @property float|null $bill_cost3
 * @property float|null $bill_cost4
 * @property float|null $bill_cost5
 * @property float|null $bill_nonair
 * @property float|null $bill_adm
 * @property float|null $bill_adm1
 * @property float|null $bill_dwm
 * @property float|null $bill_tax
 * @property float|null $bill_fines
 * @property Carbon|null $bill_paydate
 * @property Carbon|null $bill_paydate1
 * @property Carbon|null $bill_paydatetmp
 * @property string|null $bill_printno
 * @property string|null $bill_barcode
 * @property int $bill_mperiod
 * @property int $bill_yperiod
 * @property int|null $of_id
 * @property int|null $rgn_id
 * @property int|null $block_id
 * @property int|null $loket_id
 * @property int|null $loket_id1
 * @property int|null $bill_regBilling
 * @property int|null $bill_custgrp
 * @property int|null $bill_closed
 * @property int|null $transfered
 * @property int|null $bill_carrier
 * @property int|null $trfType_id
 * @property string|null $trftype_code
 * @property int|null $bill_wmsizeid
 * @property string|null $bill_wmsizecode
 * @property int|null $bill_progressivetariff
 * @property int|null $bill_useadm
 * @property int|null $bill_usedwm
 * @property int|null $bill_usetax
 * @property int|null $bill_userange1only
 * @property int|null $bill_userange12only
 * @property int|null $bill_mergeym
 * @property string|null $bill_inputor
 * @property string|null $bill_cashier
 * @property int|null $decreeId
 * @property int|null $bill_LockedByAdmin
 * @property string|null $block_code
 * @property int|null $is_kolektif
 * @property int|null $id_kolektor
 * @property int|null $is_koreksi
 * @property int|null $is_verify
 * @property int|null $is_updatemeteraiafterdenda
 * @property int|null $bill_usefines
 * @property float|null $bill_pemasanganbaru
 * @property float|null $bill_pemasanganbaru_denda
 * @property float|null $param1
 * @property string|null $param2
 * @property string|null $asmer_longlat
 *
 * @package App\Models
 */
class Billing extends Model
{
	protected $table = 'billing';
	protected $primaryKey = 'bill_id';
	public $timestamps = false;

	protected $casts = [
		'bill_date' => 'date',
		'cust_id' => 'int',
		'bill_stand1' => 'int',
		'bill_stand2' => 'int',
		'bill_totalusage' => 'int',
		'bill_usage1' => 'float',
		'bill_usage2' => 'float',
		'bill_usage3' => 'float',
		'bill_usage4' => 'float',
		'bill_usage5' => 'float',
		'bill_cost1' => 'float',
		'bill_cost2' => 'float',
		'bill_cost3' => 'float',
		'bill_cost4' => 'float',
		'bill_cost5' => 'float',
		'bill_nonair' => 'float',
		'bill_adm' => 'float',
		'bill_adm1' => 'float',
		'bill_dwm' => 'float',
		'bill_tax' => 'float',
		'bill_fines' => 'float',
		'bill_paydate' => 'date',
		'bill_paydate1' => 'date',
		'bill_paydatetmp' => 'date',
		'bill_mperiod' => 'int',
		'bill_yperiod' => 'int',
		'of_id' => 'int',
		'rgn_id' => 'int',
		'block_id' => 'int',
		'loket_id' => 'int',
		'loket_id1' => 'int',
		'bill_regBilling' => 'int',
		'bill_custgrp' => 'int',
		'bill_closed' => 'int',
		'transfered' => 'int',
		'bill_carrier' => 'int',
		'trfType_id' => 'int',
		'bill_wmsizeid' => 'int',
		'bill_progressivetariff' => 'int',
		'bill_useadm' => 'int',
		'bill_usedwm' => 'int',
		'bill_usetax' => 'int',
		'bill_userange1only' => 'int',
		'bill_userange12only' => 'int',
		'bill_mergeym' => 'int',
		'decreeId' => 'int',
		'bill_LockedByAdmin' => 'int',
		'is_kolektif' => 'int',
		'id_kolektor' => 'int',
		'is_koreksi' => 'int',
		'is_verify' => 'int',
		'is_updatemeteraiafterdenda' => 'int',
		'bill_usefines' => 'int',
		'bill_pemasanganbaru' => 'float',
		'bill_pemasanganbaru_denda' => 'float',
		'param1' => 'float'
	];

	protected $fillable = [
		'bill_date',
		'cust_id',
		'cust_code123',
		'cust_code',
		'cust_name',
		'bill_stand1',
		'bill_stand2',
		'bill_totalusage',
		'bill_usage1',
		'bill_usage2',
		'bill_usage3',
		'bill_usage4',
		'bill_usage5',
		'bill_cost1',
		'bill_cost2',
		'bill_cost3',
		'bill_cost4',
		'bill_cost5',
		'bill_nonair',
		'bill_adm',
		'bill_adm1',
		'bill_dwm',
		'bill_tax',
		'bill_fines',
		'bill_paydate',
		'bill_paydate1',
		'bill_paydatetmp',
		'bill_printno',
		'bill_barcode',
		'bill_mperiod',
		'bill_yperiod',
		'of_id',
		'rgn_id',
		'block_id',
		'loket_id',
		'loket_id1',
		'bill_regBilling',
		'bill_custgrp',
		'bill_closed',
		'transfered',
		'bill_carrier',
		'trfType_id',
		'trftype_code',
		'bill_wmsizeid',
		'bill_wmsizecode',
		'bill_progressivetariff',
		'bill_useadm',
		'bill_usedwm',
		'bill_usetax',
		'bill_userange1only',
		'bill_userange12only',
		'bill_mergeym',
		'bill_inputor',
		'bill_cashier',
		'decreeId',
		'bill_LockedByAdmin',
		'block_code',
		'is_kolektif',
		'id_kolektor',
		'is_koreksi',
		'is_verify',
		'is_updatemeteraiafterdenda',
		'bill_usefines',
		'bill_pemasanganbaru',
		'bill_pemasanganbaru_denda',
		'param1',
		'param2',
		'asmer_longlat'
	];
}
