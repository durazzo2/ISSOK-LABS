<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'date',
        'organizer_id',
    ];

    // Еден настан припаѓа на еден организатор
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}
