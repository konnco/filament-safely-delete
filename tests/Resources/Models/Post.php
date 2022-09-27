<?php

namespace Konnco\FilamentSafelyDelete\Tests\Resources\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $table = 'posts';

    protected $guarded = [];
}
