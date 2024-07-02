<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #363535 !important;
        }
        .main_img {                     
            width: 100% !important;            
            position: relative;
        }
        .text-area {
            position: absolute;
            top: 50%;
            width: 300px;
            transform: translateY(-50%);
            color: white;
            
        }
        .text-area.left {
            left: 8%;
            text-align: center;
        }
        .text-area.right {
            right: 8%;
            text-align: center;
        }
        .text-area .title {
            font-family: 'Bebas Neue', sans-serif;
            border-bottom: solid white 3px;
            font-size: 34px;
            margin-bottom: 20px;
            letter-spacing: 4px;
            padding: 10px;
        }
        .text-area .description {
            font-family: 'Roboto', sans-serif;
            font-size: 26px;
        }
        div#photo_background {           
            margin-top: 0px !important;
            height: 100% !important;
            background-color: #242424 !important;
            padding: 29px !important;
            border-bottom: solid 3px !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
        }
        div#contact, div#portfolio {           
            margin-top: 0px !important;
            height: 100% !important;
            background-color: #242424 !important;
            padding: px !important;
            border-bottom: solid 3px !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
        }
        .display-1 {
            color: white !important;
            padding: 50px !important;
        } 
        .nav {
            padding: 0 5px !important;
            line-height: 35px !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            font-size: 14px !important;
            letter-spacing: 3px !important;
        }
        .white_text {
            color: white !important;
        }
        h2 {
            margin-top: 42px !important;
        }
        .col-md-4 {
            padding: 6px !important;
            margin-bottom: 22px;
        }
        .card#portfolio {
            background-color: #1f1f1f !important;
            border: solid white 0.5px !important;
            color: white !important;   
        }
        .gallery-row {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            
        }
        .gallery-img {
            flex: 1 1 calc(25% - 5px);
            max-width: calc(25% - 5px);
            transition: transform 0.3s;
            padding: 20px;
        }
        .gallery-img:hover {
            transform: scale(1.05);
        }
        .category-menu {
            text-align: center;
            margin-bottom: 20px;
        }
        .category-menu button {
            margin: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
    <!-- Icons ko library -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-md bg-dark sticky-top border-bottom nav justify-content-center" data-bs-theme="dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="icons and images/nobg_cropped.png" alt="Logo" width="33" height="35" class="d-inline-block align-text-top">
                PIXELS
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#photo_gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio">Skills/Experience</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main_img">
        <img src="icons and images/pixel_mainpage.jpg" class="main_img">
        <div class="text-area left">
            <div class="title">Welcome to Pixels Photography</div>
            <div class="description">Capturing moments one click at a time.</div>
        </div>
        <div class="text-area right">
            <div class="title"><?php include 'connect.php';
          $query = "SELECT title, description FROM home";          
          $result = mysqli_query($conn, $query);
          if (mysqli_num_rows($result) > 0) {            
            while ($row = mysqli_fetch_assoc($result)) {                
              echo $row['title'];
            }
          } 
              ?></div>
            <div class="description"><?php include 'connect.php';
          $query = "SELECT title, description FROM home";          
          $result = mysqli_query($conn, $query);
          if (mysqli_num_rows($result) > 0) {            
            while ($row = mysqli_fetch_assoc($result)) {                
              echo $row['description'];
            }
          } 
              ?></div>
        </div>
    </div>
    <div class="container-fluid" id="photo_gallery"></div>
    <div class="container-fluid" id="photo_background">
        <center><h1 class="display-1">Our Gallery</h1></center>

        <div class="category-menu">
            <form method="POST" id="categoryForm" action="#photo_background">
                
                <button type="submit" name="all">Show All</button>
                <?php
                include 'connect.php';
                
                
                $categoryQuery = "SELECT DISTINCT img_category FROM image_details";
                $categoryResult = mysqli_query($conn, $categoryQuery);

                if (mysqli_num_rows($categoryResult) > 0) {
                    while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                        $category = $categoryRow['img_category'];
                        
                        echo '<button type="submit" name="category" value="' . $category . '">' . ucwords(str_replace('_', ' ', $category)) . '</button>';
                    }
                }
                ?>
            </form>
        </div>

        <div class="gallery-row" id="gallery">
            <?php
           
            if (isset($_POST['all'])) {
                $query = "SELECT img_name FROM image_details";
            }
           
            elseif (isset($_POST['category'])) {
                $selectedCategory = $_POST['category'];
                $query = "SELECT img_name FROM image_details WHERE img_category = '$selectedCategory'";
            }
            
            else {
                $query = "SELECT img_name FROM image_details";
            }

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<img src="uploads/' . $row['img_name'] . '" class="gallery-img">';
                    
                }
            } else {
                echo '<p>No images found in the database.</p>';
            }
            ?>
        </div>
    </div>
    <div class="container-fluid" id="portfolio">
        <h1 class="text-center display-1 white_text">Our Skills and Experience</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card" id="portfolio">
                    <img src="icons and images/video.jpg" class="card-img-top" alt="Videography Experience">
                    <div class="card-body">
                        <h5 class="card-title">3 Years of Videography Experience</h5>
                        <p class="card-text">We have extensive experience in creating stunning videos for various events and purposes.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="portfolio">
                    <img src="icons and images/photo.jpg" class="card-img-top" alt="Photography Experience">
                    <div class="card-body">
                        <h5 class="card-title">5+ Years of Photography Experience</h5>
                        <p class="card-text">Our team has over 5 years of experience capturing moments through the lens.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="portfolio">
                    <img src="icons and images/camera.jpg" class="card-img-top" alt="National Photography Contest">
                    <div class="card-body">
                        <h5 class="card-title">#1 in National Photography Contest 2023</h5>
                        <p class="card-text">We are proud to be the top winner of the National Photography Contest 2023.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="portfolio">
                    <img src="icons and images/content.jpg" class="card-img-top" alt="Content Creator of the Year">
                    <div class="card-body">
                        <h5 class="card-title">#2 Content Creator of the Year 2023</h5>
                        <p class="card-text">Recognized as the second-best content creator of the year for our innovative work.</p>
                    </div>
                </div>
            </div>
      
      <div class="col-md-4 ">
        <div class="card" id="portfolio">
          <img src="icons and images/wedding.jpg" class="card-img-top" alt="Project Title">
          <div class="card-body">
            <h5 class="card-title">Wedding Photography Project</h5>
            <p class="card-text">Captured stunning moments from various weddings, creating lasting memories for couples.</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-4 ">
        <div class="card" id="portfolio">
          <img src="icons and images/event.jpg" class="card-img-top" alt="Project Title">
          <div class="card-body">
            <h5 class="card-title">Event Videography Project</h5>
            <p class="card-text">Produced high-quality videos for major events, ensuring every moment is perfectly captured.</p>
          </div>
        </div>
      </div>
    </div>
  
</div>

<div class="container-fluid" id="contact">
<div class="row">
    <div class="col-md-6 offset-md-3">
       <center> <h2 class="white_text display-1">Contact Us</h2></center>
        
        <form>
            <div class="form-group">
                <label class = "white_text" for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label class = "white_text" for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label class = "white_text" for="message">Message</label>
                <textarea class="form-control" id="message" rows="5" placeholder="Enter your message"></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
            
        </form>
    </div>
</div>
<br>
<br>
</div>

<footer class="bg-dark text-white text-center py-4">
  <div class="container">
    <div class="row">
      <div class="col">
        <p>&copy; 2022 PIXELS Photography. All rights reserved.</p>
      </div>
      <div class="col">
        <ul class="list-inline">
          <li class="list-inline-item">
            <a href="#" class="text-white">
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#" class="text-white">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#" class="text-white">
              <i class="fab fa-instagram"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>