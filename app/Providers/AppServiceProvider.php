<?php

namespace App\Providers;

use App\Event;
use App\Handler\AddEventHandler;
use App\Repository\EventQueryBuilderRepository;
use App\Repository\EventRepository;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Serializer::class, function($app) {
            $encoders = [new JsonEncoder()];
            $normalizers = [new ObjectNormalizer(null,null,null, new PhpDocExtractor()), new GetSetMethodNormalizer(), new ArrayDenormalizer(), new JsonSerializableNormalizer()];
            $serializer = new Serializer($normalizers, $encoders);
            return $serializer;
        });

        $this->app->singleton(EventRepository::class, function($app) {
            $db = $app->make('db');
            $serializer = $app->make(Serializer::class);
            return new EventQueryBuilderRepository(new Event(), $db, $serializer);
        });

        $this->app->singleton(AddEventHandler::class, function($app) {
            $repository = $app->make(EventRepository::class);
            return new AddEventHandler($repository);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
