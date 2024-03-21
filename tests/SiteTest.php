<?php
use Controller\Site;
use PHPUnit\Framework\TestCase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Model\Subdivision;

class SiteTest extends TestCase
{

public function testcreateroom(): void
{   
    $_SERVER['DOCUMENT_ROOT'] = '/var/www/html';

    //Создаем экземпляр приложения
    $GLOBALS['app'] = new Src\Application(new Src\Settings([
        'app' => include $_SERVER['DOCUMENT_ROOT'] . '/config/app.php',
        'db' => include $_SERVER['DOCUMENT_ROOT'] . '/config/db.php',
        'path' => include $_SERVER['DOCUMENT_ROOT'] . '/config/path.php',
    ]));
 
    //Глобальная функция для доступа к объекту приложения
    if (!function_exists('app')) {
        function app()
        {
            return $GLOBALS['app'];
        }
    }
    $userData = ['subdivisionname'=>"qweqweqw",'subdivisiontype'=>"qweqwe"];

   $request = $this->createMock(\Src\Request::class);
   $request->subdivisionname = "Qweqwwqeeq";
   $request->subdivisiontype='qweqwewqdqwqw';
   $request->method = 'POST';
   $request->expects($this->any())
   ->method('all')
   ->willReturn($userData);
   $site = new Site();
   $result = $site->createsubdivision($request);

   self::assertEquals("успешно создано",$result);


   Subdivision::where('subdivisionname', $request->subdivisionname)->delete();

}
  




}
