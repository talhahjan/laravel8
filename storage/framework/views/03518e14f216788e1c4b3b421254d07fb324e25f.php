<?php $__env->startSection('title', 'Admin dashboard :: Edit Category'); ?>

<?php $__env->startSection('breadcrumbs'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('admin.category.index')); ?>">Categories</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit Category</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">
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


    <!-- accordian star  -->
    <div id="accordion">
      <!-- form start -->
      <form action="<?php echo e(route('admin.category.update', $category->slug)); ?>" method="post" name="form-example-1" id="form-example-1" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <!-- card common start -->
        <div class="card">
          <div class="card-header" id="common">
            <h5 class="mb-0">
              <button type="button" type="button" class="btn btn-outline" data-toggle="collapse" data-target="#collapseCommon" aria-expanded="true" aria-controls="collapseCommon">
                <strong> Common</strong>
              </button>
            </h5>
          </div>
          <div id="collapseCommon" class="collapse show" aria-labelledby="common" data-parent="#accordion">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Section/Department</label>
            
<select id="section_id" class="form-control" name="section_id" style="width: 100%;">

<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($section->id); ?>"<?php echo e($category->section_id==$section->id ? " selected": ""); ?>><?php echo e($section->title); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
                  </div>
                </div>
              </div>







              <div class="row">
                <div class="col-md-6">
                  <!-- textarea -->
                  <div class="form-group">
                    <label>Category Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo e($category->title); ?>" placeholder="Enter Title">
                    <p class="small"><?php echo e(config('app.url')); ?><span id="url"><?php echo e($category->slug); ?></span></p>
                    <input type="hidden" name="slug" id="slug" value="<?php echo e($category->slug); ?>">

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="customFile">Visibility</label>
                    <select type="text" name="status" class="form-control" id="status">
                      <option value="1" <?php echo e($category->status==0 ? ' selected': ''); ?>>Visible</option>
                      <option value="0" <?php echo e($category->status==1 ? ' selected': ''); ?>>Invisible</option>
                    </select>

                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
        <!-- common card ends  -->

        <!-- card Banner starts -->
        <div class="card">
          <div class="card-header" id="Banner">
            <h5 class="mb-0">
              <button type="button" class="btn btn-outline collapsed" data-toggle="collapse" data-target="#collapseBanner" aria-expanded="false" aria-controls="collapseBanner">
                <strong> Banner</strong>
              </button>
            </h5>
          </div>
          <div id="collapseBanner" class="collapse" aria-labelledby="Banner" data-parent="#accordion">
            <div class="card-body">
              <div class="input-group mb-3">
                <div class="custom-file">
                  <input type="file" id="inputGroupFile01" name="banner" class="form-controll" aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01">Choose
                    file</label>

                </div>

              </div>
              <div class="alert"></div>



              <?php if(isset($category->banner)): ?>
              <div class="row">
                <div class="text-center" id="thumbnail">
                  <img id="blah" class="img-thumbnail" src="<?php echo e(asset($category->banner)); ?>" alt="your image">
                  <a href="#" id="btn-del" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo e($category->id); ?>)"><i class="fa fa-trash"></i></a>
                </div>
              </div>
              <?php endif; ?>

              <?php if(empty($category->banner)): ?>
              <div id="thumbnail">
                <img id="blah" class="img-thumbnail" src="<?php echo e(asset('assets/img/No_image_available.png')); ?>" alt="your image">
              </div>
              <?php endif; ?>


            </div>
          </div>
        </div>
    </div>
    <!-- Banner card ends -->

    <!-- card Description  starts -->
    <div class="card">
      <div class="card-header" id="Description">
        <h5 class="mb-0">
          <button type="button" class="btn btn-outline collapsed" data-toggle="collapse" data-target="#collapseDescription" aria-expanded="false" aria-controls="collapseDescription">
            <strong> Description </strong>
          </button>

        </h5>
      </div>
      <div id="collapseDescription" class="collapse" aria-labelledby="Description" data-parent="#accordion">
        <div class="card-body">
          <div class="row">

            <div class="form-group">
              <textarea name="description" id="description" class="textarea" placeholder="Describe category" style="width: 100%; height: 300px;overflow-y:scroll; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">

<?php echo $category->description; ?>

                      </textarea>
            </div>


          </div>
        </div>
      </div>
    </div>
    <!-- Description  card ends -->




    <!-- card MetaData  starts -->
    <div class="card">
      <div class="card-header" id="MetaData">
        <h5 class="mb-0">
          <button type="button" class="btn btn-outline collapsed" data-toggle="collapse" data-target="#collapseMetaData" aria-expanded="false" aria-controls="collapseMetaData">
            <strong>SEO Friendly Meta data </strong>
          </button>

        </h5>
      </div>
      <div id="collapseMetaData" class="collapse" aria-labelledby="MetaData" data-parent="#accordion">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              <!-- textarea -->
              <div class="form-group">
                <label>Meta description</label>
                <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter ...">
                <?php echo e($category->meta_description); ?>

                </textarea>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Meta Title</label>
                <textarea class="form-control" name="meta_title" id="meta_title" rows="3" placeholder="Enter ...">
                <?php echo e($category->meta_title); ?>

                </textarea>
              </div>
            </div>
          </div>


          <div class="row">

            <div class="col-12">
              <div class="form-group">
                <label>Meta Keywords</label>
                <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter ...">
                <?php echo e($category->meta_keywords); ?>

                </textarea>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
    <!-- MetaData  card ends -->


    <div>
      <button type="submit" type="submit" class="btn btn-block btn-outline-primary"><i class="fas fa-plus-circle"></i> Edit Category</button>
    </div>
    </form>

  </div>
  <!-- accordion end  -->

  </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('Css'); ?>
 <!-- Select2 -->
 <link rel="stylesheet" href="<?php echo e(asset('assets/admin_plugins/select2/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/admin_plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
<!-- summernote -->
<link rel="stylesheet" href="<?php echo e(asset('assets/admin_plugins/summernote/summernote-bs4.css')); ?>">

<style>
  .hidden {
    display: none;
  }

  #thumbnail {
    position: relative;
    width: 100%;
    max-width: 320px;

  }

  #thumbnail img {
    width: 100%;
    height: auto;
  }

  #thumbnail .btn {
    position: absolute;
    top: 20%;
    left: 90%;
    transform: translate(-50%, -50%);
    cursor: pointer;
    text-align: center;
  }
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('JsScript'); ?>
<!-- Select2 -->
<script src="<?php echo e(asset('assets/admin_plugins/select2/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin_plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin_plugins/bootstrap-notify/notify.js')); ?>"></script>

<script>
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

  const deleteImage = (id) => {
    $(document).ready(function() {
      const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

      let record_id = id;
      const _token = $('meta[name="csrf-token"]').attr('content');
      const table = 'categories';
      $.ajax({
        url: "<?php echo e(route('admin.delete.image')); ?>",
        type: "POST",
        data: {
          record_id: id,
          _token: _token,
          'table': table,
        },
        dataType: 'json',
        success: function(response) {
          console.log();
          if (response) {
            notify(response.type, response.msg);
            $('#blah').fadeOut(500);
            $('#blah').hide()
            $('#btn-del').hide();
          }
        },
      });
    });

  }


  const confirmDelete = (id) => {
    let choice = confirm("Are You sure, You want to Delete this record ? All its Sub-categories will also be deleted ");
    if (choice) {
      deleteImage(id);
    }
  }

  $("#inputGroupFile01").change(function(event) {

    readURL(this);
  });

  const readURL = (input) => {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      var filename = $("#inputGroupFile01").val();
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
      reader.onload = function(e) {
        debugger;
        $('#blah').attr('src', e.target.result);
        $('#btn-del').hide();
        $('#blah').hide();
        $('#blah').fadeIn(500);

        $('.custom-file-label').text(filename);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }






  $('.textarea').summernote({
    height: 150, //set editable area's height
    codemirror: { // codemirror options
      theme: 'spacelab'
    }
  });

  const slugify = (str) => {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to = "aaaaaeeeeiiiioooouuuunc------";

    for (var i = 0, l = from.length; i < l; i++) {
      str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
      .replace(/\s+/g, '-') // collapse whitespace and replace by -
      .replace(/-+/g, '-'); // collapse dashes

    return str;
  }

  $('#title').on('keyup', function() {
    var url = slugify($(this).val());
    $('#url').html(url);
    $('#slug').val(url);
  });





// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#categories').select2();
});



</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Admin.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\webserver\www\l8ecom\resources\views/admin/category/edit.blade.php ENDPATH**/ ?>