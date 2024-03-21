<?php

namespace Controller;

use Model\Subdivision;
use Src\Request;
use Src\View;

class Api
{
   public function index(): void
   {
       $posts = Subdivision::all()->toArray();

       (new View())->toJSON($posts);
   }

   public function echo(Request $request): void
   {
       (new View())->toJSON($request->all());
   }
}

