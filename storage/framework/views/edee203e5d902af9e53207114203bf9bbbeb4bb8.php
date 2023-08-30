<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="product">
        <h2><?php echo e($product['product_name']); ?></h2>
        <p>Price: <?php echo e($product['price']); ?></p>
        <p>Stock: <?php echo e($product['stock']); ?></p>
        <p>Company: <?php echo e($product['company_name']); ?></p>
        <form action="<?php echo e(route('products.destroy', $product['id'])); ?>" method="POST" class="delete-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit">Delete</button>
        </form>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\MANP\MAMP\htdocs\practice\resources\views/partials/product_list.blade.php ENDPATH**/ ?>