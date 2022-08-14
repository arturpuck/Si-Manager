<?php 

namespace App\Handlers\Pornstars;

use App\Models\Pornstar;
use App\Http\Resources\PornstarResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


Class GetPornstarsHandler
{

    public function handle() : AnonymousResourceCollection
    {
           return PornstarResource::collection(Pornstar::all());
    }

}