<?php

namespace Controller;

use Model\Post;
use Model\Abonent;
use Model\Number;
use Model\Room;
use Model\Subdivision;

use Src\Validator\Validator;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;

use \Firebase\JWT\JWT;

use function Image\image;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }



    public function signup(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/');
        }
        return new View('site.signup');
    }
    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }


    public function admin(Request $request): string
    {

        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                if ($request->method === 'POST') {
                    $validator = new Validator($request->all(), [
                        'name' => ['required'],
                        'login' => ['required', 'unique:users,login'],
                        'password' => ['required']
                    ], [
                        'required' => 'Поле :field пусто',
                        'unique' => 'Поле :field должно быть уникально'
                    ]);

                    if ($validator->fails()) {
                        return new View(
                            'site.admin',
                            ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]
                        );
                    }
                    $key = "securitykey";
                    $payload = [$request->login,$request->name];
                    $token = JWT::encode($payload, $key,"HS256");
                    if (User::create(['name' => $request->name, 'login' => $request->login, 'password'=>$request->password,"token"=> $token])) {
  
                        return new View('site.admin', ['message' => "Новый системный администратор создан"]);
                    }
                }
                return new View('site.admin');
            }
        }

        app()->route->redirect('/abonents');
        return "";

    }

    public function abonents(Request $request): string
    {
        $abonents = Abonent::all();
        $id = 0;
        if ($request->method === "POST") {

            if ($request->subdivision) {
                $abonents = Abonent::where('subdivision', $request->subdivision)->get();
                if ($request->room) {
                    $id = Number::where('room', $request->room)->get();
                    foreach ($id as $i) {
                        $abonents = Abonent::where('id', $i->user)->where('subdivision', $request->subdivision)->get();
                    }

                }
            } else if ($request->room) {
                $id = Number::where('room', $request->room)->get();
                foreach ($id as $i) {
                    $abonents = Abonent::where('id', $i->user)->get();
                }

            } else if ($request->name) {
                $abonents = Abonent::where('name', $request->name)->get();

            }
        }


        $numbers = Number::all();
        $subdivisions = Subdivision::all();
        $rooms = Room::all();
        return (new View())->render('site.abonents', ['abonents' => $abonents, 'numbers' => $numbers, 'rooms' => $rooms, 'subdivisions' => $subdivisions, 'id' => $id]);
    }


    public function subdivisions(Request $request): string
    {
        $subdivisions = Subdivision::all();


        return (new View())->render('site.subdivisions', ['subdivisions' => $subdivisions]);
    }

    public function rooms(Request $request): string
    {
        $rooms = Room::all();
        $subdivisions = Subdivision::all();
        if ($request->method === "POST") {
            if ($request->subdivision) {
                $rooms = Room::where('subdivision', $request->subdivision)->get();
            }
        }


        return (new View())->render('site.rooms', ['rooms' => $rooms, 'subdivisions' => $subdivisions]);
    }


    public function numbers(Request $request): string
    {
        $numbers = Number::all();
        $id = 0;
        if ($request->method === "POST") {
            if ($request->subdivision) {
                $rooms = Room::where('subdivision', $request->subdivision)->get();
                $numbers = Number::where('room', $rooms[0]->roomname)->get();
                if ($request->room) {
                    $numbers = Number::where('room', $request->room)->get();
                    if ($request->user) {
                        $numbers = Number::where('user', $request->user)->where('room', $request->room)->get();
                    }
                } else if ($request->user) {
                    $numbers = Number::where('user', $request->user)->where('room', $rooms[0]->roomname)->get();
                }
            } else if ($request->room) {
                $numbers = Number::where('room', $request->room)->get();
                if ($request->user) {
                    $numbers = Number::where('user', $request->user)->where('room', $request->room)->get();
                }

            } else if ($request->user) {
                $numbers = Number::where('user', $request->user)->get();

            }
        }
        $abonents = Abonent::all();
        $rooms = Room::all();
        $subdivisions = Subdivision::all();
        return (new View())->render('site.numbers', ['numbers' => $numbers, 'subdivisions' => $subdivisions, 'rooms' => $rooms, 'abonents' => $abonents]);
    }




    public function createabonent(Request $request): string
    {
        $message = '';
        if ($request->method === "POST") {
            if ($request->name && $request->surname && $request->patronymic && $request->dateofbirth && $request->subdivision) {
                if (Abonent::create(['name' => $request->name, 'surname' => $request->surname, 'patronymic' => $request->patronymic, 'dateofbirth' => $request->dateofbirth, 'subdivision' => $request->subdivision])) {
                    app()->route->redirect('/abonents');
                }
            }
            $message = 'Заполните все поля';
        }
        $subdivisions = Subdivision::all();
        return (new View())->render('site.createabonent', ['message' => $message, 'subdivisions' => $subdivisions]);
    }

    public function createnumber(Request $request): string
    {
        $rooms = Room::all();
        $message = '';
        if ($request->method === "POST") {
            $validator = new Validator($request->all(), [
                'number' => ['required', 'unique:numbers,number', 'isint'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'isint' => "Номер должен быть числом"
            ]);

            if ($validator->fails()) {
                return new View(
                    'site.createnumber',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE), 'rooms' => $rooms]
                );
            }
            if ($request->number && $request->room) {
                if (Number::create(['number' => $request->number, 'room' => $request->room])) {
                    app()->route->redirect('/numbers');
                }
            }
            $message = 'Заполните все поля';
        }

        return (new View())->render('site.createnumber', ['message' => $message, 'rooms' => $rooms]);
    }


    public function createsubdivision(Request $request): string
    {
        $message = '';
        if ($request->method === "POST") {
            $validator = new Validator($request->all(), [
                'subdivisionname' => ['required', 'unique:subdivisions,subdivisionname'],
                'subdivisiontype' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if ($validator->fails()) {

                return new View(
                    'site.createsubdivision',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]
                );
            }
            if ($request->subdivisionname && $request->subdivisiontype) {
                if (Subdivision::create(['subdivisionname' => $request->subdivisionname, 'subdivisiontype' => $request->subdivisiontype])) {
                    app()->route->redirect('/subdivisions');
                    return "успешно создано";


                }
            }

            $message = 'Заполните все поля';
        }

        return (new View())->render('site.createsubdivision', ['message' => $message]);
    }



    public function createroom(Request $request): string
    {
        $subdivisions = Subdivision::all();
        $message = '';
        if ($request->method === "POST") {
            $validator = new Validator($request->all(), [
                'roomname' => ['required', 'unique:rooms,roomname'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if ($validator->fails()) {
                return new View(
                    'site.createroom',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE), 'subdivisions' => $subdivisions]
                );
            }
            if ($request->roomname && $request->roomtype) {
                $uploadfile = '';
                // if($request->image['size']>0){
                //     $uploaddir = '../public/images/';
                //     $uploadfile = $uploaddir . basename($request->image['name']);
                //     if (move_uploaded_file($request->image['tmp_name'], $uploadfile)) {
                //         $img = $uploadfile;
                //     }
                // }
                $img = image($request->image)->img($request->image);

                if (Room::create(['roomname' => $request->roomname, 'roomtype' => $request->roomtype, 'subdivision' => $request->subdivision, 'image' => $img])) {
                    app()->route->redirect('/rooms');
                    return "yes";
                }
            }
            $message = 'Заполните все поля';
        }

        return (new View())->render('site.createroom', ['message' => $message, 'subdivisions' => $subdivisions]);
    }

    public function addnumbertouser(Request $request): string
    {

        $abonents = Abonent::all();
        $numbers = Number::all();
        $message = '';
        if ($request->method === "POST") {
            Number::where('number', $request->number)
                ->update(['user' => $request->id]);
            app()->route->redirect('/abonents');
        }

        return (new View())->render('site.addnumbertouser', ['message' => $message, 'abonents' => $abonents, 'numbers' => $numbers]);
    }

    public function new(Request $request): int
    {


        return 42;
    }
}
