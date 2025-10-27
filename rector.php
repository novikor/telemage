<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\EarlyReturn\Rector\Return_\ReturnBinaryOrToEarlyReturnRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ArrowFunction\AddArrowFunctionReturnTypeRector;
use RectorLaravel\Rector\StaticCall\EloquentMagicMethodToQueryBuilderRector;
use RectorLaravel\Set\LaravelLevelSetList;
use RectorLaravel\Set\LaravelSetList;
use RectorLaravel\Set\Packages\Livewire\LivewireSetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/app',
    ])
    ->withSkipPath(__DIR__.'/tests')
    ->withSets([
        LevelSetList::UP_TO_PHP_84,
        SetList::DEAD_CODE,
        SetList::CARBON,
        SetList::EARLY_RETURN,
        SetList::TYPE_DECLARATION,
        SetList::CODE_QUALITY,
        LaravelLevelSetList::UP_TO_LARAVEL_120,
        LivewireSetList::LIVEWIRE_30,
        LaravelSetList::LARAVEL_CODE_QUALITY,
        LaravelSetList::LARAVEL_COLLECTION,
        LaravelSetList::LARAVEL_ELOQUENT_MAGIC_METHOD_TO_QUERY_BUILDER,
    ])
    ->withSkip([
        ReturnBinaryOrToEarlyReturnRector::class,
        AddArrowFunctionReturnTypeRector::class,
    ])
    ->withConfiguredRule(EloquentMagicMethodToQueryBuilderRector::class, [
        'exclude_methods' => [
            'find',
        ],
    ]);
