<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class AccessHour extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\AccessHour>
     */
    public static $model = \App\Models\AccessHour::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'start_hour',
        'end_hour',
        'role_id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Select::make('Start Hour')->options([
                '9' => '9',
                '10' => '10',
                '11' => '11',
                '12' => '12',
                '13' => '13',
                '14' => '14',
                '15' => '15',
                '16' => '16',
                '17' => '17',
                '18' => '18',
                '19' => '19',
                '20' => '20',
                '21' => '21',
                '22' => '22',
                '23' => '23',
            ]),
            Select::make('End Hour')->options([
                '9' => '9',
                '10' => '10',
                '11' => '11',
                '12' => '12',
                '13' => '13',
                '14' => '14',
                '15' => '15',
                '16' => '16',
                '17' => '17',
                '18' => '18',
                '19' => '19',
                '20' => '20',
                '21' => '21',
                '22' => '22',
                '23' => '23',
            ]),
            
            BelongsTo::make('Role')
                ->display('name')
                ->searchable()
                ->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
