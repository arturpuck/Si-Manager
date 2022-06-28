<?php

namespace App\Http\Controllers\Pornstars;

use App\Http\Controllers\Controller;
use App\Handlers\Pornstars\GetPornstarsHandler;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class PornstarsController extends Controller
{
    public function getPornstars(GetPornstarsHandler $handler) : AnonymousResourceCollection
    {
        return $handler->handle();
    }
}
