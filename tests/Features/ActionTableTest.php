<?php

use Illuminate\Support\Str;
use Konnco\FilamentSafelyDelete\Tables\Actions\RevertableDeleteAction;
use Konnco\FilamentSafelyDelete\Tests\Resources\Models\Post;
use function Pest\Laravel\assertDatabaseCount;

it('can delete with confirmation', function () {
    $post = (new Post)->forceFill(['title' => fake()->title, 'slug' => fake()->slug, 'body' => fake()->text]);
    $post->save();

    livewire()
        ->callTableAction(RevertableDeleteAction::class, $post, data: [
            'name' => $post->title,
        ])->assertHasNoTableActionErrors();

    assertDatabaseCount(Post::class, 0);
});

it('can validate the confirmation name', function () {
    $post = (new Post)->forceFill(['title' => fake()->title, 'slug' => fake()->slug, 'body' => fake()->text]);
    $post->save();

    livewire()
        ->callTableAction(RevertableDeleteAction::class, $post, data: [
            'name' => $post->title.Str::random(2),
        ])->assertHasTableActionErrors();

    assertDatabaseCount(Post::class, 1);
});

//it('can delete with bulk actions and should type member current password', function () {
//});

//it('can change the method into delete rollback functions', function () {
//});

//it('can change the method into delete rollback functions', function () {
//});
