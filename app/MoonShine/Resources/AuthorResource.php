<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\MoonShine\Pages\Author\AuthorIndexPage;
use App\MoonShine\Pages\Author\AuthorFormPage;
use App\MoonShine\Pages\Author\AuthorDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Url;

/**
 * @extends ModelResource<Author, AuthorIndexPage, AuthorFormPage, AuthorDetailPage>
 */
class AuthorResource extends ModelResource
{
    protected string $model = Author::class;

    protected string $title = 'Authors';

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            AuthorIndexPage::class,
            AuthorFormPage::class,
            AuthorDetailPage::class,
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Name', 'name'),
            Url::make('Url', 'url'),
        ];

    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Name', 'name'),
                Url::make('Url', 'url'),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            Text::make('Name', 'name'),
            Url::make('Url', 'url'),
        ];

    }
    /**
     * @param Author $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
