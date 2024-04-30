<div class="sideBar">
    <?php if (!empty($data['admin']->avatar)) : ?>
        <div class="zoom">
            <img class="avatar" src="<?= $data['admin']->avatar ?>">
        </div>
    <?php endif ?>
    <ul class="socialMedia">
        <?php if (!empty($data['admin']->facebook)) : ?>
            <li>
                <a href="<?= $data['admin']->facebook ?>" data-toggle="tooltip" title="Follow us on Facebook" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </li>
        <?php endif ?>
        <?php if (!empty($data['admin']->youtube)) : ?>
            <li>
                <a href="<?= $data['admin']->youtube ?>" data-toggle="tooltip" title="Subscribe to our YouTube channel" target="_blank">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
        <?php endif ?>
        <?php if (!empty($data['admin']->instagram)) : ?>
            <li>
                <a href="<?= $data['admin']->instagram ?>" data-toggle="tooltip" title="Follow us on Instagram" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        <?php endif ?>
    </ul>
    <h4 class="text-center"><?= $data['admin']->username ?></h4>
    <p><?= $data['admin']->bio ?></p>
</div>

<div class="sideBar">
    <h4>Categories</h4>
    <ul>
        <?php foreach ($data['categories'] as $category) : ?>
            <li>
                <a href="<?= URL . '/categories/' . $category->id ?>" data-toggle="tooltip" title=" <?= $category->title ?>">
                    <?= $category->title ?>
                </a>
            </li>
        <?php endforeach ?>
    </ul>
</div>