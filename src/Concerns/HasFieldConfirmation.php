<?php

namespace Konnco\FilamentSafelyDelete\Concerns;

trait HasFieldConfirmation
{
    protected string $usingField = 'name';

    public function usingField($usingField): static
    {
        $this->usingField = $usingField;

        return $this;
    }

    public function getUsingField(): string
    {
        return $this->usingField;
    }

    public function getDeleteRecordConfirmationTypingText(): string
    {
        return $this->getRecord()
            ->{$this->getUsingField()};
    }
}
