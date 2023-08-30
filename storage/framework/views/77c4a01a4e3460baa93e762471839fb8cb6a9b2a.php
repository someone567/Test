<?php $__env->startSection('content'); ?>

<!-- CSSは下にある方が優先されるのでここに読み込むように記載している
-->
<link rel="stylesheet" href="<?php echo e(asset('css/register.css')); ?>">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品情報編集</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="<?php echo e(route('update', $products->id)); ?>">
                    <?php echo csrf_field(); ?>


                        <div class="form-group">
                        <label for="product_name">商品名</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo e($products->product_name); ?>">
                    <?php if($errors->has('product_name')): ?>
                        <p><?php echo e($errors->first('product_name')); ?></p>
                    <?php endif; ?>
                        </div>

                        <div class="form-group">
                    <label for="company_id">会社名</label>
                    <select name="company_id">
                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($company->id); ?>" <?php echo e($products->company_id == $company->id ? 'selected' : ''); ?>>
                    <?php echo e($company->company_name); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('company_name')): ?>
                        <p><?php echo e($errors->first('company_name')); ?></p>
                    <?php endif; ?>
                    </div>


                        <div class="form-group">
                    <label for="price">価格</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo e($products->price); ?>">
                    <?php if($errors->has('price')): ?>
                        <p><?php echo e($errors->first('price')); ?></p>
                    <?php endif; ?>
                    </div>

                    <div class="form-group">
                    <label for="stock">在庫数</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="<?php echo e($products->stock); ?>">
                    <?php if($errors->has('stock')): ?>
                        <p><?php echo e($errors->first('stock')); ?></p>
                    <?php endif; ?>
                    </div>

                    <div class="form-group">
                    <label for="comment">コメント</label>
                    <textarea class="form-control" id="comment" name="comment">
                    <?php echo e(old('comment')); ?>

                    </textarea>
                    <?php if($errors->has('comment')): ?>
                        <p><?php echo e($errors->first('comment')); ?></p>
                    <?php endif; ?>
                    </div>

                    <div class="form-group2">
                    <label for="img_path">商品画像</label>
                    <input type="text" class="form-control" id="img_path" name="img_path" value="<?php echo e($products->img_path); ?>">
                    </div>

                    <div>
                        <button type="submit">更新</button>
                    </div>

                    <a href="<?php echo e(route('plist')); ?>">戻る</a>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MANP\MAMP\htdocs\practice\resources\views/edit.blade.php ENDPATH**/ ?>