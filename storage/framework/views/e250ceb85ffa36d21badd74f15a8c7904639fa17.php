<?php $__env->startSection('title', 'Admin dashboard :: section'); ?>

<?php $__env->startSection('breadcrumbs'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Categories</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content" style="padding:20px">
    <div class="container-fluid">



        <div class="card">

            <div class="card-header">
                <h3 class="card-title"><strong>Categories</strong></h3>
                <a href="<?php echo e(route('admin.category.create')); ?>"><button class="btn btn-outline-primary btn-sm float-right"><i class="fa fa-plus-circle"></i> Add
                        Categories</button></a>
            </div><!-- card header -->

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Products</th>
                            <th>Section</th>
                            <th>description</th>
                            <th>slug</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($categories->count() > 0): ?>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="<?php echo e($category->id); ?>">
                            <td><?php echo e($category->id); ?></td>
                            <td><?php echo e($category->title); ?> </td>
                            <td><?php echo e(count($category->products)); ?> </td>
                            <td><?php echo e($category->section->title); ?></td>
                            <td>{<?php echo $category->description; ?>}</td>
                            <td><?php echo e($category->slug); ?></td>
                            <td>
                                <div class="btn-group btn-group-sm" style="max-height: 30px" role="group" aria-label="Basic example">
                                    <a href="<?php echo e(route('admin.category.edit',$category->slug)); ?>" class="btn btn-default btn-sm" title="Click To Edit">
                                        <i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-default btn-sm" title="Click Enable/Disable Status">
                                        <i class="fa <?php echo e($category->status==1 ? 'fa-eye' : 'fa-eye-slash'); ?>" onclick="changeStatus(this)" aria-hidden="true" id="status_<?php echo e($category->id); ?>"></i> </a>
                                    <a href=" #" onclick="confirmDelete(this)" class="btn btn-default btn-sm" title="Click to delete this record">
                                        <i class="fa fa-trash" style="display:inline"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="8">
                                <p class="text-center">No records in database</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                </table>
                <div class="card-footer float-right">
                    <?php echo e($categories->Links()); ?>

                </div>

            </div>


        </div>
</div>
</section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('Css'); ?>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('JsScript'); ?>
<script>

const notify = (type, msg) => {
    switch (type) {
        case 'success':
            toastr.success(msg);
            break;
        case 'danger':
            toastr.error(msg);
            break;
        case 'warning':
            toastr.warning(msg);
            break;
        case 'alert':
            toastr.alert(msg);
            break;
        case 'info':
            toastr.info(msg);
            break;

    }


}
    
    const deleteCategory = (selector) => {
     const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const row = $(selector).parent().parent().parent();
        const id = $(row).attr('id');

        $.ajax({
            url: "<?php echo e(route('admin.category.destroy',1)); ?>",
            type: "POST",
            data: {
                'record_id': id,
                '_token': CSRF_TOKEN,
                '_method': 'DELETE',
            },
            dataType: 'json',
            success: function(response) {
                console.log();
                if (response) {
                    notify(response.type, response.msg);
                    $(row).fadeOut(500);
                }
            },
        });


    }


    const confirmDelete=(id) =>{
        let choice = confirm("Are You sure, You want to Delete this record ? All its Sub-categories will also be deleted ");
        if (choice) {
            deleteCategory(id);
        }
    }









    function changeStatus(selector) {

        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const _token = $('meta[name="csrf-token"]').attr('content');
        let currentStatus = $(selector).hasClass('fa-eye-slash') ? 0 : 1;
        let id = $(selector).parent().parent().parent().parent().attr('id');
        // console.log(id)
        $.ajax({
            url: "<?php echo e(route('admin.category.changestatus')); ?>",
            type: "POST",
            data: {
                record_id: id,
                _token: _token,
                'currentstatus': currentStatus,
            },

            success: function(response) {
                console.log(response);
                notify(response.type, response.msg);
                $(selector).toggleClass('fa-eye fa-eye-slash');
            },
        });


    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Admin.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WebServer\www\l8ecom\resources\views/admin/category/index.blade.php ENDPATH**/ ?>