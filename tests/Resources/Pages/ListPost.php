<?php

namespace Konnco\FilamentSafelyDelete\Tests\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentSafelyDelete\Tests\Resources\PostResource;

class ListPost extends ListRecords
{
    protected static string $resource = PostResource::class;
}
