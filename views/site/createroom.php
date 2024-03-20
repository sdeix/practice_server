<div>
  <h1>Создать помещение</h1>
  <?php
  print_r($message)

  ?>
  <form enctype="multipart/form-data" class="create" action="createroom" method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>" />
    <label for="roomname">Название помещения</label>
    <input name="roomname" type="text">
    <label for="roomtype">Тип помещения</label>
    <input name="roomtype" type="text">
    <label for="subdivision">Помещение</label>
    <p><select size="1" name="subdivision">
        <?php
        foreach ($subdivisions as $subdivision) {
          echo '<option value="' . $subdivision->subdivisionname . '">' . $subdivision->subdivisionname . '</option>';
        }
        ?>
      </select></p>
      <input type="file" name="image">
      <button>Создать помещение</button>
  </form>
</div>