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
   <p><select size="1" name="room">
    <option value="">Все</option>
    <?php
   foreach ($rooms as $room) {
       echo '<option value="'.$room->roomname.'">'.$room->roomname.'</option>' ;
   }
   ?>   
   </select></p>
   <p><select size="1" name="user">
    <option value="">Все</option>
    <?php
   foreach ($abonents as $abonent) {
       echo '<option value="'.$abonent->id.'">'.$abonent->name.'</option>' ;
   }
   ?>   
   </select></p>
   <p><input type="submit" value="Отправить"></p>
  </form>
  </div>
<table class="table">
<thead class="thead-dark">
  <tr>
    <th>Номер телефона</th>
    <th>Помещение</th>
    <th>Абонент</th>
    <th>Подразделение</th>
  </tr>
</thead>
<tbody>
  <?php
   use Model\Room;
   use Model\Abonent;
   foreach ($numbers as $number) {
        echo '  <tr>';
       echo '<th>' . $number->number . '</th>';
       echo '<th>' . $number->room . '</th>';


       if(count(Abonent::where('id',$number->user)->get())==1){
        $abonent = Abonent::where('id',$number->user)->get();
        echo '<th>' . $abonent[0]->name.' '.$abonent[0]->surname.' '.$abonent[0]->patronymic  . '</th>';
       }
       else{
        echo '<th></th>';
       }
      
       $rooms = Room::where('roomname',$number->room)->get();
       echo '<th>' . $rooms[0]->subdivision . '</th>';


   }
   ?>
</tbody>
</table>

<a href="<?= app()->route->getUrl('/createnumber') ?>">Создать номер</a>