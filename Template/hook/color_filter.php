<?php if (isset($colors_list) && ! empty($colors_list)): ?>
<div class="input-addon-item">
    <div class="dropdown">
        <a href="#" class="dropdown-menu dropdown-menu-link-icon" title="<?= t('Colour filters') ?>" aria-label="<?= t('Colour filters') ?>"><i class="fa fa-paint-brush fa-fw"></i><i class="fa fa-caret-down"></i></a>
        <ul>
            <?php foreach ($colors_list as $color): ?>
                <li>
                    <div class="color-picker-square color-<?= str_replace(' ', '_', strtolower($color)) ?>"></div>
                    <a href="#" class="filter-helper" data-unique-filter='color:"<?= $this->text->e($color) ?>"'><?= $this->text->e($color) ?></a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
<?php endif ?>
