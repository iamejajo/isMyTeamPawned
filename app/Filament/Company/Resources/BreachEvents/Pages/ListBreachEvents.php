<?php

namespace App\Filament\Company\Resources\BreachEvents\Pages;

use App\Filament\Company\Resources\BreachEvents\BreachEventResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBreachEvents extends ListRecords
{
    protected static string $resource = BreachEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
