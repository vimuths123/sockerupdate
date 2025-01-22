<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_a_id',
        'team_b_id',
        'winner_team_id',
        'team_a_goals',
        'team_b_goals',
        'location',
        'status',
    ];

    /**
     * Relationship with Team A.
     */
    public function teamA()
    {
        return $this->belongsTo(Team::class, 'team_a_id');
    }

    /**
     * Relationship with Team B.
     */
    public function teamB()
    {
        return $this->belongsTo(Team::class, 'team_b_id');
    }

    /**
     * Relationship with the winning team.
     */
    public function winnerTeam()
    {
        return $this->belongsTo(Team::class, 'winner_team_id');
    }
}
