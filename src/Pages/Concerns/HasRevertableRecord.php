<?php

namespace Konnco\FilamentSafelyDelete\Pages\Concerns;

use Filament\Notifications\Notification;

trait HasRevertableRecord
{
    public function initializeHasRevertableRecord()
    {
        $this->listeners = array_merge($this->listeners, [
            'undoDeleteRecord',
        ]);
    }

    public function undoDeleteRecord($id)
    {
        $model = $this->getModel()::withTrashed()->find($id);
        $model->restore();

        Notification::make()
            ->title('Restored!')
            ->success()
            ->send();
    }
}
