<!DOCTYPE html>
<html>
<?php require BASE_PATH . '/app/views/partials/head.php';?>
  <body>
    <h1>Dashboard</h1>
    <div>
    <a href="/create"><button>Create Content</button></a>
      <a href="/logout"><button class="emphasize">Log Out</button></a>
    </div><br>
    <form action="/delete" method="post" id="dataForm">
      <?php insert_csrf_token()?>
      <input type="hidden" id="hiddenInputId" name="id" value=""?>
      <table class="data">
        <thead>
          <?php
            if (count($data) !== 0) {
              echo
                '<tr>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Date</th>
                  <th>Content</th>
                  <th>Action</th>
                </tr>';
            }
          ?>
        </thead>
        <tbody>
          <?php
            foreach ($data as $row){
              $mod_title = strtoupper($row->title);
              $mod_content = escape_for_js($row->content);
              echo "<tr>";
              echo "<td>{$mod_title}</td>";
              echo "<td>{$row->description}</td>";
              echo "<td>{$row->creation_timestamp}</td>";
              echo "<td><a href='#' onclick='alert(\"{$mod_content}\")'>View</button></td>";
              echo "<td><a href='#' onclick='deleteRow({$row->id})'>Delete</a></td>";
              echo '</tr>';
            }
          ?>
        </tbody>
      </table>
    </form>
    <script>
      function deleteRow(id) {
        const form = document.getElementById('dataForm');
        const hiddenInputId = document.getElementById('hiddenInputId');
        hiddenInputId.value = id;
        form.submit();
      }
    </script>
  </body>
</html>

