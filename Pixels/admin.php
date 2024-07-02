<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            padding-top: 50px;
        }
        .container {
            max-width: 800px;
        }
        .admin-section {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #0f0f0f;
            border-color: #4b4a4a;
        }
        .btn-primary:hover {
            background-color: #333333;
            border-color: #333333;
        }
        .btn-primary.active {
            background-color: #333333;
            border-color: #ffffff;
        }
        .form-control, .form-select {
            background-color: #333333;
            color: #ffffff;
            border: 1px solid #444444;
        }
        .form-control::placeholder {
            color: #888888;
        }
        .card {
            background-color: #1f1f1f;
        }
        .list-group-item {
            background-color: #333333;
            color: #ffffff;
            border: 1px solid #444444;
        }
        .nav-buttons {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .nav-buttons .btn {
            flex: 1;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Admin Panel</h1>
        
        <!-- Navigation Buttons -->
        <div class="nav-buttons mb-4">
            <button class="btn btn-primary active" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHome" aria-expanded="true" aria-controls="collapseHome">
                Edit Home Page
            </button>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGallery" aria-expanded="false" aria-controls="collapseGallery">
                Edit Gallery
            </button>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSkills" aria-expanded="false" aria-controls="collapseSkills">
                Edit Skills/Experience
            </button>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
                Manage Image Categories
            </button>
        </div>

        <!-- Home Page Section -->
        <div class="admin-section">
            <div class="collapse show" id="collapseHome">
                <div class="card card-body mt-3">
                    <form method="post">
                        <div class="mb-3">
                            <label for="homeTitle" class="form-label">Home Title</label>
                            <input type="text" class="form-control" id="homeTitle" placeholder="Enter home page title" name="title" value="<?php include 'connect.php';
          $query = "SELECT title, description FROM home";          
          $result = mysqli_query($conn, $query);
          if (mysqli_num_rows($result) > 0) {            
            while ($row = mysqli_fetch_assoc($result)) {                
              echo $row['title'];
            }
          } 
              ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="homeDescription" class="form-label">Home Description</label>
                            <textarea class="form-control" id="homeDescription" rows="5" placeholder="Enter description" name="description" ><?php include 'connect.php';
          $query = "SELECT title, description FROM home";          
          $result = mysqli_query($conn, $query);
          if (mysqli_num_rows($result) > 0) {            
            while ($row = mysqli_fetch_assoc($result)) {                
              echo $row['description'];
            }
          } 
              ?></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" name="home" value="Update">
                    </form>
                </div>
            </div>
        </div>

        <!-- Gallery Section -->
        <div class="admin-section">
            <div class="collapse" id="collapseGallery">
                <div class="card card-body mt-3">
                    <form enctype="multipart/form-data" method="post">
                        
                        <div class="mb-3">
                            <label for="galleryCategory" class="form-label">Image Category</label>
                            <select class="form-control" id="galleryCategory" name="image_category">
                                
                                <?php
                                 include 'connect.php';
                                 $sql="SELECT * FROM category";
                                 $result=mysqli_query($conn,$sql);
                                 if(mysqli_num_rows($result)>0)
                                 {
                                     while($row=mysqli_fetch_assoc($result))
                                     {
                                            echo '<option value="'.$row['image_category'].'">'.$row['image_category'].'</option>';
                                     }
                                 }
                                ?>                                
                                
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="galleryImage" class="form-label">Upload Image</label>
                            <input type="file" class="form-control" id="galleryImage" name="image">
                        </div>
                        <input type="submit" class="btn btn-primary" name="image_upload" value="Upload">
                    </form>
                    <?php
                                include 'connect.php';
                                
                                $sql = "SELECT * FROM image_details";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    echo '<table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Category</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>
                                                <td><img src="uploads/' . $row['img_name'] . '" width="100"></td>
                                                <td>' . $row['img_category'] . '</td>
                                                <td>
                                                    <form method="post">
                                                        <input type="hidden" name="image_id" value="' . $row['img_id'] . '">
                                                        <button type="submit" class="btn btn-danger" name="delete_image">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>';
                                    }

                                    echo '</tbody>
                                        </table>';
                                } else {
                                    echo 'No images found.';
                                }

                            
                                if (isset($_POST['delete_image'])) {
                                    $imageId = $_POST['image_id'];

                                    
                                    $deleteSql = "DELETE FROM image_details WHERE img_id = '$imageId'";
                                    $deleteResult = mysqli_query($conn, $deleteSql);

                                    if ($deleteResult) {
                                        echo "<script>alert('Image deleted successfully');</script>";
                                    } else {
                                        echo "<script>alert('Failed to delete image');</script>";
                                    }
                                }
?>
                </div>
            </div>
        </div>

        <!-- Skills/Experience Section -->
        <div class="admin-section">
            <div class="collapse" id="collapseSkills">
                <div class="card card-body mt-3">
                    <form>
                        <div class="mb-3">
                            <label for="skillsTitle" class="form-label">Skills/Experience Title</label>
                            <input type="text" class="form-control" id="skillsTitle" placeholder="Enter title">
                        </div>
                        <div class="mb-3">
                            <label for="skillsDescription" class="form-label">Skills/Experience Description</label>
                            <textarea class="form-control" id="skillsDescription" rows="5" placeholder="Enter description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="skillsImage" class="form-label">Upload Image</label>
                            <input type="file" class="form-control" id="skillsImage">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- Image Categories Section -->
        <div class="admin-section">
            <div class="collapse" id="collapseCategories">
                <div class="card card-body mt-3">
                    <form id="categoryForm" method="post">
                        <div class="mb-3">
                            <label for="newCategory" class="form-label">Add New Category</label>
                            <input type="text" class="form-control" id="newCategory" placeholder="Enter new category" name="newcategory">
                        </div>
                        <input type="Submit" class="btn btn-primary" id="addCategory" name="category" value="Add Category" >
                    </form>
                    <hr>
                    <h4>Existing Categories</h4>
                    <ul class="list-group" id="categoryList">
                        <?php
                        include 'connect.php';
                        $sql="SELECT * FROM category";
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0)
                        {
                            while($row=mysqli_fetch_assoc($result))
                            {
                                echo '<li class="list-group-item">'.$row['image_category'].'</li>';
                            }
                        }

                        ?>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.nav-buttons .btn');
            const sections = document.querySelectorAll('.collapse');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    // Collapse all sections and remove active class from all buttons
                    sections.forEach(section => {
                        section.classList.remove('show');
                    });
                    buttons.forEach(btn => {
                        btn.classList.remove('active');
                    });

                    // Expand the selected section and add active class to the clicked button
                    const target = button.getAttribute('data-bs-target');
                    document.querySelector(target).classList.add('show');
                    button.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
<?php
include 'connect.php';
if(isset($_POST['category']))
{    
    $category=$_POST['newcategory'];
    $sql="INSERT INTO category (image_category) VALUES ('$category')";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
        echo "<script>alert('Category added successfully');</script>";
    }
    else
    {
        echo "<script>alert('Failed to add category');</script>";
    }
}
?>
<?php
include 'connect.php';
if (isset($_POST['image_upload'])) {
  if (isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $fileName = $image['name'];
    $size = $image['size'];
    $fileTemp = $image['tmp_name'];
    $type = $image['type'];
    echo "<br>";
    $size_converted = $size / 1048576;
    $date = date("Y-m-d-H-i-s");

    $extension = pathinfo($image["name"], PATHINFO_EXTENSION);
    $newfilename = $date . "." . $extension;
    $category = $_POST['image_category'];
    if ($type == "image/jpeg" || $type == "image/png" || $type == "image/jpg") {
      if ($size_converted < 5) {
        move_uploaded_file($fileTemp, 'uploads/' . $newfilename);
        $query = "INSERT INTO image_details(img_category,img_name) VALUES('$category','$newfilename')";
        $res = mysqli_query($conn, $query);
        echo "File uploaded successfully";
      } else {
        die("Error: File is too large");
      }
    } else {
      die("Error: File is not supported");
    }
  } else {
    echo "No files";
  }
}
?>

<?php
include 'connect.php';
if (isset($_POST['home'])) {
    $title = ($_POST['title']);
    $description = ($_POST['description']);
    $query2 = "UPDATE home SET title = '$title', description = '$description' WHERE home_id = 1;";
    $hom = mysqli_query($conn, $query2);
  }
?>

