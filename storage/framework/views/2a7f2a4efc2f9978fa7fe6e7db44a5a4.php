<!-- resources/views/navbar.blade.php -->


<nav class="navbar navbar-expand-lg bg-warning">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo e(route('home')); ?>">Home</a>
        </li>
        <?php if(auth()->guard()->check()): ?>
          <?php if(auth()->user()->store): ?>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo e(route('store.dashboard')); ?>">Dashboard</a>
              </li>
          <?php else: ?>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo e(route('store.open_store_form')); ?>">Buka Toko</a>
              </li>
          <?php endif; ?>
        <?php else: ?>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo e(route('login')); ?>">Buka Toko</a>
          </li>
        <?php endif; ?>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Kategori
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo e(route('category.show', 'menengah')); ?>">UMKM Menengah</a></li>
                <li><a class="dropdown-item" href="<?php echo e(route('category.show', 'kecil')); ?>">UMKM Kecil</a></li>
        </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
        <ul>
            <a href="<?php echo e(route('cart.show')); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                </svg>
            </a>
        </ul>

        <form class="d-flex" action="<?php echo e(route('barang.search')); ?>" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query" value="<?php echo e(request('query')); ?>">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>




      <?php if(auth()->guard()->check()): ?>
        <form action="<?php echo e(route('logout')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <button class="btn btn-outline-primary" type="submit">Logout</button>
        </form>
      <?php else: ?>
        <a class="btn btn-outline-primary" href="<?php echo e(route('login')); ?>">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>







<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\enoko1\E-noko\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>