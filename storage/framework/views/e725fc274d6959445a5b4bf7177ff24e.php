<?php $__env->startSection('content'); ?>
    <h2>Daftar Barang dalam Kategori UMKM <?php echo e($category); ?></h2>

    <div class="row">
        <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $store->barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo e(asset('uploads/' . $barang->gambar_path)); ?>" class="card-img-top" alt="Image" style="object-fit: cover; height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php echo e(route('store.detail', ['storeId' => $store->id])); ?>"><?php echo e($store->name); ?></a>
                            </h5>
                            <h5 class="card-title"><?php echo e($barang->nama_barang); ?></h5>
                            <p class="card-text"><?php echo e($barang->deskripsi); ?></p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Harga: <?php echo e($barang->harga); ?></li>
                                <li class="list-group-item">Quantity: <?php echo e($barang->quantity); ?></li>
                                <li class="list-group-item">
                                    Kategori:
                                    <a href="<?php echo e(route('barang.category', ['category' => $barang->category])); ?>">
                                        <?php echo e($barang->category); ?>

                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('barang.addToCart', $barang->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                            <a href="<?php echo e(route('cart.show')); ?>" class="btn btn-warning">Beli</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\enoko1\E-noko\resources\views/component/categoryUmkm.blade.php ENDPATH**/ ?>