<?php

namespace App\Nova\Actions;

use App\Exports\Top100Export;
use App\Maestro;
use AwesomeNova\Actions\ToolAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Maatwebsite\Excel\Facades\Excel;

class ExportTop100Action extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = "Exportar";

    public static $chunkCount = 10000;


    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $uniq = uniqid();
        Excel::store(new Top100Export($models),"{$uniq}.xlsx");
        return Action::download("/descargar/{$uniq}", 'Top100.xlsx');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
