<div class="card">
  <?php if (!empty($data['admin']->avatar)) : ?>
    <img src="<?= $data['admin']->avatar ?>" class="card-img-top" alt="...">
  <?php endif ?>

  <div class="card-body">
    <h5 class="card-title"><?= $data['admin']->username ?></h5>
    <p class="card-text"><?= $data['admin']->bio ?></p>    
  </div>
</div>