<!DOCTYPE html>
<html>
  <?php require_once BASE_PATH . '/app/views/partials/head.php'?>
  <body>
    <h1><?php echo $title ?? null?></h1>
    <p><?php echo $message ?? null?></p>
    <a href="/"><button>Go to Homepage</button></a>
  </body>
</html>

