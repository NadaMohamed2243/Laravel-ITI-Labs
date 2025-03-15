<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
class Post extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['title', 'description', 'user_id', 'image'];

    //link the post model to the user model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //if i just change the function name and not follow the naming convention
    //i have to specify the foreign key
    // public function postCreator()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function index(): View
    {
        return view('posts.index', [
            'posts' => DB::table('posts')->paginate(10)
        ]);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                // This updates the slug if the title changes because the default is false
                'onUpdate' => true
            ]
        ];
    }

    // In Post model
    // public function setImageAttribute($value)
    // {
    //     if ($value && $value instanceof \Illuminate\Http\UploadedFile) {
    //         // Delete old image if exists
    //         if (!empty($this->attributes['image'])) {
    //             Storage::disk('public')->delete($this->attributes['image']);
    //         }

    //         // Store new image
    //         $this->attributes['image'] = $value->store('posts', 'public');
    //     }
    // }

    // public function getImageUrlAttribute()
    // {
    //     return $this->image ? Storage::url($this->image) : null;
    // }

    // protected static function booted()
    // {
    //     static::deleting(function ($post) {
    //         if ($post->image) {
    //             Storage::disk('public')->delete($post->image);
    //         }
    //     });
    // }

    public function setImageAttribute($value)
    {
        if (isset($this->attributes['image']) && $value !== $this->attributes['image']) {
            Storage::disk('public')->delete($this->attributes['image']);
        }

        $this->attributes['image'] = $value;
    }

    public function getImageAttribute()
    {
        return isset($this->attributes['image']) ? Storage::url($this->attributes['image']) : null;
    }
}
