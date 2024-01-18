<div class="card" style="width: 18rem;">
    <img src="<?php echo e(asset('uploads/' . $barang->gambar_path)); ?>" class="card-img-top" alt="Image" style="object-fit: cover; height: 200px;">
    <div class="card-body">
        <h5 class="card-title">
            <a href="<?php echo e(route('store.detail', ['storeId' => $store->id])); ?>"><?php echo e($store->name); ?></a>
        </h5>
        <p class="card-text"><?php echo e($barang->deskripsi); ?></p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Nama Barang: <?php echo e($barang->nama_barang); ?></li>
        <li class="list-group-item">Harga: <?php echo e($barang->harga); ?></li>
        <li class="list-group-item">Quantity: <?php echo e($barang->quantity); ?></li>
        <li class="list-group-item">
            Kategori:
            <a href="<?php echo e(route('barang.category', ['category' => $barang->category])); ?>">
                <?php echo e($barang->category); ?>

            </a>
        </li>
    </ul>
    <div class="card-body">
        <form action="<?php echo e(route('barang.addToCart', $barang->id)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-primary">Add to Cart</button>
        </form>
        <a href="<?php echo e(route('cart.show')); ?>" class="btn btn-warning">Beli</a>
    </div>
</div>
<?php /**PATH C:\laragon\www\enoko1\E-noko\resources\views/component/card.blade.php ENDPATH**/ ?>