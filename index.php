



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeopathic Consultancy Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="table-styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .btn-checker:hover {
            background-color: bisque !important;
            color: #073426 !important;
            transition: all 0.5s ease;
        }

        .btn-checker:checked {
            background-color: bisque !important;
        }

        .btn-checker {
            margin: 5px;
        }
    </style>
</head>

<body style="background-color: #0b6e4f">
<nav class="navbar shadow navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto " id="spmsbranding" href="index.html">IDEAL</a>
            <div class="d-flex align-items-center justify-content-center w-50 position-relative searchbar ">
                <input id="searchbar-input" type="text" class="searchbar w-100" placeholder="Search" aria-label="Search" value="<?php 
                
                if(isset($_GET['search'])) {
                    $search_result = $_GET['search'];
            
                    // Process the search result here
                    // echo "Search Result: " . $search_result . "<br>";
                }
                else{
                    $search_result = "";
            
            
                }
                
                
                echo $search_result;?>">

                <button class="btn rounded-5 " id="searchbutton" >
                    <i style="color: white;" class="fa-solid fa-magnifying-glass"></i>
                </button>


            </div>


            
            <a href="details.html" id="tooltip" class="btn  rounded-5 ms-auto position-relative fs-4">
                <span id="tooltiptext">Enter Patient Details</span>
                <img class="nav-buttons" src="Images And Icons/add_patient.png"
                    style="height: 25px; opacity: 85%; transform: translateY(-7%);" alt="">
            </a>

            <!-- Example single danger button -->
            <div class="btn-group border-0 rounded-5">
                <button type="button" id="tooltip" class="btn rounded-5 " data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span id="tooltiptext">Account</span>
                    <img class="nav-buttons" src="Images And Icons/user-doctor-solid.svg"
                        style="height: 25px; opacity: 85%; transform: translateY(-9%);" alt="">
                </button>
                <ul class="dropdown-menu border-0 p-2" style="transform: translateX(-75%);">
                    <!-- <li><a class="dropdown-item p-2 rounded-3 w-100" style="text-align: right; " href="profile.html"><i  class="fa-solid fa-user-doctor"></i>..................... Profile</a></li>
      <li><a class="dropdown-item p-2 rounded-3" style="text-align: right;" href="#"> <i style="font-size: 13px;" class="fa-solid fa-gear"></i> ..................Settings </i></a></li> -->

                    <li><a class="dropdown-item p-2 rounded-3 btn mb-1  profile-setting-button  justify-content-center d-flex "
                            href="profile.html">
                            <div class="me-auto w-100 " style="display: inline;"><i class="fa-solid fa-user-doctor"></i>
                            </div><span class="w-100" style="text-align: right;">Profile</span>
                        </a></li>
                    <li><a class="dropdown-item p-2 rounded-3 btn mt-2 profile-setting-button justify-content-center d-flex "
                            href="settings.html">
                            <div class="me-auto w-100 " style="display: inline;"> <i style="font-size: 13px;"
                                    class="fa-solid fa-gear"></i> </div><span class="w-100"
                                style="text-align: right;">Settings</span>
                        </a></li>

                    <!-- <li><a class="dropdown-item" style="text-align: right;" href="#">Something else here</a></li> -->
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a href="login.html"
                            class="dropdown-item p-3 rounded-3 btn btn-danger logout-button justify-content-center d-flex "
                            style="background-color: rgba(255, 0, 0, 0.115);" href="#">
                            <div class="me-auto w-100 " style="display: inline;"><i style="font-size: 13px; color: red;"
                                    class="fa-solid fa-right-from-bracket"></i> </div><span class="w-100"
                                style="text-align: right; color: red;">Logout</span>
                        </a></li>
                </ul>
            </div>



        </div>
    </nav>
    <br><br><br><br><br>


    <?php
    // Check if the 'search' parameter is set in the URL
    if(isset($_GET['search'])) {
        $search_result = $_GET['search'];

        // Process the search result here
        // echo "Search Result: " . $search_result . "<br>";
    }
    else{
        $search_result = "";


    }

    // Check if any checkbox options are selected
    if(isset($_GET['btncheck1'])) {

        $btn_1 = "checked";

    }

    if(isset($_GET['btncheck2'])) {

        $btn_2 = "checked";
    }

    if(isset($_GET['btncheck3'])) {

        $btn_3 = "checked";
    }

    if(isset($_GET['btncheck4'])) {

        $btn_4 = "checked";
    }
?>






    <div class="container justify-content-center d-flex  ">
        <div class=" mx-3 rounded-5" style="background-color: #d1d3ab; width: 60%;">

            <div class="input-group m-0 rounded-5 ">

    
                <div class="btn-group p-1 bg-white row rounded-3 ms-0 " role="group"
                    aria-label="Basic checkbox toggle button group" style="width: 100%;">
                    <div class="col-md-3 d-flex align-items-center">
                        <input type="checkbox" class="btn-check " id="btncheck1" 
                        
                        <?php 
    if(isset($_GET['btncheck1'])) {

        $btn_1 = "checked";
        echo "checked";
    } ?> 
     autocomplete="off">
                        <label class="btn rounded-3 btn-checker w-100" for="btncheck1">Case No.</label>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <input type="checkbox" class="btn-check " id="btncheck2"  
                        <?php 
    if(isset($_GET['btncheck2'])) {

        $btn_2 = "checked";
        echo "checked";
    } ?>   autocomplete="off">
                        <label class="btn rounded-3 btn-checker w-100" for="btncheck2">File No.</label>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <input type="checkbox" class="btn-check " id="btncheck3"                          <?php 
    if(isset($_GET['btncheck3'])) {

        $btn_3 = "checked";
        echo "checked";
    } ?>  autocomplete="off">
                        <label class="btn rounded-3 btn-checker w-100" for="btncheck3">Mobile No.</label>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <input type="checkbox" class="btn-check " id="btncheck4"                         <?php 
    if(isset($_GET['btncheck4'])) {

        $btn_4 = "checked";
        echo "checked";
    } ?> autocomplete="off">
                        <label class="btn rounded-3 btn-checker w-100" for="btncheck4">Name</label>
                    </div>
    
                </div>
    
    
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("searchbutton").addEventListener("click", function () {
            var searchresult = document.getElementById("searchbar-input").value;
            var selectedOptions = [];
            var checkboxes = document.querySelectorAll('.btn-check');
        
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    selectedOptions.push(checkbox.id);
                }
            });

            var queryString = "";
            if (searchresult.trim() !== "") {
                queryString += "search=" + encodeURIComponent(searchresult);
            }
            
            if (selectedOptions.length > 0) {
                var optionsString = selectedOptions.join('&');
                if (queryString !== "") {
                    queryString += "&";
                }
                queryString += optionsString;
            }

            location.href = "index.php?" + queryString;
        });
    });
</script>





    
</script>


    <div class="mt-3 bg-white mx-3 rounded-3 text-align-center p-3 fs-6">
        <div class="table-responsive">
            <table id="table" class="table table-striped p-3">
                <thead>
                    <tr>
                        <th scope="col">Case No.</th>
                        <!-- <th scope="col">File No.</th> -->
                        <th scope="col">Name</th>
                        <th scope="col">Mobile No.</th>
                        <th scope="col">Last Visited</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'config.php';
                    $sql = "SELECT * FROM test_details WHERE name = $search_result";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row["caseno"]; ?></td>
                                <!-- <td><?php echo $row["file"]; ?></td>s -->
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["mobile"]; ?></td>
                                <td><?php echo $row["date"]; ?></td>
                                <td>
                                    <div class="btn-container">
                                        <!-- Add your action buttons here -->

                                        <a id="tooltip" class="btn rounded-4 mb-1 mt-1 w-100 edit-button action-button" href="edit.php?caseno=<?php echo $row["caseno"]; ?>" style="background-color: #d1d3ab;">
                                        <span id="tooltiptext">Edit Patient Details</span>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
    



                                        <a id="tooltip" class="btn rounded-4 mb-1 mt-1 w-100 add-button action-button"
                                            href="checkup-page.php?caseno=<?php echo $row["caseno"]; ?>" style="background-color: #0b6e4f; color: white;"> <span
                                                id="tooltiptext">Patient Checkup</span><i
                                                class="fa-solid fa-notes-medical"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6">No data found</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
