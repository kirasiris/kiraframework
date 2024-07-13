<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
.jumbotron{
  position: relative;
  align-items: center;
  display: flex;
  justify-content: center;
  height: 100vh;
  text-align: center;
  margin: auto;
 }
</style>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-3"><?php echo $data['title']; ?></h1>
      <p class="lead"><?php echo $data['description']; ?></p>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>