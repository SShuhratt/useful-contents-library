<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\UserResource;
use App\MoonShine\Resources\ContentResource;
use App\MoonShine\Resources\GenreResource;
use App\MoonShine\Resources\AuthorResource;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\LikeResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     *
     */
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                UserResource::class,
                ContentResource::class,
                GenreResource::class,
                AuthorResource::class,
                CategoryResource::class,
                LikeResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ])
        ;
    }
}
