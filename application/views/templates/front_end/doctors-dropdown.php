<?php ob_start(); ?>
    <?php $doctors = json_decode($doctors, true); ?>
    <?php if(!isset($doctors['error_message'])): ?>
        <?php foreach ($doctors as $doctor): ?>
            <option value="<?= $doctor['id'] ?>"><?= ucwords($doctor['full_name']) ?></option>        
        <?php endforeach ?>
    <?php else: ?>
        <option value="0"><?= $doctors['error_message'] ?></option>
    <?php endif; ?>
<?= ob_get_clean(); ?>