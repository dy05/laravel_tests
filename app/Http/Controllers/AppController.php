<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\FactureProduit;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function __invoke()
    {
        $data = Produit::query()
            ->select([DB::raw('count(DISTINCT produits.id) as facture_number')])
            ->leftJoin('facture_produit', 'produits.id', '=', 'facture_produit.produit_id')
            ->leftJoin('factures', 'factures.id', '=', 'facture_produit.facture_id')
            ->whereYear('factures.created_at', '2022')
            ->groupBy(DB::raw('year(factures.created_at)'))
            ->get()
        ;

        if ($data) {
            $data = $data->toArray();
        }

        dd($data);
    }
}
