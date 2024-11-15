<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Contracts\BatchableAction;
use Laravel\Nova\Actions\ActionResponse;
use Laravel\Nova\Notifications\NovaNotification;
use Illuminate\Bus\PendingBatch;
use App\Models\User;
use App\Notifications\TaskSuccessNotification;

class LongRunningTask extends Action implements ShouldQueue, BatchableAction
{
    use Batchable, InteractsWithQueue, Queueable;

    public function __construct(
        private User $user
    )
    {
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        sleep(10);
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

    public function withBatch(ActionFields $fields, PendingBatch $batch)
    {
        $batch->then(function (Batch $batch) use ($fields) {
            
            $notification = NovaNotification::make()
                ->message('La se realizo correctamente.')
                ->type('success');

            $this->user->notify($notification);
        });
    }
    
}
