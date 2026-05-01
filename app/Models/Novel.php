<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    use HasFactory;

    // Eto yung 'Fillable' command para payagan ng SQL na pumasok yung data mo
    protected $fillable = [
        'title',
        'description',
        'user_id', // Para alam kung sino ang author
    ];

    // Relationship: Ang isang novel ay sa isang user lang
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function chapters()
{
    return $this->hasMany(Chapter::class);
}

}

