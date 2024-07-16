<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery</title>
    <style>
        .gallery-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .gallery-img {
            width: 200px;
            margin: 10px;
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
</head>
<body>
    <div class="container-fluid" id="photo_gallery"></div>
    <div class="container-fluid" id="photo_background">
        <center><h1 class="display-1">Our Gallery</h1></center>

        <div class="category-menu">
            <form method="POST" id="categoryForm">
                
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

    
</body>
</html>
