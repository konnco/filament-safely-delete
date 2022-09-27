<?php

namespace Konnco\FilamentSafelyDelete\Tables\Actions;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Illuminate\Database\Eloquent\Model;
use Konnco\FilamentSafelyDelete\Exceptions\RevertableTraitNotImplemented;
use Throwable;

class RevertableDeleteAction extends \Filament\Tables\Actions\Action
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->color('danger');
        $this->groupedIcon('heroicon-s-trash');
        $this->icon('heroicon-s-trash');
        $this->label(__('filament-support::actions/delete.single.label'));

        $this->action(function (array $data, Model $record): void {
            $this->ensureModelIsSoftDeleted();
            $this->ensureListRecordHasImplementedRevertTrait();

            $this->process(static fn (Model $record) => $record->delete());

            Notification::make()
                ->title('Deleted')
                ->success()
                ->body('**'.$this->getModelLabel().'** have been deleted.')
                ->actions([
                    Action::make('undo')
                        ->color('secondary')
                        ->button()
                        ->emit('undoDeleteRecord', [$record->id])
                        ->close(),
                ])
                ->send();
        });
    }

    /**
     * @throws Throwable
     * @throws RevertableTraitNotImplemented
     */
    protected function ensureModelIsSoftDeleted(): void
    {
        throw_if(
            ! in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($this->getModel())),
            new RevertableTraitNotImplemented
        );
    }

    protected function ensureListRecordHasImplementedRevertTrait()
    {
        throw_if(
            ! in_array('Konnco\FilamentSafelyDelete\Pages\Concerns\HasRevertableRecord', class_uses($this->getLivewire())),
            new RevertableTraitNotImplemented('You need to implement trait Konnco\FilamentSafelyDelete\Pages\Concerns\HasRevertableRecord into '.get_class($this->getLivewire()))
        );
    }
}
