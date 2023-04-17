<?php

namespace Kurozora\SortRequest\Tests\Support\Controllers;

use Illuminate\Routing\Controller;
use Kurozora\SortRequest\Tests\Support\Models\Item;
use Kurozora\SortRequest\Tests\Support\Requests\AdvancedGetItemsRequest;
use Kurozora\SortRequest\Tests\Support\Requests\GetItemsRequest;
use Kurozora\SortRequest\Tests\Support\Resources\ItemResource;

class ItemController extends Controller
{
    /**
     * Returns a list of all items as JSON.
     *
     * @param GetItemsRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    function get(GetItemsRequest $request)
    {
        $items = Item::sortViaRequest($request)->get();

        return ItemResource::collection($items);
    }

    /**
     * Returns a list of all items as JSON.
     *
     * @param AdvancedGetItemsRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    function getAdvanced(AdvancedGetItemsRequest $request)
    {
        $items = Item::sortViaRequest($request)->get();

        return ItemResource::collection($items);
    }
}
