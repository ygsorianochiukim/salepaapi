<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LotAvailabilitiesController extends Controller
{
    public function getLotAvailability(Request $request)
    {
        $dateAsOf = $request->get('as_of', now()->toDateString());
        $lots = DB::connection('mysql_secondary')
            ->table('mp_i_lot as lot')
            ->join('mp_i_lottype as lottype', 'lottype.mp_i_lottype_id', '=', 'lot.mp_i_lottype_id')
            ->leftJoin('mp_l_preownership as preown', function ($join) {
                $join->on('preown.mp_i_lot_id', '=', 'lot.mp_i_lot_id')
                    ->where(function ($q) {
                        $q->whereNull('preown.is_cancelled')
                          ->orWhere('preown.is_cancelled', '=', 0);
                    })
                    ->where(function ($q) {
                        $q->whereNull('preown.is_forfeited')
                          ->orWhere('preown.is_forfeited', '=', 0);
                    })
                    ->where(function ($q) {
                        $q->whereNull('preown.is_transferred')
                          ->orWhere('preown.is_transferred', '=', 0);
                    });
            })
            ->whereNull('preown.mp_l_preownership_id')
            ->where('lot.is_active', 1)
            ->where('lottype.type', 'not like', '%DEACTIVATED%')
            ->select([
                'lottype.type',
                'lot.mp_i_lot_id',
                'lot.phase_no',
                'lot.area_no',
                'lot.block_no',
                'lot.lot_no',
                DB::raw("'AVAILABLE LOT' AS buyer_name"),
                DB::raw("'AVAILABLE' AS status")
            ])
            ->orderBy('lot.phase_no')
            ->orderBy('lot.block_no')
            ->orderBy('lot.lot_no')
            ->get();

        return response()->json($lots);
    }
}
