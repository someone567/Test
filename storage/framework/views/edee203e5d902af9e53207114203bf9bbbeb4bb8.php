<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($product->id); ?></td>
        <td><img src="<?php echo e(asset($product->img_path)); ?>" width="150" height="100"></td>
        <td><?php echo e($product->product_name); ?></td>
        <td><?php echo e($product->price); ?></td>
        <td><?php echo e($product->stock); ?></td>
        <td><?php echo e($product->company->company_name); ?></td>
        <td>
            <a href="<?php echo e(route('detail', ['id' => $product->id])); ?>">
                <button type="button" class="btn btn-detail">詳細</button>
            </a>
        </td>
        <td>
            <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </td>
    </tr>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php /**PATH D:\MANP\MAMP\htdocs\practice\resources\views/partials/product_list.blade.php ENDPATH**/ ?>