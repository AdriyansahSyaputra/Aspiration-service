<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Responses extends Model
{
    protected $table = 'responses';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'aspiration_id',
        'subject',
        'response',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function aspiration(): BelongsTo
    {
        return $this->belongsTo(Aspiration::class);
    }
}
