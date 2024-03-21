<?php

namespace Controller;

use Src\Auth\Auth;
use Model\Subdivision;
use Src\Request;
use Src\View;
use Model\User;
use Model\Abonent;


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
    public function subdivisions(Request $request): void
    {
        $header = trim($_SERVER["HTTP_BEARER"]);
        if (count(User::where('token', $header)->get()) != 0) {
            (new View())->toJSON(Subdivision::all()->toArray());
        }

        (new View())->toJSON(["Недействительный токен"]);
    }
    public function abonents(Request $request): void
    {
        $header = trim($_SERVER["HTTP_BEARER"]);
        if (count(User::where('token', $header)->get()) != 0) {
            (new View())->toJSON(Abonent::all()->toArray());
        }
        (new View())->toJSON(["Недействительный токен"]);
    }

    public function addabonent(Request $request): void
    {

        $header = trim($_SERVER["HTTP_BEARER"]);
        if (count(User::where('token', $header)->get()) != 0) {
            if ($request->name && $request->surname && $request->patronymic && $request->dateofbirth && $request->subdivision) {
                if (count(Subdivision::where('subdivisionname', $request->subdivision)->get()) != 0) {
                    if(Abonent::create(['name' => $request->name, 'surname' => $request->surname, 'patronymic' => $request->patronymic, 'dateofbirth' => $request->dateofbirth, 'subdivision' => $request->subdivision])){
                        (new View())->toJSON(["Абонент создан"]);
                    }

                } else {
                    (new View())->toJSON(["Недействительное название подразделения, посмотреть существующие можно по пдресу /api/subdivisions"]);
                }
            }
            else{
                (new View())->toJSON(["Не заполнены все данные"]);    
            }


        }
        (new View())->toJSON(["Недействительный токен"]);
    }

}

