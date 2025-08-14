<?php

namespace App\Filament\Company\Resources\BreachEvents\Pages;

use App\Filament\Company\Resources\BreachEvents\BreachEventResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBreachEvent extends EditRecord
{
    protected static string $resource = BreachEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
