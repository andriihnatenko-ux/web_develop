<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Carbon\Carbon;
use App\Jobs\ProcessVideoJob;
use App\Jobs\GenerateCatalog\GenerateCatalogMainJob;

class DiggingDeeperController extends Controller
{
    // ... твій існуючий метод collections() ...
    public function collections()
    {
        // (залишаєш вміст з 5-ї лаби)
        return [];
    }

    public function processVideo()
    {
        ProcessVideoJob::dispatch();
        // Відкладення виконання завдання від моменту потрапляння в чергу.
        // Не впливає на паузу між спробами виконання завдання.
        // ->delay(10)
        // ->onQueue('name_of_queue')

        return 'Завдання processVideo додано в чергу';
    }

    /**
     * @link http://localhost:8000/digging_deeper/prepare-catalog
     *
     * php artisan queue:listen --queue=generate-catalog --tries=3 --delay=10
     */
    public function prepareCatalog()
    {
        GenerateCatalogMainJob::dispatch();

        return 'Завдання prepareCatalog додано в чергу';
    }
}
