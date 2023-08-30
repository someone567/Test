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

                <!-- 検索フォーム -->
<form action="<?php echo e(route('plist')); ?>" method="GET">
    <div class="form-group">
        <label for="product_name">商品名:</label>
        <input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo e(request()->input('product_name')); ?>">
    </div>
    <div class="form-group">
        <label for="company_id">メーカー:</label>
        <select id="company_id" name="company_id" class="form-control">
            <option value="">-- 選択してください --</option>
            <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($company->id); ?>" <?php echo e(request()->input('company_id') == $company->id ? 'selected' : ''); ?>>
                    <?php echo e($company->company_name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="form-group">
        <label for="min_price">最低価格:</label>
        <input type="number" id="min_price" name="min_price" class="form-control" value="<?php echo e(request()->input('min_price')); ?>">
    </div>
    <div class="form-group">
        <label for="max_price">最高価格:</label>
        <input type="number" id="max_price" name="max_price" class="form-control" value="<?php echo e(request()->input('max_price')); ?>">
    </div>
    <div class="form-group">
        <label for="min_stock">最低在庫数:</label>
        <input type="number" id="min_stock" name="min_stock" class="form-control" value="<?php echo e(request()->input('min_stock')); ?>">
    </div>
    <div class="form-group">
        <label for="max_stock">最高在庫数:</label>
        <input type="number" id="max_stock" name="max_stock" class="form-control" value="<?php echo e(request()->input('max_stock')); ?>">
    </div>
    <button type="submit" class="btn btn-primary">検索</button>
</form>

    <div id="product-list" class="links">
    <table id="fav-table" class="table table-bordered">
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
                    <td>
                        <a href="<?php echo e(route('detail', ['id' => $product->id])); ?>">
                            <button type="button" class="btn btn-detail">詳細</button>
                        </a>
                    </td>
                    <td>
                        <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger" data-delete-id="<?php echo e($product->id); ?>" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MANP\MAMP\htdocs\practice\resources\views/plist.blade.php ENDPATH**/ ?>