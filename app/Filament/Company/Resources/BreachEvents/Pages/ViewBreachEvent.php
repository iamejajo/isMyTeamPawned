<?php

namespace App\Filament\Company\Resources\BreachEvents\Pages;

use App\Filament\Company\Resources\BreachEvents\BreachEventResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBreachEvent extends ViewRecord
{
    protected static string $resource = BreachEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
