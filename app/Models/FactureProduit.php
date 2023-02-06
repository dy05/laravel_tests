<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureProduit extends Model
{
    use HasFactory;
    protected $table = 'facture_produit';
    protected $guarded = [];
    public $timestamps = false;
}
