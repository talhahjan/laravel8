<?php $__env->startSection('title', 'Admin dashboard :: Add Product'); ?>

<?php $__env->startSection('breadcrumbs'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('admin.product.index')); ?>">Products</a></li>
<li class="breadcrumb-item active" aria-current="page">Add Product</li>
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

        <!-- accordian star  -->
        <div id="accordion">
            <!-- form start -->
            <form action="<?php echo e(route('admin.product.store')); ?>" method="post" name="form-example-1" id="form-example-1" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('POST'); ?>
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
                    <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title">
                                <p class="small"><?php echo e(config('app.url')); ?>products/<span id="url"></span></p>
                                <input type="hidden" name="slug" id="slug">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>

                                <textarea name="description" id="description" class="textarea" placeholder="Describe category" style="width: 100%; height: 300px;overflow-y:scroll; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                            <?php echo e(old('description')); ?>


                                </textarea>
                            </div>

                            <div class="row">

                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="brand">Brand</label>
                                      
<select name="brand_id" id="brand_id" class="form-control select2">
<?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($brand->id); ?>"><?php echo e($brand->title); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="status">Visibility</label>
                                    <select type="text" name="status" class="custom-select" id="status">
                                        <option value="1"<?php echo e(old('status')==1 ? ' selected': ''); ?>>Visible</option>
                                        <option value="0"<?php echo e(old('status')==0 ? ' selected': ''); ?>>Invisible</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- common card ends  -->

                <!-- card thumbnails starts -->
                <div class="card">
                    <div class="card-header" id="Thumbnails">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-outline collapsed" data-toggle="collapse" data-target="#collapseThumbnails" aria-expanded="false" aria-controls="collapseThumbnails">
                                <strong> Thumbnails</strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThumbnails" class="collapse" aria-labelledby="Thumbnails" data-parent="#accordion">
                        <div class="card-body">
                            <div class="upload__box">
                                <div class="upload__img-wrap"></div>
                                <div class="upload__btn-box">
                                    <label class="upload__btn btn btn-outline-primary btn-block btn-sm"><i class="fas fa-upload"></i> Upload Multiple Images
                                        <input type="file" multiple="" data-max_length="20" name="thumbnails[]" class="upload__inputfile">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Thumbnails card ends -->

                <!-- card Pricing  starts -->
                <div class="card">
                    <div class="card-header" id="Pricing">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-outline collapsed" data-toggle="collapse" data-target="#collapsePricing" aria-expanded="false" aria-controls="collapsePricing">
                                <strong> Pricing </strong>
                            </button>

                        </h5>
                    </div>
                    <div id="collapsePricing" class="collapse" aria-labelledby="Pricing" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md">
                                    <div class="form-input">
                                        <label for="Price">Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" name="price" value="<?php echo e(old('price')); ?>" placeholder="00.00" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-input">
                                        <label for="Price">Discount</label>
                                        <div class="input-group">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" name="discount_price" value="<?php echo e(old('discount_price')); ?>" placeholder="00.00"  class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                    

                                        </div>

                                        <div class="form-check my-2">
                 <input class="form-check-input" name="discount" type="checkbox" value="1" id="flexCheckChecked"<?php echo e(old('discount')==1 ? ' checked': ''); ?>>
                 <label class="form-check-label" for="flexCheckChecked">
Enable Discount             </label>
             </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pricing  card ends -->


                <!-- card Categorization starts -->
                <div class="card">
                    <div class="card-header" id="Categorization">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-outline collapsed" data-toggle="collapse" data-target="#collapseCategorization" aria-expanded="false" aria-controls="collapseCategorization">
                                <strong> Categorization</strong>
                            </button>

                        </h5>
                    </div>
                    <div id="collapseCategorization" class="collapse" aria-labelledby="Categorization" data-parent="#accordion">
                        <div class="card-body">
                          
<select  id="categories" data-placeholder="Select a categories single or multiple" class="select2 form-control" name="categories[]" multiple="multiple" style="width: 100%;">
<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<optgroup label="<?php echo e($section->title); ?>">
<?php $__currentLoopData = $section->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($child->id); ?>"><?php echo e($section->title." / ".$child->title); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>


                        </div>
                    </div>
                </div>
                <!-- Categorization card ends -->

                <!-- card Featured  starts -->
                <div class="card">
                    <div class="card-header" id="Featured">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-outline collapsed" data-toggle="collapse" data-target="#collapseFeatured" aria-expanded="false" aria-controls="collapseFeatured">
                                <strong> Featured</strong>
                            </button>

                        </h5>
                    </div>
                    <div id="collapseFeatured" class="collapse" aria-labelledby="Featured" data-parent="#accordion">
                        <div class="card-body">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" name="featured" value="1" type="checkbox" id="featured" <?php echo e(old('featured')==1 ? ' checked': ''); ?>>
                                <label for="featured" class="custom-control-label">make this Product featured Product</label>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- featured  card ends -->




                <!-- card stock info starts -->
                <div class="card">
                    <div class="card-header" id="Stock">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-outline collapsed" data-toggle="collapse" data-target="#collapseStock" aria-expanded="false" aria-controls="collapseStock">
                                <strong> Stock By sizes</strong>
                            </button>

                        </h5>
                    </div>
                    <div id="collapseStock" class="collapse" aria-labelledby="Stock" data-parent="#accordion">
                        <div class="card-body">


<div class="row">
<div class="col-md">


<!-- size range   -->
<div class="form-group">
    <label for="size_range">Size range</label>
<select name="size_range" id="size_range" class="custom-select">
<option value="0">Select Size Range</option>
<?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<optgroup label="<?php echo e($key); ?>">
<?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1=> $val1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($val1); ?>"<?php echo e(old('size_range')==$val1 ? ' selected': ''); ?>><?php echo e($key1); ?> <?php echo e($val1); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</optgroup>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</select>

  </div>

<!-- size range   -->




</div>

<div class="col-md">
<!-- stock availibilty by size  -->
<div class="form-group">
    <label for="stock">Stock Availibility By Size</label>
    <input type="text" class="form-control" id="stock"  name="stock" value="<?php echo e(old('stock')); ?>" placeholder="1-2, 2-3, 3-5">
    <small class="form-text text-muted">Please tell us how many pairs of which size you have in this product i.e 1-2, 2-3 means you have 2 pairs of size 1 and 3 pairs of size 2</small>
  </div>
<!-- stock availibilty by size  -->


</div>

<div class="col-md">

<!-- color value  -->

<div class="form-group">
    <label for="product_color">Color of Product</label>
    <select name="product_color" id="product_color" class="custom-select select2">
    <option value="">Select Color</option>
 <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2=> $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($key2); ?>"<?php echo e(old('product_color')==$key2 ? ' selected': ''); ?>><?php echo e($key2); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </select>

  </div>


<!-- color value  -->
</div>

</div>






                        </div>
                    </div>
                </div>
                <!-- stock info  card ends -->




                <!-- card Extras starts -->
                <div class="card">
                    <div class="card-header d-flex" id="Extras">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-outline collapsed" data-toggle="collapse" data-target="#collapseExtras" aria-expanded="false" aria-controls="collapseExtras">
                                <strong> Extras</strong>
                            </button>

                        </h5>
                        <span class="ml-auto" id="collapseExtras">
                            <button type="button" id="btn-add" class="btn  btn-outline-primary btn-sm" style="display:inline">+</button>
                            <button type="button" id="btn-remove" class="btn btn-outline-danger btn-sm" style="display:inline">-</button>
                        </span>
                    </div>
                    <div id="collapseExtras" class="collapse" aria-labelledby="Extras" data-parent="#accordion">
                        <div class="card-body" id="extras">
                            <?php echo $__env->make('admin.ajax.extras', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </div>
                    </div>
                </div>
                <!-- Extras card ends -->




                <div>
                    <button type="submit" type="submit" class="btn btn-block btn-outline-primary"><i class="fas fa-plus-circle"></i> Add Product</button>
                </div>
            </form>

        </div>
        <!-- accordion end  -->

    </div>
    <!-- /.card -->
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('Css'); ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('assets/admin_plugins/select2/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/admin_plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
<!-- summernote -->
<link rel="stylesheet" href="<?php echo e(asset('assets/admin_plugins/summernote/summernote-bs4.css')); ?>">
<style>
    .upload__box {
        padding: 5px;
    }

    .upload__inputfile {
        width: .1px;
        height: .1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .upload__btn-box {
        margin-bottom: 10px;
    }

    .upload__img-wrap {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }

    .upload__img-box {
        width: 200px;
        padding: 0 10px;
        margin-bottom: 12px;
    }

    .upload__img-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
    }

    .upload__img-close:after {
        content: '\2716';
        font-size: 14px;
        color: white;
    }

    .img-bg {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        padding-bottom: 100%;
    }

    .hidden {
        display: none;
    }
</style>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('JsScript'); ?>
<!-- Select2 -->
<script src="<?php echo e(asset('assets/admin_plugins/select2/js/select2.full.min.js')); ?>"></script>
<!-- summernote bs4 -->
<script src="<?php echo e(asset('assets/admin_plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('#categories').select2()
        theme: 'bootstrap4'
    });
    jQuery(document).ready(function() {
        ImgUpload();
    });

    const ImgUpload = () => {
        var imgWrap = "";
        var imgArray = [];
        $('.upload__inputfile').each(function() {
            $(this).on('change', function(e) {
                imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                var maxLength = $(this).attr('data-max_length');
                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                var iterator = 0;
                filesArr.forEach(function(f, index) {
                    if (!f.type.match('image.*')) {
                        return;
                    }
                    if (imgArray.length > maxLength) {
                        return false
                    } else {
                        var len = 0;
                        for (var i = 0; i < imgArray.length; i++) {
                            if (imgArray[i] !== undefined) {
                                len++;
                            }
                        }
                        if (len > maxLength) {
                            return false;
                        } else {
                            imgArray.push(f);
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                imgWrap.append(html);
                                iterator++;
                            }
                            reader.readAsDataURL(f);
                        }
                    }
                });
            });
        });

        $('body').on('click', ".upload__img-close", function(e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
                if (imgArray[i].name === file) {
                    imgArray.splice(i, 1);
                    break;
                }
            }
            $(this).parent().parent().remove();
        });
    }

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
        var url =  slugify($(this).val());
        $('#url').html(url);
        $('#slug').val(url);
    });

    $('.textarea').summernote({
        height: 150, //set editable area's height
        codemirror: { // codemirror options
            theme: 'spacelab'
        }
    });
    $('#btn-add').on('click', function(e) {
        $.get("<?php echo e(route('admin.product.extras')); ?>").done(function(data) {
            $('#extras').append(data);
        })
    })
    $('#btn-remove').on('click', function(e) {
        $('#opt:last').remove();
    });

    const makeOption = (selector) => {
        var extra = $(selector).val();
        if (extra == 'custom') {
            let choice = prompt('Please Entile Extra Option');
            if (choice) {
                var extra = choice;
                $(selector).append('<option value="' + choice + '" selected>' + choice + ' </option>');

                console.log(choice);
            }

        }
        $(selector).next().find('input').attr('placeholder', 'seperate each ' + extra + ' with semicolm');
        $(selector).next().find('input').attr('name', 'extras[' + extra + ']');

    }



// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#brand_id').select2();
    $('#product_color').select2();
});


const createStock = () => {
let sizeRange=$('#size_range option:selected').val();
let split=sizeRange.split("-");
let text='';

for (i = split[0]; i < parseInt(split[1])+1; i++) {
  text +=`${i}-2`;
  if(i < parseInt(split[1]))
  text+=',';

}


$('#stock').attr("value", text);


}

$('#size_range').on("change",function() {

    createStock();

});



</script>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Admin.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\webserver\www\l8ecom\resources\views/admin/product/create.blade.php ENDPATH**/ ?>