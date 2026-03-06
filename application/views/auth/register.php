<!DOCTYPE html>
<html lang="en">

<head>
  <title>Asaan Biz</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Byte Builder Signup Page">
  <meta name="keywords" content="Signup, Register, Auth, Bootstrap 5">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] -->
  <link rel="icon" href="<?php echo base_url('assets/images/favicon.svg') ?>" type="image/x-icon">

  <!-- [Fonts & Icons] -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
  <link rel="stylesheet" href="<?php echo base_url('assets/fonts/tabler-icons.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/fonts/feather.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/fonts/fontawesome.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/fonts/material.css') ?>">

  <!-- [Template CSS] -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>" id="main-style-link">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style-preset.css') ?>">
</head>

<body>
  <!-- [ Pre-loader ] -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>

  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header">
          <a href="#"><img src="<?php echo base_url('assets/images/logo-dark.svg') ?>" alt="logo"></a>
        </div>
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Sign up</b></h3>
              <a href="<?php echo base_url('Auth') ?>" class="link-primary">Already have an account?</a>
            </div>
                <form action="<?= base_url('Auth/register'); ?>" method="post">
                
                  <!-- OWNER NAME -->
                  <div class="form-group mb-3">
                    <label class="form-label">
                      Owner Full Name <span style="color:red">*</span>
                    </label>
                    <input type="text"
                           class="form-control"
                           name="owner_name"
                           value="<?= set_value('owner_name'); ?>"
                           placeholder="Owner Full Name">
                
                    <?= form_error('owner_name','<small class="text-danger">','</small>'); ?>
                  </div>
                
                  <!-- COMPANY NAME -->
                  <div class="form-group mb-3">
                    <label class="form-label">
                      Business / Company Name <span style="color:red">*</span>
                    </label>
                    <input type="text"
                           class="form-control"
                           name="business_name"
                           value="<?= set_value('business_name'); ?>"
                           placeholder="Business or Clinic Name">
                
                    <?= form_error('business_name','<small class="text-danger">','</small>'); ?>
                  </div>
                
                  <!-- PHONE -->
                  <div class="form-group mb-3">
                    <label class="form-label">
                      Phone Number <span style="color:red">*</span>
                    </label>
                    <input type="text"
                           class="form-control"
                           name="phone"
                           value="<?= set_value('phone'); ?>"
                           placeholder="03XXXXXXXXX">
                
                    <?= form_error('phone','<small class="text-danger">','</small>'); ?>
                  </div>
                
                  <!-- EMAIL -->
                  <div class="form-group mb-3">
                    <label class="form-label">
                      Email Address <span style="color:red">*</span>
                    </label>
                    <input type="email"
                           class="form-control"
                           name="email"
                           value="<?= set_value('email'); ?>"
                           placeholder="Email Address">
                
                    <?= form_error('email','<small class="text-danger">','</small>'); ?>
                  </div>
                
                  <!-- PASSWORD -->
                  <div class="form-group mb-3">
                    <label class="form-label">
                      Password <span style="color:red">*</span>
                    </label>
                    <input type="password"
                           class="form-control"
                           name="password"
                           placeholder="Password">
                
                    <?= form_error('password','<small class="text-danger">','</small>'); ?>
                  </div>
                
                  <!-- TERMS -->
                  <p class="mt-4 text-sm text-muted">
                    By signing up, you agree to our
                    <a href="#" class="text-primary">Terms of Service</a>
                    and
                    <a href="#" class="text-primary">Privacy Policy</a>
                  </p>
                
                  <!-- SUBMIT BUTTON -->
                  <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary w-100">
                      Create Account
                    </button>
                  </div>
                
                </form>

            <div class="saprator mt-3">
              <span>Sign up with</span>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>