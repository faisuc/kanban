<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    use HasFactory;

    const POSITION_GAP = 100000;

    protected $fillable = [
        'owner_id',
        'column_id',
        'title',
        'description',
        'position',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->position = self::query()->where('column_id', $model->column_id)
                ->orderByDesc('position')->first()?->position + self::POSITION_GAP;
        });

        static::addGlobalScope('orderedByPosition', function (Builder $builder) {
            $builder->orderBy('position');
        });
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function column(): BelongsTo
    {
        return $this->belongsTo(Column::class);
    }
}
