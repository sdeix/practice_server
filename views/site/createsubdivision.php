<div>
  <h1>Создать подразделение</h1>
  <?php
  echo $message ?? '';
  ?>
  <form class="create" action="createsubdivision" method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>" />
    <label for="subdivisionname">Название</label>
    <input name="subdivisionname" type="text">
    <label for="subdivisiontype">Тип</label>
    <input name="subdivisiontype" type="text">

      <button>Создать подразделение</button>
  </form>
</div>