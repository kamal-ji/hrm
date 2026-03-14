 

 <?php $__env->startSection('content'); ?>
     <div class="content">
         <!-- start row -->
         <div class="row justify-content-center">
             <div class="col-xl-12">
                 <!-- start row -->
                 <div class="row settings-wrapper d-flex">
                     <!-- Start settings sidebar -->
                     <div class="col-xl-3 col-lg-4">
                         <div class="card settings-card">
                             <div class="card-header">
                                 <h6 class="mb-0">Settings</h6>
                             </div>
                             <div class="card-body">
                                 <div class="sidebars settings-sidebar">
                                     <div class="sidebar-inner">
                                         <div class="sidebar-menu p-0">
                                             <ul>
                                                 <li class="submenu-open">
                                                     <ul>
                                                         <li class="submenu">
                                                             <a href="javascript:void(0);" class="active subdrop">
                                                                 <i class="isax isax-setting-2 fs-18"></i>
                                                                 <span class="fs-14 fw-medium ms-2">General Settings</span>
                                                                 <span
                                                                     class="isax isax-arrow-down-1 arrow-menu ms-auto"></span>
                                                             </a>
                                                             <ul>
                                                                 <li><a href="<?php echo e(route('profile')); ?>" class="active">Account
                                                                         Settings</a></li>

                                                             </ul>
                                                         </li>
                                                         <li class="submenu">
                                                             <a href="javascript:void(0);">
                                                                 <i class="isax isax-global fs-18"></i>
                                                                 <span class="fs-14 fw-medium ms-2">Website Settings</span>
                                                                 <span
                                                                     class="isax isax-arrow-down-1 arrow-menu ms-auto"></span>
                                                             </a>
                                                             <ul>
                                                                 <li><a href="<?php echo e(route('profile.company-setting')); ?>">Company
                                                                         Settings</a></li>

                                                             </ul>
                                                         </li>

                                                         <li class="submenu">
                                                             <a href="javascript:void(0);">
                                                                 <i class="isax isax-more-2 fs-18"></i>
                                                                 <span class="fs-14 fw-medium ms-2">System Settings</span>
                                                                 <span
                                                                     class="isax isax-arrow-down-1 arrow-menu ms-auto"></span>
                                                             </a>
                                                             <ul>
                                                                 <li><a href="<?php echo e(route('profile.email-setting')); ?>">Email
                                                                         Settings</a></li>

                                                             </ul>
                                                         </li>

                                                     </ul>
                                                 </li>
                                             </ul>
                                         </div>
                                     </div>
                                 </div>
                             </div><!-- end card body -->
                         </div><!-- end card -->
                     </div><!-- end col -->

                     <!-- End settings sidebar -->

                     <div class="col-xl-9 col-lg-8">
                         <div class="mb-3">
                             <div class="pb-3 border-bottom mb-3">
                                 <h6 class="mb-0">Account Settings</h6>
                             </div>
                             <div class="d-flex align-items-center mb-3">
                                 <span class="bg-dark avatar avatar-sm me-2 flex-shrink-0"><i
                                         class="isax isax-info-circle fs-14"></i></span>
                                 <h6 class="fs-16 fw-semibold mb-0">General Information</h6>
                             </div>
                            
                             <form action="#" method="POST" enctype="multipart/form-data" id="profileForm">
                                 <?php echo csrf_field(); ?>
                                 <div class="mb-3">
                                     <span class="text-gray-9 fw-bold mb-2 d-flex">Profile Image<span
                                             class="text-danger ms-1">*</span></span>
                                     <div class="d-flex align-items-center">
                                         <div class="avatar avatar-xxl border border-dashed bg-light me-3 flex-shrink-0">
                                             <div class="position-relative d-flex align-items-center">
                                            <img src="<?php echo e($user->image ? asset('storage/' . $user->image) : asset('assets/backend/img/users/user-01.jpg')); ?>"
     class="avatar avatar-xl" alt="User Img">


<a href="javascript:void(0);"
   class="rounded-trash trash-top d-flex align-items-center justify-content-center">
    <i class="isax isax-trash"></i>
</a>

                                             </div>
                                         </div>
                                         <div class="d-inline-flex flex-column align-items-start">
                                             <div class="drag-upload-btn btn btn-sm btn-primary position-relative mb-2">
                                                 <i class="isax isax-image me-1"></i>Upload Image
                                                 <input type="file" class="form-control image-sign" name="image">
                                             </div>
                                             <span class="text-gray-9 fs-12">JPG or PNG format, not exceeding 5MB.</span>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="border-bottom mb-3 pb-2">

                                     <!-- start row -->
                                     <div class="row gx-3">

                                         <div class="col-lg-4 col-md-6">
                                             <div class="mb-3">
                                                 <label class="form-label">First Name <span class="text-danger">*</span></label>
                                                 <input type="text" name="first_name" value="<?php echo e($user['first_name']); ?>"
                                                     class="form-control" required>
                                             </div>
                                         </div><!-- end col -->
                                         <div class="col-lg-4 col-md-6">
                                             <div class="mb-3">
                                                 <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                                 <input type="text" name="last_name" value="<?php echo e($user['last_name']); ?>"
                                                     class="form-control" required>
                                             </div>
                                         </div><!-- end col -->
                                         <div class="col-lg-4 col-md-6">
                                             <div class="mb-3">
                                                 <label class="form-label">Email <span class="text-danger">*</span></label>
                                                 <input type="text" name="email" value="<?php echo e($user['email']); ?>"
                                                     class="form-control" required>
                                             </div>
                                         </div><!-- end col -->
                                         <div class="col-lg-4 col-md-6">
                                             <div class="mb-3">
                                                 <label class="form-label">Mobile Number <span
                                                         class="text-danger">*</span></label>
                                                 <input type="text" name="mobile" value="<?php echo e($user['mobile']); ?>"
                                                     class="form-control" required>
                                             </div>
                                         </div><!-- end col -->
                                         <div class="col-lg-4 col-md-6">
                                             <div class="mb-3">
                                                 <label class="form-label">DOB</label>
                                                 <div class="input-group position-relative mb-3">
                                                     <input type="text" name="dob" value="<?php echo e($user['dob']); ?>"
                                                         class="form-control datetimepicker rounded-end"
                                                         placeholder="YYYY-MM-DD" required>
                                                     <span class="input-icon-addon fs-16 text-gray-9">
                                                         <i class="isax isax-calendar-2"></i>
                                                     </span>
                                                 </div>
                                             </div>
                                         </div><!-- end col -->
                                         <div class="col-lg-4 col-md-6">
                                             <div class="mb-3">
                                                 <label class="form-label">Anniversary</label>
                                                 <div class="input-group position-relative mb-3">
                                                     <input type="text" name="anniversary" value="<?php echo e($user['anniversary']); ?>"
                                                         class="form-control datetimepicker rounded-end"
                                                         placeholder="YYYY-MM-DD" required>
                                                     <span class="input-icon-addon fs-16 text-gray-9">
                                                         <i class="isax isax-calendar-2"></i>
                                                     </span>
                                                 </div>
                                             </div>
                                         </div><!-- end col -->
                                     </div><!-- end row -->
                                 </div>
                                 <div class="border-bottom mb-3">
                                     <div class="d-flex align-items-center mb-3">
                                         <span class="bg-dark avatar avatar-sm me-2 flex-shrink-0"><i
                                                 class="isax isax-info-circle fs-14"></i></span>
                                         <h6 class="fs-16 fw-semibold mb-0">Address Information</h6>
                                     </div>

                                     <!-- start row -->
                                     <div class="row gx-3">
                                         <div class="col-lg-12">
                                             <div class="mb-3">
                                                 <label class="form-label">Address 1</label>
                                                 <input type="text" class="form-control" name="address1"
                                                     value="<?php echo e($user['address1']); ?>" required>
                                             </div>
                                         </div><!-- end col -->
                                         <div class="col-lg-12">
                                             <div class="mb-3">
                                                 <label class="form-label">Address 2</label>
                                                 <input type="text" class="form-control" name="address2"
                                                     value="<?php echo e($user['address2']); ?>" >
                                             </div>
                                         </div><!-- end col -->
                                         <div class="col-md-6">
                                             <div class="mb-3">
                                                 <label class="form-label">Country</label>
                                                 <select class="select" name="countryid"  id="country_list">
                                                     <option value="">Select</option>
                                                     <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                         <option value="<?php echo e($country['id']); ?>" <?php echo e($user['countryid'] == $country['id'] ? 'selected' : ''); ?>><?php echo e($country['name']); ?></option>
                                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 </select>
                                             </div>
                                         </div><!-- end col -->
                                         <div class="col-md-6">
                                             <div class="mb-3">
                                                 <label class="form-label">Region</label>
                                                 <select class="select" name="regionid" required id="state_list">
                                                     <option value="">Select</option>
                                                     <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                         <option value="<?php echo e($state['id']); ?>" <?php echo e($user['regionid'] == $state['id'] ? 'selected' : ''); ?>><?php echo e($state['name']); ?></option>
                                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 </select>
                                             </div>
                                         </div><!-- end col -->
                                         <div class="col-md-6">
                                             <div class="mb-3">
                                                 <label class="form-label">City<span
                                                         class="text-danger ms-1">*</span></label>
                                                 <input type="text" class="form-control" name="city"
                                                     value="<?php echo e($user['city']); ?>" required>
                                             </div>
                                         </div><!-- end col -->
                                         <div class="col-md-6">
                                             <div class="mb-3">
                                                 <label class="form-label">ZIP Code<span
                                                         class="text-danger ms-1">*</span></label>
                                                 <input type="text" class="form-control" name="zip"
                                                     value="<?php echo e($user['zip']); ?>" required>
                                             </div>
                                         </div><!-- end col -->
                                     </div>
                                     <!-- end row -->
                                 </div>

                                 <div class="d-flex align-items-center justify-content-between">
                                     <button type="button" class="btn btn-outline-white">Cancel</button>
                                     <button type="submit" class="btn btn-primary">Save Changes</button>
                                 </div>
                             </form>
                         </div>
                     </div><!-- end col -->
                 </div>
                 <!-- end row -->

             </div><!-- end col -->
         </div>
         <!-- end row -->
     </div>
 <?php $__env->stopSection(); ?>

 <?php $__env->startPush('scripts'); ?>
     <script>
         $('#country_list').change(function() {
             var countryId = $(this).val();

             $.ajax({
                 url: '<?php echo e(route('getstates', ['countryId' => '%country%'])); ?>'.replace('%country%',
                     countryId),
                 type: 'GET',
                 success: function(response) {
                     $('#state_list').html('<option value="">Select</option>');

                     for (var i = 0; i < response.states.length; i++) {
                         $('#state_list').append('<option value="' + response.states[i].id + '">' +
                             response.states[i].name + '</option>');
                     }

                     $('#state_list').trigger('change');
                 }
             });
         });

         jQuery('#profileForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?php echo e(route('profile.update')); ?>',
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    if(response.success){
                        showSuccess(response.message);
                    }else{
                        showError(response.message);
                    }
                },
                error: function(response) {
                    showError(response.responseJSON.message);
                }
            })

            return false;
        })
     </script>
 <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wamp64\www\hrm\resources\views/backend/Profile/profile.blade.php ENDPATH**/ ?>