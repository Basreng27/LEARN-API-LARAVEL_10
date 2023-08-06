<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Komik extends Model
{
    use HasFactory, SoftDeletes;

    protected  $table = 'komik';
    protected $fillable = ['name', 'slug', 'picture', 'last_episode', 'id_genre', 'id_status', 'description'];

    /**
     * Get the genre that owns the Komik
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'id_genre', 'id');
    }

    /**
     * Get the status that owns the Komik
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'id_status', 'id');
    }
}
