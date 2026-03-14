<?php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();

    // Profile Image
    $profileImage = $user->profile_image;

    // Cart / Wishlist
    $homeClient = getHomeClient();

    $cartCount     = $homeClient['data']['cart'] ?? 0;
    $wishlistCount = $homeClient['data']['wishlist'] ?? 0;
    $currency      = $homeClient['data']['currency'] ?? '$';

   
     $logo = !empty(get('company_logo'))
    ? asset('storage/' . get('company_logo'))
    : asset('assets/backend/img/logo.svg');

?>

<div class="header">
    <div class="main-header">

        <!-- Logo -->
        <div class="header-left">
            <a href="<?php echo e(route('dashboard')); ?>" class="logo">
                <img src="<?php echo e($logo); ?>" alt="<?php echo e($user->name); ?>">
            </a>
            <a href="<?php echo e(route('dashboard')); ?>" class="dark-logo">
                <img src="<?php echo e($logo); ?>" alt="<?php echo e($user->name); ?>">
            </a>
        </div>

        <!-- Sidebar Toggle -->
        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon"><span></span><span></span><span></span></span>
        </a>

        <div class="header-user">
            <div class="nav user-menu nav-list">

                <!-- Breadcrumb -->
                <div class="me-auto d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-divide mb-0">
                            <?php $__currentLoopData = generateBreadcrumbs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <?php if($loop->last): ?>
                                        <span class="active"><?php echo e($breadcrumb['title']); ?></span>
                                    <?php else: ?>
                                        <a href="<?php echo e($breadcrumb['url']); ?>">
                                            <i class="isax isax-home-2 me-1"></i>
                                            <?php echo e($breadcrumb['title']); ?>

                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex align-items-center">

                   


                    <!-- Theme Toggle -->
                    <div class="me-2">
                        <a id="dark-mode-toggle" class="btn btn-menubar">
                            <i class="isax isax-moon"></i>
                        </a>
                        <a id="light-mode-toggle" class="btn btn-menubar">
                            <i class="isax isax-sun-1"></i>
                        </a>
                    </div>

                    <!-- User Dropdown -->
                    <div class="dropdown profile-dropdown">
                        <a class="dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                            <img src="<?php echo e($profileImage); ?>" class="rounded-circle" width="36">
                        </a>

                        <div class="dropdown-menu p-2">
                            <div class="d-flex align-items-center bg-light rounded p-2 mb-2">
                                <img src="<?php echo e($profileImage); ?>" class="rounded-circle me-2" width="48">
                                <div>
                                    <h6 class="mb-0"><?php echo e($user->name); ?></h6>
                                    <small class="text-muted">
                                        <?php echo e($user->is_superadmin ? 'Super Admin' : $user->getRoleNames()[0]); ?>

                                    </small>
                                </div>
                            </div>

                            <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                                <i class="isax isax-profile-circle me-2"></i>Profile Settings
                            </a>

                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="isax isax-logout me-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\wamp64\www\hrm\resources\views/backend/partials/header.blade.php ENDPATH**/ ?>