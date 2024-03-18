<table class="table">
<thead class="thead-dark">
  <tr>
    <th>Название</th>
    <th>Вид</th>
  </tr>
</thead>
<tbody>
    
  <?php
   foreach ($subdivisions as $subdivision) {
    echo "    </tr>";
    echo '<th>' . $subdivision->subdivisionname . '</th>';
    echo '<th>' . $subdivision->subdivisiontype . '</th>';
    echo "</tr>";
}
   ?>
    
</tbody>
</table>


