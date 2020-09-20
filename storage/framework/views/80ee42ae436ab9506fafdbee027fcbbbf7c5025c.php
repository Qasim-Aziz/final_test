<?php $attributes = $attributes->exceptProps(['active']); ?>
<?php foreach (array_filter((['active']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 pb-0.5 border-2 border-purple-600 text-purple-600 uppercase hover:bg-purple-600 hover:text-white text-sm font-bold transition duration-150 ease-in-out rounded-full transform hover:scale-110'
            : 'inline-flex items-center px-4 pb-0.5 border-2 border-purple-600 text-purple-600 uppercase hover:bg-purple-600 hover:text-white text-sm font-bold transition duration-150 ease-in-out rounded-full transform hover:scale-110';
?>

<a <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php echo e($slot); ?>

</a>
<?php /**PATH /var/www/html/resources/views/components/nav-button.blade.php ENDPATH**/ ?>