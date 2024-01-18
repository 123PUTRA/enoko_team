<!-- resources/views/barang/edit.blade.php -->



<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Edit Barang</h1>

        <!-- Tampilkan form edit barang -->
        <form action="<?php echo e(route('barang.update', $barang->id)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>

            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" name="nama_barang" class="form-control" value="<?php echo e($barang->nama_barang); ?>" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control" required><?php echo e($barang->deskripsi); ?></textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" name="harga" class="form-control" value="<?php echo e($barang->harga); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\enoko1\E-noko\resources\views/barang/edit.blade.php ENDPATH**/ ?>