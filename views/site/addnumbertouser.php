<div class="select">
  <form method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>" />
    <p><select size="1" name="id">
        <?php
        foreach ($abonents as $abonent) {
          echo '<option value="' . $abonent->id . '">' .  $abonent->name." ".$abonent->surname . '</option>';
        }
        ?>
      </select></p>
    <p><select size="1" name="number">
        <?php
        foreach ($numbers as $number) {
          echo '<option value="' . $number->number . '">' . $number->number . '</option>';
        }
        ?>
      </select></p>
    <p><input type="submit" value="Отправить"></p>
  </form>
</div>


