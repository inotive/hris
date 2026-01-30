<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use CrudTrait;

    public $model = Post::class;
    public $route = 'posts';
    public $page_title = 'Posts';
    public $action_title = 'Post';

}
