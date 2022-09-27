<?php

namespace Konnco\FilamentSafelyDelete\Pages\Actions;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Illuminate\Database\Eloquent\Model;
use Konnco\FilamentSafelyDelete\Exceptions\RevertableTraitNotImplemented;
use Throwable;

class RevertableDeleteAction extends \Filament\Pages\Actions\Action
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->action(function (): void {
            // Model $record
            $this->ensureModelIsSoftDeleted();
            $this->ensureListRecordHasImplementedRevertTrait();

            $this->process(static fn(Model $record) => $record->delete());

            $this->process(static fn(Model $record) => $record->delete());

            Notification::make()
                ->title('Deleted')
                ->success()
                ->body('**' . $this->getModelLabel() . '** have been deleted.')
                ->actions([
                    Action::make('undo')
                        ->color('secondary')
                        ->button()
                        ->emit('undoDeleteRecord', [$this->getRecord()->id])
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
            !in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($this->getModel())),
            new RevertableTraitNotImplemented
        );
    }

    protected function ensureListRecordHasImplementedRevertTrait()
    {
        throw_if(
            !in_array('Konnco\FilamentSafelyDelete\Pages\Concerns\HasRevertableRecord', class_uses($this->getLivewire())),
            new RevertableTraitNotImplemented('You need to implement trait Konnco\FilamentSafelyDelete\Pages\Concerns\HasRevertableRecord into ' . get_class($this->getLivewire()))
        );
    }
}
