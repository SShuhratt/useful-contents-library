<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\User;
use App\MoonShine\Pages\User\UserIndexPage;
use App\MoonShine\Pages\User\UserFormPage;
use App\MoonShine\Pages\User\UserDetailPage;

use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use Spatie\Permission\Traits\HasRoles;
/**
 * @extends ModelResource<User, UserIndexPage, UserFormPage, UserDetailPage>
 */
class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Users';

    public function getIndexQuery(): Builder
    {
        $query = parent::getIndexQuery();

        if (auth('moonshine')->user()?->email !== 'superadmin@example.com') {
            $query->whereDoesntHave('roles', function ($q) {
                $q->whereIn('name', ['admin', 'superadmin']);
            });
        }
        return $query;
    }


    protected function indexFields(): iterable

    {

        return [

            ID::make(),

            Text::make('Name', 'name'),

        ];

    }



    protected function formFields(): iterable

    {

        return [

            Box::make([

                ID::make(),

                Text::make('Name'),


            ]),

        ];

    }



    protected function detailFields(): iterable

    {

        return [

            Text::make('Name', 'name'),

        ];

    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            UserIndexPage::class,
            UserFormPage::class,
            UserDetailPage::class,
        ];
    }

    /**
     * @param User $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */


    protected function rules(mixed $item): array
    {
        return [
            'name' => 'required',
            'email' => [
                'sometimes',
                'bail',
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($item->id),
            ],
            'password' => !$item->exists
                ? 'required|min:6|required_with:password_repeat|same:password_repeat'
                : 'sometimes|nullable|min:6|required_with:password_repeat|same:password_repeat',
        ];
    }
    public function getTitle(): string
    {
        return __('Clients');
    }
}
