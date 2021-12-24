<?php

namespace App\Models;

use http\Message\Body;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
  public $title;
  public $excerpt;
  public $data;
  public $body;
  public $slug;

  /**
   * @param $title
   * @param $excerpt
   * @param $date
   * @param $body
   */
  public function __construct($title, $excerpt, $date, $body, $slug)
  {
    $this->title = $title;
    $this->excerpt = $excerpt;
    $this->data = $date;
    $this->body = $body;
    $this->slug = $slug;
  }

  public static function all()
  {
    return collect(File::files(resource_path("posts")))
      ->map(fn($file) => YamlFrontMatter::parseFile($file))
      ->map(fn($doc) => new Post(
        $doc->title,
        $doc->excerpt,
        $doc->date,
        $doc->body(),
        $doc->slug,
      ));

  }

  public static function find($slug)
  {
    return static::all()->firstWhere('slug', $slug);
  }
}
