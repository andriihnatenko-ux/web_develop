<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Carbon\Carbon;

class DiggingDeeperController extends Controller
{
    public function collections()
    {
        $result = [];

        /**
         * @var \Illuminate\Database\Eloquent\Collection $eloquentCollections
         */
        $eloquentCollection = BlogPost::withTrashed()->get();

        dump('--- Етап 1: Базова колекція Eloquent ---');
        dump(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());

        /**
         * @var \Illuminate\Support\Collection $collection
         */
        $collection = collect($eloquentCollection->toArray());

        dump('--- Етап 2: Звичайна колекція ---');
        dump(
            get_class($eloquentCollection),
            get_class($collection),
            $collection
        );

        $result['first'] = $collection->first();
        $result['last'] = $collection->last();

        $result['where']['data'] = $collection
            ->where('category_id', 10)
            ->values()
            ->keyBy('id');

        $result['where']['count'] = $result['where']['data']->count();
        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();

        if ($result['where']['data']->isNotEmpty()) {
            //
        }

        $result['where_first'] = $collection
            ->firstWhere('created_at', '>' , '2020-02-24 03:46:16');

        $result['map']['all'] = $collection->map(function ($item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);

            return $newItem;
        });

        $result['map']['not_exists'] = $result['map']['all']
            ->where('exists', '=', false)
            ->values()
            ->keyBy('item_id');

        dump('--- Етап 3: Результати після first, last, where та map ---');
        dump($result);

        $collection->transform(function ($item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);

            return $newItem;
        });

        dump('--- Етап 4: Трансформована колекція ---');
        dump($collection);

        $newItem = new \stdClass;
        $newItem->id = 9999;

        $newItem2 = new \stdClass;
        $newItem2->id = 8888;

        dump('--- Етап 5: Нові елементи ---');
        dump($newItem, $newItem2);

        $newItemFirst = $collection->prepend($newItem)->first();
        $newItemLast = $collection->push($newItem2)->last();
        $pulledItem = $collection->pull(1);

        dump('--- Етап 6: Додавання та вилучення елементів ---');
        dump(compact('collection', 'newItemFirst' , 'newItemLast', 'pulledItem'));

        $filtered = $collection->filter(function ($item) {
            $byDay = $item->created_at->isFriday();
            $byDate = $item->created_at->day == 11;

            return $byDay && $byDate;
        });

        dump('--- Етап 7: Відфільтрована колекція ---');
        dump(compact('filtered'));

        $sortedSimpleCollection = collect([5, 3, 1, 2, 4])->sort()->values();
        $sortedAscCollection = $collection->sortBy('created_at');
        $sortedDescCollection = $collection->sortByDesc('item_id');

        dump('--- Етап 8: Сортування ---');
        dump(compact('sortedSimpleCollection', 'sortedAscCollection', 'sortedDescCollection'));

        return [];
    }
}
