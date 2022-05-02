<?php

namespace MarketDragon\Commentable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['body'];

    public function images()
    {
        return $this->morphMany(File::class, 'fileable')
            ->whereIn('mime_type', [
                'image/png',
                'image/jpeg',
                'image/jpg',
                'image/webp',
                'image/svg+xml',
                'image/gif',
            ]);
    }
    /**
     * The model that can be commented
     *
     * @return MorphTo
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * The model who writes the comment
     *
     * @return MorphTo
     */
    public function author(): MorphTo
    {
        return $this->morphTo();
    }

}
