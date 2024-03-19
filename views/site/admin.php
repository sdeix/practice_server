<h2>Регистрация нового системного администратора</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post">
   <label>Имя <input type="text" name="name"></label>
   <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

   <label>Логин <input type="text" name="login"></label>
   <label>Пароль <input type="password" name="password"></label>
   <button>Зарегистрироваться</button>
</form>
