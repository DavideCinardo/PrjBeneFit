<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    use HasFactory;
    protected $table = 'players';
    protected $primaryKey = 'codice_tessera';

    public $timestamps = true;

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_player', 'id_player', 'id_team', 'codice_tessera', 'codice_squadra');
    }
}
