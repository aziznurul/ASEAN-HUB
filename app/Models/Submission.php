<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'team_name',
        'phone_number',
        'team_members',
        'pdf_path',
        'video_path',
        'score',
        'feedback',
    ];

    protected $casts = [
        'team_members' => 'array', // agar simpan JSON
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Menambahkan relasi dengan model Vote
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    // Mengambil jumlah vote
    public function getVotesCountAttribute()
    {
        return $this->votes()->count();  // Menghitung jumlah vote
    }
}
