<!DOCTYPE php>
<php lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="fa-solid fa-house-chimney-medical mt-3"></i>
                    <div class="sidebar-logo">
                        <a href="">Ideal Homeo Clinic</a>
                    </div>
               </button>
                
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item mb-1 ">
                    <a href="admin_profile.php" class="sidebar-link">
                        <!-- <i class="lni lni-user"></i> -->
                        <i class="fa-solid fa-user"></i>
                        <span class="ms-2">Profile</span>
                    </a>
                    
                </li>
                
                <li class="sidebar-item mb-1">
                    <a href="add_user.php" class="sidebar-link">
                        <!-- <i class="lni lni-agenda"></i> -->
                        <i class="fa-solid fa-user-plus"></i>
                        <span >Add User</span>
                    </a>
                </li>
                <li class="sidebar-item mb-1">
                    <a href="#" class="sidebar-link ">
                        <!-- <i class="lni lni-protection"></i> -->
                        <!-- <i class="fa-solid fa-people-roof"></i> -->
                        <!-- <i class="lni lni-agenda"></i> -->
                        <svg class="w-6 h-6 text-gray-800 dark:text-white " style="margin-left: -3px;"  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                          </svg>
                          
                        <span style="margin-left: 12px;">Role Management</span>
                    </a>
                    <!-- <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item mb-1">
                            <a href="#" class="sidebar-link">Login</a>
                        </li>
                        <li class="sidebar-item mb-1">
                            <a href="#" class="sidebar-link">Register</a>
                        </li>
                    </ul> -->
                </li>
               
                <li class="sidebar-item mb-1">
                    <a href="lab_test.php" class="sidebar-link">
                        <!-- <i class="lni lni-popup"></i> -->
                        <!-- <i class="fa-solid fa-flask-vial"></i> -->
                        <i class="fa-solid fa-microscope"></i>
                        <span class="ms-1">Lab Tests</span>
                    </a>
                </li>
                <li class="sidebar-item mb-1">
                    <a href="admin.php " class="sidebar-link">
                        <!-- <i class="lni lni-cog"></i> -->
                        <!-- <i class="fa-solid fa-gear"></i> -->
                        <i class="fa-solid fa-house"></i>
                        <span class="ms-1">Home</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <!-- <i class="lni lni-exit"></i> -->
                    <i class="fa-solid fa-right-from-bracket fa-flip-horizontal"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">
            <div class="text-center" >
                <h1 class="mt-3" >
                    Admin Page
                </h1>
            </div>
            <?php
            // Database connection
            include "config.php";
            // Fetch data from the "admin" table
            $sql = "SELECT id, name, role, mobile FROM admin";
            $result = $conn->query($sql);
            
            ?>
            
            <div class="bg-white mx-3 rounded-3 text-align-center p-3 fs-6 mt-3">
                <div class="table-responsive">
                    <table id="table" class="table table-striped p-3">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['name']}</td>
                                            <td>{$row['role']}</td>
                                            <td>{$row['mobile']}</td>
                                            <td>
                                                <div class=\"btn-container\">
                                                    <button id=\"tooltip\" class=\"btn rounded-4 mb-1 mt-1 edit-button action-button\" style=\"background-color: #d1d3ab;\">
                                                        <span id=\"tooltiptext\">Edit</span>
                                                        <i class=\"fa-solid fa-pen-to-square ms-2\"></i>
                                                    </button>
                                                    <a id=\"tooltip\" class=\"btn rounded-4 mb-1 mt-1 add-button action-button\" href=\"delete.php?id={$row['id']}\" style=\"background-color: #0b6e4f; color: white;\">
                                                        <span id=\"tooltiptext\">Delete</span>
                                                        <i class=\"fa-solid fa-trash ms-2\"></i>
                                                    </a>
                                                </div>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No records found</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    
      
      

      

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script>

        const button = document.querySelector(".toggle-btn");

button.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

function test() {
  event.preventDefault();

  var container = document.createElement('div');
  container.setAttribute('class', 'input-group mb-3');

  var input1 = document.createElement('input');
  input1.setAttribute('type', 'text');
  input1.setAttribute('name', 'labtest');
  input1.setAttribute('class', 'form-control p-3 border-0 rounded-3 me-auto ');
  input1.setAttribute('placeholder', 'Enter New Lab Test');

  var removeButton = document.createElement('button');
  removeButton.setAttribute('class', 'btn btn-danger');
  removeButton.setAttribute('type', 'button');
  removeButton.innerphp = 'Remove';
  removeButton.onclick = function() {
      container.remove();
  };

  container.appendChild(input1);
  container.appendChild(removeButton);

  document.querySelector('#labtest .modal-body .mb-3').appendChild(container);
}

   
    </script>
</body>

</php>