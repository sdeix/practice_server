  <form method="post">
   <p><select size="1" name="subdivision">
    <option value="">Все</option>
    <?php
   foreach ($subdivisions as $subdivision) {
       echo '<option value="'.$subdivision->subdivisionname.'">'.$subdivision->subdivisionname.'</option>' ;
   }
   ?>   
   </select></p>
   <p><select size="1" name="room">
    <option value="">Все</option>
    <?php
   foreach ($rooms as $room) {
       echo '<option value="'.$room->roomname.'">'.$room->roomname.'</option>' ;
   }
   ?>   
   </select></p>
   <p><input type="submit" value="Отправить"></p>
  </form>

<table style="width:100%">
  <tr>
    <th>Фамилия</th>
    <th>Имя</th>
    <th>Отчество</th>
    <th>Дата рождения</th>
    <th>Подразделение</th>
    <th>Номера</th>
  </tr>

  <?php
 
  use Model\Number;
   foreach ($abonents as $abonent) {
        echo '  <tr>';
       echo '<th>' . $abonent->name . '</th>';
       echo '<th>' . $abonent->surname . '</th>';
       echo '<th>' . $abonent->patronymic . '</th>';
       echo '<th>' . $abonent->dateofbirth . '</th>';
       echo '<th>' . $abonent->subdivision . '</th>';
       echo '<th>';
       $numbers = Number::where('user',$abonent->id)->get();
       foreach ($numbers as $number) {
        echo $number->number ;
       }
       echo '</th>';
   }
   ?>
</table>


