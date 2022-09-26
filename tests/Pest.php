<?php

use Konnco\FilamentSafelyDelete\Tests\Resources\Pages\ListPost;
use Konnco\FilamentSafelyDelete\Tests\Resources\PostResource;
use Konnco\FilamentSafelyDelete\Tests\TestCase;
use Livewire\Livewire;

uses(TestCase::class)->in(__DIR__);

function livewire()
{
    return Livewire::test(ListPost::class);
}