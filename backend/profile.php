<?php require_once 'header.php';?>

<div class="row">
    <div class="col-lg-3 m-auto text-center">
        <div class="profile_image">
        <div class="card">
                <div class="card-header">
                    <h3>Profile Photo</h3>
                </div>
                <div class="card-body">
                    <form action="profile_post.php" method="POST" enctype="multipart/form-data">
                        <img src="uploads/profile_photo/<?=$profile_photo;?>" alt="empt" style="height:200px; width: 200px; border-radius: 50%;">
                    <input type="file" class="form-control m-b-md" name="profile_photo" style="height:10px; width:10px; background: #000; color: #fff; border-radius: 50%; border: none; margin-top: -20px;" placeholder="!!!">
                    <button type="submit" class="btn btn-success" name="profile_change_btn" value="Upload Image">Photo Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 m-auto text-center">
        <div class="profile_name">
            <div class="card">
                <div class="card-header">
                    <h3>Name</h3>
                </div>
                <div class="card-body">
                    <form action="profile_post.php" method="POST">
                    <input type="text" class="form-control m-b-md" name="profile_name" value="<?=$_SESSION['s_name']?>">
                    <button type="submit" class="btn btn-success" name="name_change_btn">Name Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 m-auto text-center">
        <div class="profile_name">
            <div class="card">
                <div class="card-header">
                    <h3>Email</h3>
                </div>
                <div class="card-body">
                    <form action="profile_post.php" method="POST">
                    <input type="text" class="form-control m-b-md" name="profile_email" value="<?=$_SESSION['s_email']?>">
                    <button type="submit" class="btn btn-success" name="email_change_btn">Email Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 m-auto text-center">
        <div class="profile_name">
            <div class="card">
                <div class="card-header">
                    <h3>Password</h3>
                </div>
                <div class="card-body">
                    <form action="profile_post.php" method="POST">
                    <input type="password" class="form-control m-b-md" name="old_password" placeholder="Old Password">

                    <?php if (isset($_SESSION['pass_change_error'])): ?>
                    <div class="text-danger"> <?= $_SESSION['pass_change_error']; ?></div>
                    <?php endif; ?>

                    <input type="password" class="form-control m-b-md" name="new_password" placeholder="New Password">
                    
                    <?php if (isset($_SESSION['pass_change_match_error'])): ?>
                    <div class="text-danger"> <?= $_SESSION['pass_change_match_error']; ?></div>
                    <?php endif; ?>

                    <input type="password" class="form-control m-b-md" name="confirmm_password" placeholder="Confirm Password">
                    <button type="submit" class="btn btn-success" name="password_change_btn">Password Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php session_unset();?>
<?php require_once 'footer.php';?>