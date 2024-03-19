<div>
  <?php
  echo $message ?? '';
  ?>
  <form action="createnumber" method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>" />
    <input name="number" type="text">
    <p><select size="1" name="room">
        <?php
        foreach ($rooms as $room) {
          echo '<option value="' . $room->roomname . '">' . $room->roomname . '</option>';
        }
        ?>
      </select></p>
      <button>Создать номер</button>
  </form>
</div>