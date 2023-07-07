<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    protected $with = ['category','author'];

    protected $fillable = ['category_id','slug','title', 'excerpt', 'body'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query)=> 
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
            )
        );
        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn ($query) =>
                $query->where('slug', $category)
            )
        );
        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query->whereHas('author', fn ($query) =>
                $query->where('username', $author)
            )
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}


// use Illuminate\Support\Facades\File;
// use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Spatie\YamlFrontMatter\YamlFrontMatter;

// class Post {

//     public $title;
//     public $excerpt;
//     public $date;
//     public $body;
//     public $slug;

//     public function __construct($title, $excerpt, $date, $body, $slug) {
//         $this->title = $title;
//         $this->excerpt = $excerpt;
//         $this->date = $date;
//         $this->body = $body;
//         $this->slug = $slug;
//     }
//     public static function all()
//     {
//         return cache()->rememberForever('posts.all', function () {
//             return collect(File::files(resource_path("posts")))
//                 ->map(fn($file)=> YamlFrontMatter::parseFile($file))
//                 ->map(fn ($document) => new Post(
//                         $document->title,
//                         $document->excerpt,
//                         $document->date,
//                         $document->body(),
//                         $document->slug,
//                 ))
//                 ->sortByDesc('date');
//         });
//     }

//     public static function find($slug)
//     {
//         return static::all()->firstWhere('slug',$slug);

//     }
//     public static function findOrFail($slug)
//     {
//         $post = static::find($slug);

//         if (! $post){
//             throw new ModelNotFoundException();
//         }
//         return $post;
//     }
// }