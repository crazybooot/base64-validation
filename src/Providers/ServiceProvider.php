<?php
declare(strict_types = 1);

namespace Crazybooot\Base64Validation\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use function config;
use function config_path;
use function implode;
use function trans;

/**
 * Class QueueStatsServiceProvider
 *
 * @package Crazybooot\QueueStats\Providers
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Validator::extend(
            'base64max',
            'Crazybooot\Base64Validation\Validators\Base64Validator@validateBase64Max'
        );

        Validator::extend(
            'base64min',
            'Crazybooot\Base64Validation\Validators\Base64Validator@validateBase64Min'
        );

        Validator::extend(
            'base64dimensions',
            'Crazybooot\Base64Validation\Validators\Base64Validator@validateBase64Dimensions'
        );

        Validator::extend(
            'base64file',
            'Crazybooot\Base64Validation\Validators\Base64Validator@validateBase64File'
        );

        Validator::extend(
            'base64image',
            'Crazybooot\Base64Validation\Validators\Base64Validator@validateBase64Image'
        );

        Validator::extend(
            'base64mimetypes',
            'Crazybooot\Base64Validation\Validators\Base64Validator@validateBase64Mimetypes'
        );

        Validator::extend(
            'base64mimes',
            'Crazybooot\Base64Validation\Validators\Base64Validator@validateBase64Mimes'
        );

        Validator::extend(
            'base64between',
            'Crazybooot\Base64Validation\Validators\Base64Validator@validateBase64Between'
        );

        Validator::extend(
            'base64size',
            'Crazybooot\Base64Validation\Validators\Base64Validator@validateBase64Size'
        );

        if (config('base64validation.replace_validation_messages')) {
            Validator::replacer('base64max', function ($message, $attribute, $rule, $parameters) {
                return trans('validation.max.file', ['attribute' => $attribute, 'max' => $parameters[0]]);
            });

            Validator::replacer('base64min', function ($message, $attribute, $rule, $parameters) {
                return trans('validation.min.file', ['attribute' => $attribute, 'min' => $parameters[0]]);
            });

            Validator::replacer('base64dimensions', function ($message, $attribute, $rule, $parameters) {
                return trans('validation.dimensions', ['attribute' => $attribute]);
            });

            Validator::replacer('base64file', function ($message, $attribute, $rule, $parameters) {
                return trans('validation.file', ['attribute' => $attribute]);
            });

            Validator::replacer('base64image', function ($message, $attribute, $rule, $parameters) {
                return trans('validation.image', ['attribute' => $attribute]);
            });

            Validator::replacer('base64mimetypes', function ($message, $attribute, $rule, $parameters) {
                return trans('validation.mimetypes', [
                    'attribute' => $attribute,
                    'values'    => implode(',', $parameters)
                ]);
            });

            Validator::replacer('base64mimes', function ($message, $attribute, $rule, $parameters) {
                return trans('validation.mimes', [
                    'attribute' => $attribute,
                    'values'    => implode(',', $parameters),
                ]);
            });

            Validator::replacer('base64between', function ($message, $attribute, $rule, $parameters) {
                return trans('validation.between.file', [
                    'attribute' => $attribute,
                    'min'       => $parameters[0],
                    'max'       => $parameters[1]
                ]);
            });

            Validator::replacer('base64size', function ($message, $attribute, $rule, $parameters) {
                return trans('validation.size.file', [
                    'attribute' => $attribute,
                    'size'      => $parameters[0],
                ]);
            });
        }

        $this->publishes([
            __DIR__.'/../../config/base64validation.php' => config_path('base64validation.php'),
        ], 'config');
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/base64validation.php', 'base64validation'
        );
    }
}