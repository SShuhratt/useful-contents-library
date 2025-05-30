<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
use App\MoonShine\Pages\Genre\GenreIndexPage;
use App\MoonShine\Pages\Genre\GenreFormPage;
use App\MoonShine\Pages\Genre\GenreDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Genre, GenreIndexPage, GenreFormPage, GenreDetailPage>
 */
class GenreResource extends ModelResource
{
    protected string $model = Genre::class;

    protected string $title = 'Genres';

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            GenreIndexPage::class,
            GenreFormPage::class,
            GenreDetailPage::class,
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Name', 'name'),
            Text::make('Created', 'created_at'),
            Text::make('Updated', 'updated_at'),
        ];

    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Name', 'name'),
                Text::make('Created', 'created_at'),
                Text::make('Updated', 'updated_at'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            Text::make('Name', 'name'),
            Text::make('Created', 'created_at'),
            Text::make('Updated', 'updated_at'),
        ];

    }
    /**
     * @param Genre $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
