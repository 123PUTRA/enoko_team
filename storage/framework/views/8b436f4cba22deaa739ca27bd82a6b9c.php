<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Detail Toko</h1>

        <div class="card">
            <div class="card-body">
                <img src="<?php echo e(asset($store->image_path)); ?>" class="card-img-top" alt="Image" style="object-fit: cover; height: 200px;">
                <h2 class="card-title"><?php echo e($store->name); ?></h2>
                <p class="card-text">Category UMKM: <?php echo e($store->category); ?></p>
                <p class="card-text">Deskripsi Toko: <?php echo e($store->description); ?></p>
            </div>
        </div>

        <h2 class="mt-4">Barang-barang:</h2>
        <div class="row">
            <?php $__currentLoopData = $barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 mb-4">
                    <img src="<?php echo e(asset('uploads/' . $barang->gambar_path)); ?>" class="card-img-top" alt="Image" style="object-fit: cover; height: 200px;">
                    <div class="card">
                      <div class="card-body">
                            <h5 class="card-title"><?php echo e($barang->nama_barang); ?></h5>
                            <p class="card-text">Deskripsi: <?php echo e($barang->deskripsi); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\enoko1\E-noko\resources\views/store/detail.blade.php ENDPATH**/ ?>