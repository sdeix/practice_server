<?php

namespace Controller;

use Model\Post;
use Model\Abonent;
use Model\Number;
use Model\Room;
use Model\Subdivision;


use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Illuminate\Database\Capsule\Manager as DB;

class Site
{
    public function index(Request $request): string
    {
       $posts = Post::where('id', $request->id)->get();
       return (new View())->render('site.post', ['posts' => $posts]);
    }
    

   public function hello(): string
   {
       return new View('site.hello', ['message' => 'hello working']);
   }
   public function signup(Request $request): string
   {
      if ($request->method === 'POST' && User::create($request->all())) {
          app()->route->redirect('/hello');
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
       app()->route->redirect('/hello');
   }
   //Если аутентификация не удалась, то сообщение об ошибке
   return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
    Auth::logout();
    app()->route->redirect('/hello');
    }


    public function admin(): string
    {
        if(Auth::check()){
            if(Auth::user()->role=='admin'){
                return new View('site.hello', ['message' => Auth::user()->role]);
            }
        }

        app()->route->redirect('/hello');
        return "";

    }

    public function abonents(Request $request): string
    {
        $abonents = Abonent::all();
        $id = 0;
        if ($request->method === "POST") {
            if($request->subdivision){
                $abonents = Abonent::where('subdivision', $request->subdivision)->get();
                if($request->room){
                    $abonents= array();
                    $id = Number::where('room', $request->room)->get();
                    foreach ($id as $i) {
                        $abonents = Abonent::where('id', $i->user)->where('subdivision', $request->subdivision)->get();
                    }
    
                }
            }
            else if($request->room){
                $abonents= array();
                $id = Number::where('room', $request->room)->get();
                foreach ($id as $i) {
                    $abonents = Abonent::where('id', $i->user)->get();
                }

            }
        }


       $numbers = Number::all();
       $subdivisions = Subdivision::all();
       $rooms = Room::all();
       return (new View())->render('site.abonents', ['abonents' => $abonents, 'numbers' => $numbers,'rooms' => $rooms,'subdivisions' => $subdivisions,'id' => $id]);
    }
   

    public function subdivisions(Request $request): string
    {
        $subdivisions = Subdivision::all();
       

       return (new View())->render('site.subdivisions', ['subdivisions' => $subdivisions]);
    }

   
}
