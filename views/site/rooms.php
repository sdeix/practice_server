<div class="select">
<form method="post">
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
  </tr>
</thead>
<tbody>
  <?php
 
   foreach ($rooms as $room) {
        echo '  <tr>';
       echo '<th>' . $room->roomname . '</th>';
       echo '<th>' . $room->roomtype . '</th>';
       echo '<th>' . $room->subdivision . '</th>';
   }
   ?>
</tbody>
</table>


