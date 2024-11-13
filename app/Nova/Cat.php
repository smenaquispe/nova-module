<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Actions\DownloadCsvCat;

class Cat extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Cat>
     */
    public static $model = \App\Models\Cat::class;

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
        'name',
        'age',
        'breed',
        'color',
        'weight',
        'size',
        'gender',
        'user_id',
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

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Number::make('Age')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Breed')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Color')
                ->sortable()
                ->rules('required', 'max:255'),

            Number::make('Weight')
                ->sortable()
                ->min(1)
                ->max(100)
                ->step(0.1)
                ->rules('required', 'max:255'),
            

            Number::make('Size')
                ->sortable()
                ->min(1)
                ->max(100)
                ->step(0.1)
                ->rules('required', 'max:255'),

            Text::make('Gender')
                ->sortable()
                ->rules('required', 'max:255'),
        
            BelongsTo::make('User')
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
        return [
            DownloadCsvCat::make()->canSee(function ($request) {
                return $request->user()->hasThisPermission('make csv cat');
            })->canRun(function ($request, $user) {
                return $request->user()->hasThisPermission('make csv cat');
            }),
        ];
    }
}
