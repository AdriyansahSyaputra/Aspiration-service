<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aspiration extends Model
{
    protected $table = 'aspirations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'title',
        'institution',
        'aspiration',
        'date_occurred',
        'location',
        'attachment',
        'user_id',
    ];

    // Generate a unique ID
    public static function generateId(): string
    {
        return 'LA' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }

    // Relationship with User model
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
