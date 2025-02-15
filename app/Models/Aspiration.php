<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aspiration extends Model
{
    use HasFactory;

    protected $table = 'aspirations';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'institution',
        'aspiration',
        'date_occurred',
        'location',
        'status',
        'attachment',
        'user_id',
    ];

    // Generate a unique ID
    public static function generateId(): string
    {
        return 'LA' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }

    // Boot method
    public static function boot()
    {
        parent::boot();

        static::creating(function ($aspiration) {
            $aspiration->slug = static::generateUniqueSlug($aspiration->title);
        });

        // Skip slug regeneration on update
        static::updating(function ($aspiration) {
            if ($aspiration->isDirty('title')) {
                $aspiration->slug = static::generateUniqueSlug($aspiration->title);
            }
        });
    }

    public static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;

        $count = 1;

        // Periksa jika slug sudah ada di database
        while (Aspiration::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getFormattedDateOccurredAttribute()
    {
        return Carbon::parse($this->date_occurred)->format('d M Y');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'selesai' => ['text' => 'Selesai', 'class' => 'bg-green-100 text-green-800'],
            'pending' => ['text' => 'Dalam Proses', 'class' => 'bg-yellow-100 text-yellow-800'],
            'default' => ['text' => 'Pending', 'class' => 'bg-blue-100 text-blue-800'],
        ];

        $status = $badges[$this->status] ?? $badges['default'];

        return "<span class='px-3 py-1 rounded-full text-sm {$status['class']}'>{$status['text']}</span>";
    }

    // Relationship with User model
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Responses::class);
    }
}
