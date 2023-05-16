<?php $__env->startSection('content'); ?>

<!-- CSSは下にある方が優先されるのでここに読み込むように記載している
-->
<link rel="stylesheet" href="<?php echo e(asset('css/register.css')); ?>">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品情報詳細</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <h4>商品ID</h4>
                    <p><?php echo e($products->id); ?></p>
                    <h4>商品画像</h4>
                    <p><?php echo e($products->img_path); ?></p>
                    <h4>商品名</h4>
                    <p><?php echo e($products->product_name); ?></p>
                    <h4>メーカー</h4>
                    <p><?php echo e($products->company_name); ?></p>
                    <h4>価格</h4>
                    <p><?php echo e($products->price); ?></p>
                    <h4>在庫数</h4>
                    <p><?php echo e($products->stock); ?></p>
                    <h4>コメント</h4>
                    <p><?php echo e($products->comment); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td><a href="<?php echo e(route('edit', ['id'=>$products->id])); ?>" class="btn btn-info">編集</a></td>
                    <td><a href="<?php echo e(route('plist')); ?>">戻る</a></td>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MANP\MAMP\htdocs\practice\resources\views/detail.blade.php ENDPATH**/ ?>