![Screenshot of Login](./art/screenshot.png)

# Filament Confirm Delete

<a href="https://filamentadmin.com/docs/2.x/admin/installation">
    <img alt="FILAMENT 2.x" src="https://img.shields.io/badge/FILAMENT-2.x-EBB304">
</a>
<a href="https://packagist.org/packages/konnco/filament-safely-delete">
    <img alt="Packagist" src="https://img.shields.io/packagist/v/konnco/filament-safely-delete.svg?logo=packagist">
</a>
<a href="https://packagist.org/packages/konnco/filament-safely-delete">
    <img alt="Downloads" src="https://img.shields.io/packagist/dt/konnco/filament-safely-delete.svg" >
</a>

[![Code Styles](https://github.com/konnco/filament-safely-delete/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/konnco/filament-safely-delete/actions/workflows/php-cs-fixer.yml)
[![run-tests](https://github.com/konnco/filament-safely-delete/actions/workflows/run-tests.yml/badge.svg)](https://github.com/konnco/filament-safely-delete/actions/workflows/run-tests.yml)

This plugin is intended for those of you who are worried about your data being accidentally deleted.

## Installation

You can install the package via composer:

```bash
composer require konnco/filament-safely-delete
```

## Usage

import the actions into the `Resource` page

```php
use Konnco\FilamentSafelyDelete\Tables\Actions\RevertableDeleteAction;

class PostResource extends Resource
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('body'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make()
                    ->usingField('title')
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
```

### Undo Delete
You can also use to delete undo in your resource.

```php
use Konnco\FilamentSafelyDelete\Tables\Actions\RevertableDeleteAction;

class PostResource extends Resource
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('body'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                RevertableDeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
```

and implementing `HasRevertableRecord` traits in your `ListRecords`
```php
use Konnco\FilamentSafelyDelete\Pages\Concerns\HasRevertableRecord;

class ListBlogPosts extends ListRecords
{
    use HasRevertableRecord;
```


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/konnco/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

### Contributors

<table>
<tr>
    <td align="center" style="word-wrap: break-word; width: 150.0; height: 150.0">
        <a href=https://github.com/frankyso>
            <img src=https://avatars.githubusercontent.com/u/5705520?v=4 width="100;"  style="border-radius:50%;align-items:center;justify-content:center;overflow:hidden;padding-top:10px" alt=Franky So/>
            <br />
            <sub style="font-size:14px"><b>Franky So</b></sub>
        </a>
    </td>
    <td align="center" style="word-wrap: break-word; width: 150.0; height: 150.0">
        <a href=https://github.com/thyseus>
            <img src=https://avatars.githubusercontent.com/u/654271?v=4 width="100;"  style="border-radius:50%;align-items:center;justify-content:center;overflow:hidden;padding-top:10px" alt=Herbert Maschke/>
            <br />
            <sub style="font-size:14px"><b>Herbert Maschke</b></sub>
        </a>
    </td>
    <td align="center" style="word-wrap: break-word; width: 150.0; height: 150.0">
        <a href=https://github.com/ijalnasution>
            <img src=https://avatars.githubusercontent.com/u/17308059?v=4 width="100;"  style="border-radius:50%;align-items:center;justify-content:center;overflow:hidden;padding-top:10px" alt=abangijal/>
            <br />
            <sub style="font-size:14px"><b>abangijal</b></sub>
        </a>
    </td>
</tr>
</table>

<!-- readme: contributors -start -->
<table>
<tr>
    <td align="center">
        <a href="https://github.com/frankyso">
            <img src="https://avatars.githubusercontent.com/u/5705520?v=4" width="100;" alt="frankyso"/>
            <br />
            <sub><b>Franky So</b></sub>
        </a>
    </td>
    <td align="center">
        <a href="https://github.com/thyseus">
            <img src="https://avatars.githubusercontent.com/u/654271?v=4" width="100;" alt="thyseus"/>
            <br />
            <sub><b>Herbert Maschke</b></sub>
        </a>
    </td>
    <td align="center">
        <a href="https://github.com/ijalnasution">
            <img src="https://avatars.githubusercontent.com/u/17308059?v=4" width="100;" alt="ijalnasution"/>
            <br />
            <sub><b>Abangijal</b></sub>
        </a>
    </td></tr>
</table>
<!-- readme: contributors -end -->
