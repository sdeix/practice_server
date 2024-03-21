<?php

namespace Controller;
use Src\Auth\Auth;
use Model\Subdivision;
use Src\Request;
use Src\View;
use Model\User;
class Api
{
   public function index(): void
   {
       $posts = Subdivision::all()->toArray();

       (new View())->toJSON($posts);
   }

   public function login(Request $request): void
   {
    if (Auth::attempt($request->all())) {
        $user = User::where('login', $request->login)->get();
        (new View())->toJSON([$user[0]->token]);
    }
        
       (new View())->toJSON(["Не удалось авторизироваться"]);
   }
   public function rew(Request $request): void
   {
    $headers = trim($_SERVER["HTTP_BEARER"]);
       (new View())->toJSON([$headers]);
   }


}

