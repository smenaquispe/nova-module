<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\ActionResponse;

class DownloadCsvCat extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['Name', 'Age', 'Breed', 'Color', 'Weight', 'Size', 'Gender', 'Owner']);

        foreach ($models as $model) {
            $csv->insertOne([
                $model->name,
                $model->age,
                $model->breed,
                $model->color,
                $model->weight,
                $model->size,
                $model->gender,
                $model->user->name ?? '',
            ]);
        }

        $filename = 'cats_'. now()->format('Y-m-d-H-i-s') . '.csv';
        Storage::disk('public')->put($filename, $csv->toString());
        $url = Storage::url($filename);
        return ActionResponse::download($filename, $url);
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }
}
