<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';
    protected $primaryKey = 'codice_squadra';

    public $timestamps = true;

    public function players(): belongsToMany
    {
        return $this->belongsToMany(Player::class, 'team_player', 'id_team', 'id_player', 'codice_squadra', 'codice_tessera');
    }
}
