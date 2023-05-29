<?php

namespace App\Models;

use App\Traits\CarbonParse;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory,
        CarbonParse,
        Sluggable;
    
    protected $fillable = [
        'title',
        'body',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'             => 'title',
                'unique'             => true,
                'onUpdate'           => true,
            ]
        ];
    }

    public function increaseViewCount(): bool
    {
        $this->increment('views', 1);

        return $this->save();
    }

    public function scopePopular($query): Builder
    {
        return $query->where('views', '>=', 500);
    }
}
