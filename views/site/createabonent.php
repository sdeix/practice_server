<div>
  <h1>Создать абонента</h1>
  <?php
  echo $message ?? '';
  ?>
  <form class="create" action="createabonent" method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>" />
    <label for="surname">Фамилия</label>
    <input name="surname" type="text" placeholder="Фамилия">
    <label for="name">Имя</label>
    <input name="name" type="text" placeholder="Имя">
    <label for="patronimyc">Отчество</label>
    <input name="patronymic" type="text" placeholder="Отчество">
    <label for="dateofrirth">Дата рождения</label>
    <input name="dateofbirth" type="date">
    <label for="subdivision">Подразделение</label>
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