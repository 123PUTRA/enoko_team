 

<?php $__env->startSection('content'); ?>
    <h2>Shopping Cart</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if(count($cart) > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(isset($item['nama_barang']) ? $item['nama_barang'] : $item['barang']['nama_barang']); ?></td>
                        <td>Rp<?php echo e(isset($item['harga']) ? $item['harga'] : $item['barang']['harga']); ?></td>
                        <td>
                            <form action="<?php echo e(route('cart.update', $item->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" min="1">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>Rp<?php echo e(isset($item['harga']) ? $item['harga'] * $item['quantity'] : $item['barang']['harga'] * $item['quantity']); ?></td>
                        <td>
                            <form action="<?php echo e(route('cart.remove', $item->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('delete'); ?>
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div>
            <p>Total Belanja: Rp<?php echo e($total); ?></p>
            <form action="<?php echo e(route('cart.checkout')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <button type="submit">Beli</button>
            </form>
        </div>
    <?php else: ?>
        <p>Keranjang belanja Anda kosong.</p>
    <?php endif; ?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\enoko1\E-noko\resources\views/component/cart.blade.php ENDPATH**/ ?>