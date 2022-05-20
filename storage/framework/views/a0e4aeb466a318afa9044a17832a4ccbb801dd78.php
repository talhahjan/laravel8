

<?php $__env->startSection('title', 'Admin dashboard :: section'); ?>

<?php $__env->startSection('breadcrumbs'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Sections</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content" style="padding:20px">
    <div class="container-fluid">


        <?php if(session()->has('message')): ?>
        <div class="col-md-12">
            <div class="alert alert-success">
                <?php echo e(session('message')); ?>

            </div>

        </div>
        <?php endif; ?>


        <?php if(session()->has('error')): ?>
        <div class="col-md-12">
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>

        </div>
        <?php endif; ?>




        <div class="card">

            <div class="card-header">
                <h3 class="card-title"><strong>Section</strong></h3>
                <a href="<?php echo e(route('admin.section.create')); ?>"><button class="btn btn-outline-primary btn-sm float-right"><i class="fa fa-plus-circle"></i> Add
                        Section</button></a>
            </div><!-- card header -->

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>description</th>
                            <th>Total Cats</th>
                            <th>slug</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if($sections->count() > 0): ?>
                        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="<?php echo e($section->id); ?>">
                            <td><?php echo e($section->id); ?></td>
                            <td><?php echo e($section->title); ?> </td>
                            <td>{<?php echo $section->description; ?>}</td>
                            <td><?php echo e(count($section->categories)); ?></td>

                            <td><?php echo e($section->slug); ?></td>
                            <td>
                                <div class="btn-group btn-group-sm" style="max-height: 30px" role="group" aria-label="Basic example">
                                    <a href="<?php echo e(route('admin.section.edit',$section->slug)); ?>" class="btn btn-default btn-sm" title="Click To Edit">
                                        <i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-default btn-sm" title="Click Enable/Disable Status">
                                        <i class="fa <?php echo e($section->status==1 ? 'fa-eye' : 'fa-eye-slash'); ?>" onclick="changeStatus(this)" aria-hidden="true" id="status_<?php echo e($section->id); ?>"></i> </a>
                                    <a href=" #" onclick="confirmDelete(this)" class="btn btn-default btn-sm" title="Click to delete this record">
                                        <i class="fa fa-trash" style="display:inline"></i>
                                    </a>
                                </div>
                            </td>


                        </tr>


                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7">
                                <p class="text-center">No records in database</p>
                            </td>
                        </tr>
                        <?php endif; ?>

                    </tbody>


                </table>
                <div class="card-footer float-right">
                    <?php echo e($sections->Links()); ?>

                </div>

            </div>


        </div>


    </div>
</section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('Css'); ?>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('JsScript'); ?>


<script src="<?php echo e(asset('assets/admin_plugins/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
<script>
    $("#inputGroupFile01").change(function(event) {
        RecurFadeIn();
        readURL(this);
    });
    $("#inputGroupFile01").on('click', function(event) {
        RecurFadeIn();
    });
    const readURL = (input) => {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $("#inputGroupFile01").val();
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            reader.onload = function(e) {
                debugger;
                $('#blah').attr('src', e.target.result);
                $('#blah').attr('class', 'rounded-circle');
                $('#blah').hide();
                $('#blah').fadeIn(500);
                $('.custom-file-label').text(filename);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    const RecurFadeIn = () => {
        console.log('ran');
        FadeInAlert("Wait for it...");
    }
    const FadeInAlert = (text) => {
        $(".alert").show();
        $(".alert").text(text).addClass("loading");
    }
    const notify = (type, msg, title = 'Alert !') => {
        $.notify({
            title: `<strong>${title}</strong>`,
            icon: type == 'success' ? 'fa fa-check' : 'fa fa-ban',
            message: msg
        }, {
            type: type,
            animate: {
                enter: 'animated fadeInUp',
                exit: 'animated fadeOutRight'
            },
            placement: {
                from: "bottom",
                align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
        });
    }
    const deleteSection = (selector) => {
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const row = $(selector).parent().parent().parent();
        const id = $(row).attr('id');
        $.ajax({
            url: "<?php echo e(route('admin.section.destroy',1)); ?>",
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
    const confirmDelete = (selector) => {
        let choice = confirm("Are You sure, You want to Delete this record ? All its Sub-categories will also be deleted ");
        if (choice) {
            deleteSection(selector);
        }
    }
    const changeStatus = (selector) => {
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const currentStatus = $(selector).hasClass('fa-eye-slash') ? 0 : 1;
        const id = $(selector).parent().parent().parent().parent().attr('id');
        // console.log(id)
        $.ajax({
            url: "<?php echo e(route('admin.section.changestatus')); ?>",
            type: "POST",
            data: {
                'record_id': id,
                '_token': CSRF_TOKEN,
                'currentstatus': currentStatus,
            },
            success: function(response) {
                // console.log(response);
                notify(response.type, response.msg);
                $(selector).toggleClass('fa-eye fa-eye-slash');
            },
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Admin.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\webserver\www\l8ecom\resources\views/admin/sections/index.blade.php ENDPATH**/ ?>