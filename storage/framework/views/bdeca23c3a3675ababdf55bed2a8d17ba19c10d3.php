<?php $__env->startSection('title', 'Admin dashboard :: user'); ?>

<?php $__env->startSection('breadcrumbs'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Brands</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Main content -->
<section class="content" style="padding:20px">
    <div class="container-fluid">



        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>


        <?php if(session()->has('message')): ?>
        <div class="alert alert-success">
            <?php echo e(session('message')); ?>

        </div>
        <?php endif; ?>

        <div class="card">

            <div class="card-header">
                <h3 class="card-title"><strong>Brands</strong></h3>
                <a href="<?php echo e(route('admin.brand.create')); ?>"><button class="btn btn-outline-primary btn-sm float-right"><i class="fa fa-plus-circle"></i> Add
                        Brand</button></a>
            </div><!-- card header -->

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>title</th>
                            <th>logo</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if($brands->count() > 0): ?>
                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr id="<?php echo e($brand->id); ?>">
                            <td><?php echo e($brand->id); ?></td>

                            <td> <?php echo e($brand->title); ?></td>
                            <td></td>
                            <td>
                                <div class="btn-group btn-group-sm" style="max-height: 30px" role="group" aria-label="Basic example">
                                    <a href="<?php echo e(route('admin.brand.edit',$brand->id)); ?>" class="btn btn-default btn-sm" title="Click To Edit">
                                        <i class="fa fa-edit"></i></a>
                                    <a href=" #" onclick="confirmDelete(this)" class="btn btn-default btn-sm" title="Click to delete this record">
                                        <i class="fa fa-trash" style="display:inline"></i>
                                    </a>
                                </div>

                            </td>


                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="3">
                                <p class="text-center">No records in database</p>
                            </td>
                        </tr>
                        <?php endif; ?>

                    </tbody>

                    </tbody>

                </table>
                <div class="card-footer float-right">
                    <?php echo e($brands->Links()); ?>

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

    const deleteBrand= (selector)=> {
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const _token = $('meta[name="csrf-token"]').attr('content');
        let row = $(selector).parent().parent().parent();
        let id = $(row).attr('id');

        $.ajax({
            url: "<?php echo e(route('admin.brand.destroy',1)); ?>",
            type: "POST",
            data: {
                record_id: id,
                _token: _token,
                '_method': 'DELETE',
            },
            dataType: 'json',
            success: function(response) {
                if (response.type='success') {
                    notify(response.type, response.msg)
                    $(row).fadeOut(500);
                    return true;                    
                }
                else
                notify("error","Record Could't be Delete")
            },
        });

    }



    const confirmDelete=(id) =>{
        let choice = confirm("Are You sure, You want to Delete this record ? All its Sub-categories will also be deleted ");
        if (choice) {
            deleteBrand(id);
        }
    }







    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Admin.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\webserver\www\l8ecom\resources\views/admin/brand/index.blade.php ENDPATH**/ ?>