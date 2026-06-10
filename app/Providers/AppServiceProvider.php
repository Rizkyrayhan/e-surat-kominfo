<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter as S3Adapter;
use Aws\S3\S3Client;
use Illuminate\Filesystem\AwsS3V3Adapter;

class AppServiceProvider extends ServiceProvider
{
    /**
    * Register any application services.
    *
    * @return void
    */
    public function register()
    {
        //
    }

    /**
    * Bootstrap any application services.
    *
    * @return void
    */
    public function boot()
    {
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        if ($this->app->environment('production') || env('FORCE_HTTPS', false)) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        Storage::extend('s3', function ($app, $config) {
            $s3Config = [
                'version' => 'latest',
                'region' => $config['region'],
                'endpoint' => $config['endpoint'],
                'use_path_style_endpoint' => $config['use_path_style_endpoint'],
                'credentials' => [
                    'key' => $config['key'],
                    'secret' => $config['secret'],
                ],
            ];

            $client = new S3Client($s3Config);

            $client->getHandlerList()->appendBuild(
                function (callable $handler) {
                    return function (\Aws\CommandInterface $cmd, \Psr\Http\Message\RequestInterface $req) use ($handler) {
                        $uri = $req->getUri();
                        $path = $uri->getPath();
                        if (strpos($path, '/storage/v1/s3/storage/v1/s3/') === 0) {
                            $path = str_replace('/storage/v1/s3/storage/v1/s3/', '/storage/v1/s3/', $path);
                            $req = $req->withUri($uri->withPath($path));
                        }
                        return $handler($cmd, $req);
                    };
                },
                'supabase-path-fix'
            );

            $adapter = new S3Adapter($client, $config['bucket'], $config['root'] ?? '');
            $operator = new Filesystem($adapter, $config);

            return new AwsS3V3Adapter($operator, $adapter, $config, $client);
        });

        view()->composer('layouts.app', function ($view) {
            if (auth()->check()) {
                if (auth()->user()->role === 'opd') {
                    $unreadSurats = \App\Models\SuratKeluar::where('tujuan_opd_id', auth()->id())
                        ->where('is_read', false)
                        ->with('pengirim')
                        ->latest()
                        ->take(5)
                        ->get();
                    $unreadCount = \App\Models\SuratKeluar::where('tujuan_opd_id', auth()->id())
                        ->where('is_read', false)
                        ->count();
                    $view->with([
                        'unreadSuratCount' => $unreadCount,
                        'unreadSurats' => $unreadSurats
                    ]);
                } else if (auth()->user()->role === 'admin') {
                    $unreadSurats = \App\Models\Surat::where('status', 'pending')
                        ->with('user')
                        ->latest()
                        ->take(5)
                        ->get();
                    $unreadCount = \App\Models\Surat::where('status', 'pending')->count();
                    $view->with([
                        'unreadSuratCount' => $unreadCount,
                        'unreadSurats' => $unreadSurats
                    ]);
                }
            }
        });
    }
}
