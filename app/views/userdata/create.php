<!DOCTYPE html>
<html>
  <?php require BASE_PATH . '/app/views/partials/head.php';?>
  <body>
    <h1>Create New Content</h1>
    <form action="/create/process" method="post">
      <?php insert_csrf_token()?>
      <div><input type="text" name="contentTitle" placeholder="Title" value="<?php echo $contentTitle ?? null?>"></div>
      <div><input type="text" name="description" placeholder="Description" value="<?php echo $description ?? null?>"></div>
      <div><textarea rows="12" name="content" placeholder="Content"><?php echo $content ?? null?></textarea></div>
      <div><p class="error"><?php echo $error ?? null?></p></div>
      <a href="/dashboard"><button type="button">Cancel</button></a>
      <button type="submit" class="emphasize">Create</button>
    </form>
  </body>
</html>

