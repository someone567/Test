<link rel="stylesheet" href="<?php echo e(asset('css/plist.css')); ?>">

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品情報一覧</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo e(session('status')); ?>

                    </div>
                    <?php endif; ?>
                    <a href="<?php echo e(route('pregister')); ?>">新規登録</a>
                </div>
                <div class="links">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫</th>
            <th>メーカー</th>
            <th>詳細</th>
            <th>削除</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($product->id); ?></td>
            <td><img src="<?php echo e(asset($product->img_path)); ?>" width="150" height="100"></td>
            <td><?php echo e($product->product_name); ?></td>
            <td><?php echo e($product->price); ?></td>
            <td><?php echo e($product->stock); ?></td>
            <td><?php echo e($product->company_name); ?></td>
            <td><a href="<?php echo e(route('detail', ['id' => $product->id])); ?>"><button type="button" class="btn btn-detail">詳細</button></a></td>
            <td>
            <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
            </form>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MANP\MAMP\htdocs\practice\resources\views/plist.blade.php ENDPATH**/ ?>