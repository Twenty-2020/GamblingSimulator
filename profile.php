<?php include 'customFunctions.php'; 
include 'validate_signin.php'; 
    if(isset($_POST['upload'])) {
        $upload_path = $_FILES['newPicture']['tmp_name'];
        if($upload_path) {
            // 2 - jpg, 3 - png
            if(!(exif_imagetype($upload_path) == 2 || exif_imagetype($upload_path) == 3)) {
                $error['upload'] = "<br>File must be a jpg/png<br>";
            } else {
                if(filesize($upload_path) > 4000000) {
                    $error['upload'] = "<br>File size must be less than 4MB<br>";
                } else {
                    $filename = time() . $_FILES['newPicture']['name'];
                    $upload = move_uploaded_file($upload_path, "image/avatar/" . $filename);
                    if(!$upload) {
                        $error['upload'] = "<br>file upload unsuccessful<br>";
                    } else {
                        $_SESSION['avatar'] = $filename;
                        $sql = "UPDATE user SET avatar = '$filename' WHERE email = '$_SESSION[email]'";
                        $query = $conn -> query($sql);
                        $conn -> close();
                         header("Location: profile.php");
    exit();
                    }
                }
            }
        }
    } 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gambling</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">
  </head>
  <body> <?php navbar(); ?>
    <!-- Container for user profile -->
    <div class="profileInfoContainer">
      <section class="vh-100 d-flex align-items-center" style="background-color: #f4f5f7;">
        <div class="container py-5">
          <h1 class="text-center">Profile</h1>
          <div class="row d-flex justify-content-center">
            <div class="col-lg-15 mb-4 mb-lg-0">
              <div class="card h-100 w-100" style="border-radius: .5rem;">
                <div class="row g-0">
                  <div class="col-md-4 gradient-custom text-center" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem; background-color: #f4f5f7;">
                    <a href="#" id="editPictureButton"><img src="image/avatar/<?php echo $_SESSION['avatar']; ?>" alt="Avatar" class="img-fluid my-5" style="min-width: 200px; max-width: 500px; clip-path: circle(); object-fit: cover;"></a>
                    <div id="editPictureFormContainer" style="display: none;">
                            <form method="post" enctype="multipart/form-data" id="editPictureForm">
                              <div class="form-group mb-2">
                                <input type="file" class="form-control" id="editPictureInput" name="newPicture">
                              </div>
                              <input type="submit" value="Upload" name="upload">
                            </form>
                          </div>
                    <h5 style="color: black;">Credits</h5>
                    <p><?php echo $_SESSION['credits']; ?></p>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body p-4" style="height: 500px;">
                      <h6>Profile Information</h6>
                      <hr class="mt-0 mb-4">
                      <div class="row pt-1">
                        <div class="col-6 mb-3">
                          <h6>Username <a href="#" id="editUsernameButton">Edit</a>
                          </h6>
                          <p class="text-muted"><?php echo $_SESSION['username']; ?></p>
                          <div id="editUsernameFormContainer" style="display: none;">
                            <form id="editUsernameForm">
                              <div class="form-group mb-2">
                                <input type="text" class="form-control" id="editUsernameInput" name="newUsername" placeholder="Enter new username">
                              </div>
                              <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                          </div>
                        </div>
                        <div class="col-6 mb-3">
                          <h6>Age <a href="#" id="editAgeButton">Edit</a>
                          </h6>
                          <p class="text-muted"><?php echo $_SESSION['age']; ?></p>
                          <div id="editAgeFormContainer" style="display: none;">
                            <form id="editAgeForm">
                              <div class="form-group mb-2">
                                <input type="text" class="form-control" id="editAgeInput" name="newAge" placeholder="Enter new age">
                              </div>
                              <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                          </div>
                        </div>
                      </div>
                      <h6>Account Credentials</h6>
                      <hr class="mt-0 mb-4">
                      <div class="row pt-1">
                        <div class="col-6 mb-3">
                          <h6>Email Address <a href="#" id="editEmailButton">Edit</a>
                          </h6>
                          <p class="text-muted"><?php echo $_SESSION['email']; ?></p>
                          <div id="editEmailFormContainer" style="display: none;">
                            <form id="editEmailForm">
                              <div class="form-group mb-2">
                                <input type="email" class="form-control" id="editEmailInput" name="newEmail" placeholder="Enter new email">
                              </div>
                              <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                          </div>
                        </div>
                        <div class="col-6 mb-3">
                          <h6>Password <a href="#" id="editPasswordButton">Edit</a>
                          </h6>
                          <p class="text-muted">tite</p>
                          <div id="editPasswordFormContainer" style="display: none;">
                            <form id="editPasswordForm">
                              <div class="form-group mb-2">
                                <input type="password" class="form-control" id="editPasswordInput" name="newPassword" placeholder="Enter new password">
                              </div>
                              <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
  </body>
</html>