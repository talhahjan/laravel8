<?php $__env->startSection('title', 'T.J Shoes Collection :: Login '); ?>

<?php $__env->startSection('content'); ?>

<div class="page-content" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('assets/images/hd-07.jpg');
background-size: cover;
background-repeat: no-repeat;
background-position: center center;
">



    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-transparent">
        <div class="container">
            <div class="navbar-wrappr">
                <a class="navbar-brand" href="javascript:;">Login Page</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?php echo e(route('login')); ?>" class="nav-link active">
                            <i class="material-icons">fingerprint</i>
                           Sign In
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('register')); ?>" class="nav-link"><i class="material-icons" aria-hidden="true">person_add</i>
                            Register
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    
    
    
    <div class="card card-login">
        <div class="card-header card-header-primary">
            <h5 class="text-center">Register With Social Account</h5>
        </div>
            
        <div class="card-body">
                
                <div class="social-line text-center">
                    <a href="<?php echo e(route('login')); ?>/f+acebook" class="btn-social btn-outline-facebook btn-social-circle waves-effect waves-light m-1">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="<?php echo e(route('login')); ?>/google" class="btn-social btn-outline-google btn-social-circle waves-effect waves-light m-1"><i
                            class="fab fa-google-plus-g"></i></a>
                    <a href="<?php echo e(route('login')); ?>//instagram" class="btn-social btn-outline-instagram waves-effect btn-social-circle waves-light m-1"><i
                            class="fab fa-instagram"></i></a>
                
                
                </div>
                
                <p class="text-muted text-center my-2">Or Be Classical</p>
        
          <form method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo csrf_field(); ?>
    
    
    
            <div class="inputWithIcon my-2">
            <input type="email" name="email" <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> class="form-control" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('Enter E-mail Address')); ?>" aria-label="email" id="email"
                aria-describedby="basic-addon1" autocomplete="on" required />
            <i class="material-icons">email</i>
        </div>
        
        <div class="inputWithIcon inputWithAction my-2">
            <input type="password" name="password" <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> class="form-control" value="<?php echo e(old('password')); ?>" placeholder="<?php echo e(__('Enter Password')); ?>" aria-label="Password" id="password"
                aria-describedby="basic-addon1" autocomplete="off" required/>
            <i class="material-icons">fingerprint</i>
            <i class="fa fa-eye-slash action" id="eye"></i>
        </div>
    
        
     
    
    
      
<div class="d-flex flex-column-reverse flex-lg-row justify-content-lg-between my-2">
<div class="form-check">
                 <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                 <label class="form-check-label" for="flexCheckChecked">
                   Remember me 
                 </label>
             </div>

<div>
<a href="<?php echo e(route('password.request')); ?>" class="text-form"> <?php echo e(__('Forgot Your Password?')); ?></a>
</div>
</div>
         
         
        
        
        
        
          <div class="form-group my-2">
            <button class="btn btn-block btn-primary" type="submit">Register</button>
          </div> <!-- form-group// -->
        
    
            </form>
        
            <div class="py-1">
                <a href="<?php echo e(route('register')); ?>" class="text-dark"> All ready have an ID Login ?</a>
              </div>
            
        </div>
        
    </div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('jScript'); ?>


    <script>
      <?php if(session('status')): ?>
      $.notify({
        icon: "add_alert",
        title: "Notification",
        animate: {
          enter: "animated fadeInDown",
          exit: "animated fadeOutUp",
        },
        message: "<?php echo e(session('status')); ?>"
      }, {
        type: 'success',
        timer: 4000,
        placement: {
          from: 'top',
          align: 'center'
        }
      });
      <?php endif; ?>

/*  hide & fadeIn login card  */ 
$('.card').hide();
$('.card').fadeIn(3000);      
   


const visibilityBtn = document.querySelector("#eye");




visibilityBtn.addEventListener("click", function () {
  currentClass=visibilityBtn.classList.contains('fa-eye');
 
visibilityBtn.classList.toggle('fa-eye');
 visibilityBtn.classList.toggle('fa-eye-slash');
document.getElementById("password").setAttribute("type", currentClass ? "password": "text");
  
});





    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.User.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\webserver\www\l8ecom\resources\views/auth/login.blade.php ENDPATH**/ ?>