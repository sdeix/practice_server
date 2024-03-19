<div class="select">
  <form method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>" />
    <p><select size="1" name="subdivision">
        <option value="">Все</option>
        <?php
        foreach ($subdivisions as $subdivision) {
          echo '<option value="' . $subdivision->subdivisionname . '">' . $subdivision->subdivisionname . '</option>';
        }
        ?>
      </select></p>
    <p><select size="1" name="room">
        <option value="">Все</option>
        <?php
        foreach ($rooms as $room) {
          echo '<option value="' . $room->roomname . '">' . $room->roomname . '</option>';
        }
        ?>
      </select></p>
    <p><input type="submit" value="Отправить"></p>
  </form>
</div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>Фамилия</th>
      <th>Имя</th>
      <th>Отчество</th>
      <th>Дата рождения</th>
      <th>Подразделение</th>
      <th>Помещения</th>
      <th>Номера</th>
    </tr>
  </thead>
  <tbody>
    <?php

    use Model\Number;

    foreach ($abonents as $abonent) {
      echo '  <tr>';
      echo '<th>' . $abonent->name . '</th>';
      echo '<th>' . $abonent->surname . '</th>';
      echo '<th>' . $abonent->patronymic . '</th>';
      echo '<th>' . $abonent->dateofbirth . '</th>';
      echo '<th>' . $abonent->subdivision . '</th>';
      $numbers = Number::where('user', $abonent->id)->get();
      echo '<th>';
      foreach ($numbers as $number) {
        echo $number->room . ' ';
      }
      echo '</th>';
      echo '<th>';
      foreach ($numbers as $number) {
        echo $number->number . ' ';
      }
      echo '<a href="'. app()->route->getUrl('/addnumbertouser'). '"><button>Добавитьь номер</button></a>';
      echo '</th>';
    }
    ?>
  </tbody>
</table>

<a href="<?= app()->route->getUrl('/createabonent') ?>">Создать абонента</a>



