<div>
  <?php
  echo $message ?? '';
  ?>
  <form action="createabonent" method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>" />
    <input name="surname" type="text">
    <input name="name" type="text">
    <input name="patronymic" type="text">
    <input name="dateofbirth" type="date">
    <p><select size="1" name="subdivision">
        <?php
        foreach ($subdivisions as $subdivision) {
          echo '<option value="' . $subdivision->subdivisionname . '">' . $subdivision->subdivisionname . '</option>';
        }
        ?>
      </select></p>
      <button>Создать абонента</button>
  </form>
</div>