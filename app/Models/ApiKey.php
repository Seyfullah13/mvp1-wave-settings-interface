<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    // Indiquez le nom de la table si nécessaire, sinon Laravel le devinera
    protected $table = 'api_keys';

    // Les champs qui peuvent être remplis
    protected $fillable = ['name', 'key', 'last_used_at'];

    // Si vous n'avez pas de colonnes "updated_at" et "created_at" dans la table
    public $timestamps = true;

    // Si vous avez des relations avec d'autres modèles, ajoutez-les ici
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
