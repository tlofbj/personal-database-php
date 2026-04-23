<!DOCTYPE html>
<html>
<?php require BASE_PATH . '/app/views/partials/head.php';?>
  <body>
    <h1>Login</h1>
    <p>I am a localhost server that resides within Tata's computer. Users who are logged in may enjoy free storage in my database!</p>
    <form action="/login/process" method="POST">
      <?php insert_csrf_token()?>
      <div><input type="text" name="username" placeholder="Username" value="<?php echo $username ?? null?>"></div>
      <div><input type="password" name="password" placeholder="Password" value="<?php echo $password ?? null?>"></div>
      <div><p class="error"><?php echo $error ?? null?></p></div>
      <a href="/"><button type="button">Back</button></a>
      <button type="submit" class="emphasize">Login</button>
    </form>
  </body>
</html>

