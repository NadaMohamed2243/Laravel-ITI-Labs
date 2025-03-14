<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
class Post extends Model
{
    use HasFactory ,Sluggable;
    protected $fillable = ['title', 'description', 'user_id'];

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
}
