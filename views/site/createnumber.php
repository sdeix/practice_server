<div>
  <h1>Создать номер</h1>
  <?php
  echo $message ?? '';
  ?>
  <form class="create" action="createnumber" method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>" />
    <label for="number">Номер</label>
    <input name="number" type="text">
    <label for="room">Помещение</label>
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