<div class="select">
<form method="post">
<input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
   <p><select size="1" name="subdivision">
    <option value="">Все</option>
    <?php
   foreach ($subdivisions as $subdivision) {
       echo '<option value="'.$subdivision->subdivisionname.'">'.$subdivision->subdivisionname.'</option>' ;
   }
   ?>   
   </select></p>
   <p><input type="submit" value="Отправить"></p>
  </form>
</div>
<table class="table">
<thead class="thead-dark">
  <tr>
    <th>Название</th>
    <th>Вид</th>
    <th>Подразделение</th>
    <th>Изображение</th>
  </tr>
</thead>
<tbody>
  <?php
 
   foreach ($rooms as $room) {
        echo '  <tr>';
       echo '<th>' . $room->roomname . '</th>';
       echo '<th>' . $room->roomtype . '</th>';
       echo '<th>' . $room->subdivision . '</th>';
       echo '<th class="imgth"><img class="img "src="' . $room->image . '"></th>';
   }
   ?>
</tbody>
</table>


<a href="<?= app()->route->getUrl('/createroom') ?>">Создать помещение</a>