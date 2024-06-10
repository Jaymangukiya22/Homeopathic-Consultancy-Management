<?php
if(isset($_GET['caseno'])) {
    $caseno = $_GET['caseno'];

    // Establish a database connection (Replace 'hostname', 'username', 'password', and 'database_name' with your actual database credentials)
    $conn = new mysqli('localhost', 'root', '', 'pdo');

    // Check if the connection is successful
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a SQL query to fetch the name associated with the provided case number
    $sql = "SELECT * FROM test_details WHERE caseno = ?";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if($stmt) {
        // Bind the case number parameter to the prepared statement
        $stmt->bind_param("s", $caseno);

        // Execute the prepared statement
        $stmt->execute();

        // Get the result of the query
        $result = $stmt->get_result();

        // Check if any row is returned
        if($result->num_rows > 0) {
            // Fetch the name from the result set
            $row = $result->fetch_assoc();

            $name = $row['dob'];
            // echo "Name for case number $caseno: $name";
        } else {
            echo "No patient found with case number $caseno";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Case number not provided";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Form Example</title>
    <link rel="stylesheet" href="details.css">
</head>

<body style="background-color: #0b6e4f">

    <div class="container justify-content-center align-items-center mt-5 p-lg-5 p-3 rounded-3 "
        style="background-color: #d1d3ab;">

        <form action="" id="detailsForm">
            <div class="tab">
                <div class="input-group ">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Name</span>
                    <input type="text" class="form-control border-0" aria-label="Sizing example input" value = "<?php echo $row['name'];?>"
                        aria-describedby="inputGroup-sizing-default" placeholder="Enter Patient Name">
                </div>
                <div class="input-group  mt-3">
                    
                    <span class="input-group-text fixed-width p-3 border-0" >Gender</span>

                    <?php
$selectedOption = trim($row['gender'] ?? ''); // Assuming $row['gender'] contains the selected option value
$selectedOption = strtolower($selectedOption); // Convert to lowercase for case-insensitive comparison
// Debugging: Output the selected option
// echo "Selected Option: $selectedOption <br>";

switch ($selectedOption) {
    case 'male':
        // echo "Case: Male<br>";
        $maleSelected = 'selected';
        $femaleSelected = '';
        $otherSelected = '';
        break;
    case 'female':
        // echo "Case: Female<br>";
        $maleSelected = '';
        $femaleSelected = 'selected';
        $otherSelected = '';
        break;
    case 'other':
        // echo "Case: Other<br>";
        $maleSelected = '';
        $femaleSelected = '';
        $otherSelected = 'selected';
        break;
    default:
        // echo "Case: Default<br>";
        $maleSelected = '';
        $femaleSelected = '';
        $otherSelected = '';
        break;
}
?>

<select id="genderSelect" class="form-select" aria-label="Gender select">
    <option value="Male" <?php echo $maleSelected; ?>>Male</option>
    <option value="Female" <?php echo $femaleSelected; ?>>Female</option>
    <option value="Other" <?php echo $otherSelected; ?>>Other</option>
</select>

          


   




                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="input-group  mt-3">

                            <span class="input-group-text fixed-width p-3 border-0"
                                id="inputGroup-sizing-default">Age</span>
                            <input type="number" class="form-control border-0" aria-label="Sizing example input"
                                style="border-top-right-radius:8px;border-bottom-right-radius:8px"
                                aria-describedby="inputGroup-sizing-default" placeholder="Enter Age" value="<?php echo $row['age'];?>">

                        </div>

                    </div>
                    <div class="col-md-4">

                        <div class="input-group  mt-3">
                            <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default"
                                style="border-top-left-radius:8px;border-bottom-left-radius:8px">DOB</span>
                            <input type="date" class="form-control border-0" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" placeholder="Enter DOB" value="<?php echo $row['dob'];?>">

                        </div>

                    </div>
                    <div class="col-md-4">

                        <div class="input-group  mt-3">
                            <span class="input-group-text fixed-width p-3 border-0"
                                id="inputGroup-sizing-default">Marital Status</span>
                                <?php
$selectedStatus = $row['marital']; // Assuming $row['marital'] contains the selected option value

// Debugging output
// echo "Raw Selected Option: '" . $selectedStatus . "'\n";

// Trim the value to remove any potential leading or trailing spaces
$selectedStatus = trim($selectedStatus);

// Debugging output after trim
// echo "Trimmed Selected Option: '" . $selectedStatus . "'\n";

$marriedSelected = '';
$singleSelected = '';
$divorcedSelected = '';
$widowSelected = '';

switch (strtolower($selectedStatus)) {
    case 'married':
        // echo "Selected Option: Married\n";
        $marriedSelected = 'selected';
        break;
    case 'single':
        // echo "Selected Option: Single\n";
        $singleSelected = 'selected';
        break;
    case 'divorced':
        // echo "Selected Option: Divorced\n";
        $divorcedSelected = 'selected';
        break;
    case 'widow':
        // echo "Selected Option: Widow\n";
        $widowSelected = 'selected';
        break;
    default:
        // echo "Selected Option: '" . $selectedStatus . "'\n";
        echo "Case: Default\n";
        break;
}
?>

<select class="form-select" aria-label="status-select">
    <option value="" <?php echo empty($selectedStatus) ? 'selected' : ''; ?>>Marital Status</option>
    <option value="married" <?php echo $marriedSelected; ?>>Married</option>
    <option value="single" <?php echo $singleSelected; ?>>Single</option>
    <option value="divorced" <?php echo $divorcedSelected; ?>>Divorced</option>
    <option value="widow" <?php echo $widowSelected; ?>>Widow</option>
</select>






                        </div>


                    </div>




                </div>

                <div class="input-group  mt-3 ">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Complexion</span>
                    <input type="text" value = "<?php echo $row['complexion'];?>" class="form-control border-0" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="Enter Complexion">
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Constitution</span>
                    <input type="text"value="<?php echo $row['constitution'];?>" class="form-control border-0" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="Enter Constitution">
                </div>



                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Address</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0" ><?php echo $row['address'];?></textarea>
                    </div>
                </div>
            </div>

            <div class="tab" style="display:none;">


                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Contact
                        No.</span>
                    <input type="number" style="border-top-right-radius:8px;border-bottom-right-radius:8px"
                        class="form-control border-0" value="<?php echo $row['mobile'];?>" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="Enter Contact No.">

                </div>

                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default" > Occupation</span>
                    <input type="text" class="form-control border-0" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" value="<?php echo $row['occupation'];?>"  placeholder="Enter Occupation">
                </div>


                <div class="row">


                    <div class="col-md-6">


                        <div class="input-group  mt-3">
                            <span class="input-group-text fixed-width p-3 border-0" id="height-input">Height</span>

                            <input type="number" class="form-control border-0" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default"  value="<?php echo $row['height'];?>"  placeholder="Enter Height">
                            <span class="input-group-text p-3 border-0 fixed-width" id="inputGroup-sizing-default"
                                style="background-color: #ffffff74; color: rgba(0, 0, 0, 0.661); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                in Metres</span>

                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="input-group  mt-3">
                            <span class="input-group-text fixed-width p-3 border-0" id="weight-input">Weight</span>
                            <input type="number" class="form-control border-0" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" value="<?php echo $row['weight'];?>"  placeholder="Enter Weight">
                            <span class="input-group-text p-3 border-0 fixed-width" id="inputGroup-sizing-default"
                                style="background-color: #ffffff74; color: rgba(0, 0, 0, 0.661); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                in Kgs.</span>
                        </div>


                    </div>
                </div>








                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group  mt-3">
                            <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">
                                Child</span>
                            <input type="number" class="form-control border-0" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" value="<?php echo $row['child'];?>"  placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group  mt-3">
                            <span class="input-group-text fixed-width p-3 border-0"
                                id="inputGroup-sizing-default">Bloodpressure</span>
                            <input type="number" class="form-control border-0" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" value="<?php echo $row['bp'];?>"   placeholder="Enter BP">
                            <span class="input-group-text p-3 border-0 fixed-width" id="inputGroup-sizing-default"
                                style="background-color: #ffffff74; color: rgba(0, 0, 0, 0.661); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                in mmHg</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group  mt-3">
                            <span class="input-group-text fixed-width p-3 border-0"
                                id="inputGroup-sizing-default">Pulse</span>
                            <input type="number" value="<?php echo $row['pulse'];?>" class="form-control border-0" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" placeholder="Enter Pulse">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group  mt-3">
                            <span class="input-group-text fixed-width p-3 border-0"
                                id="inputGroup-sizing-default">Temperature</span>
                            <input type="number" value="<?php echo $row['temperature'];?>" class="form-control border-0" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" placeholder="Enter Tempreature">
                            <span class="input-group-text p-3 border-0 fixed-width" id="inputGroup-sizing-default"
                                style="background-color: #ffffff74; color: rgba(0, 0, 0, 0.661); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                in Fahrenheit</span>
                        </div>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Present
                        Complain</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"><?php echo $row['present'];?></textarea>
                    </div>
                </div>


            </div>


            <div class="tab" style="display:none;">


                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Past
                        History</span>

                    <div class="form-floating">
                        <textarea class="form-control border-0 h-100"><?php echo $row['past'];?></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Family
                        History</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0 h-100"><?php echo $row['family'];?></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default"><br><br><br>
                        <p>Suffering from <br /> any other disease</p>
                    </span>
                    <div class="form-floating ">
                        <textarea class="form-control border-0 h-100"><?php echo $row['disease'];?></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default"><br><br><br>
                        <p>Cause of disease <br />if any</p>
                    </span>
                    <div class="form-floating ">
                        <textarea class="form-control border-0 h-100"><?php echo $row['cause'];?></textarea>
                    </div>
                </div>
            </div>



            <?php
// Assuming $row['mind'] contains the stored mind values as a comma-separated string
$mindField = $row['mind'] ?? ''; // Get the mind field value from the row

// Debug: Print the raw mindField value
// echo "Raw mindField: '$mindField'<br>";

// Convert the comma-separated string to an array and trim whitespace
$selectedMindOptions = array_map('trim', explode(',', $mindField));

// Debug: Print the trimmed mindField value
// echo "Trimmed mindField: '" . implode(', ', $selectedMindOptions) . "'<br>";

// Function to check if an option is selected
function isSelected($value, $selectedOptions) {
    // Debug: Check if the value is in selectedOptions
    $isSelected = in_array($value, $selectedOptions);
    // echo "Checking if '$value' is selected: " . ($isSelected ? 'Yes' : 'No') . "<br>";
    return $isSelected;
}
?>

<div class="tab" style="display:none;">
    <div class="input-group mt-3">
        <span class="input-group-text w-100 rounded-3 p-3 border-0 mb-3" id="inputGroup-sizing-default">Mind</span>

        <div class="btn-group p-3 bg-white row rounded-3 ms-1" role="group" aria-label="Basic checkbox toggle button group" style="width: 100%;">
            <?php
            $options = [
                'Absent Mind', 'Forgetfulness', 'Timid', 'Jealousness', 'Suspicious',
                'Confuse Minded', 'Over Sensitive', 'Sadness', 'Aggressive', 'Angerness',
                'Hot Temprament', 'Overthinking', 'Proudy', 'Over Proudy'
            ];

            foreach ($options as $index => $option): 
                $isChecked = isSelected($option, $selectedMindOptions) ? 'checked' : '';
                // echo "Option: '$option', Checked: '$isChecked'<br>";
                ?>
                <div class="col-md-4 d-flex align-items-center">
                    <input type="checkbox" class="btn-check" id="btncheck<?php echo $index + 1; ?>" autocomplete="off" <?php echo $isChecked; ?>>
                    <label class="btn rounded-3 btn-checker w-100" for="btncheck<?php echo $index + 1; ?>"><?php echo $option; ?></label>
                </div>
            <?php endforeach; ?>
            <div class="col-md-4 d-flex align-items-center">
                <button type="reset" id="clear-selection-button" class="btn rounded-3 w-100">Clear Selection</button>
            </div>
        </div>
    </div>




    <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Head/Neck</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Mouth/Tongue</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>






</div>



            <div class="tab" style="display:none;">








                

                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Eye/Ear</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0">Face/Color</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Nose</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Chest</span>

                    <span class="input-group-text p-3 border-0 fixed-width" id="inputGroup-sizing-default"
                        style="background-color: #ffffff74; color: rgba(0, 0, 0, 0.661); "> Respiratory</span>

                    <input type="text" class="form-control border-0" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="Remarks">

                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Chest</span>

                    <span class="input-group-text p-3 border-0 fixed-width" id="inputGroup-sizing-default"
                        style="background-color: #ffffff74; color: rgba(0, 0, 0, 0.661); "> Cardiac</span>

                    <input type="text" class="form-control border-0" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="Remarks">

                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Abdomen/Pelvis</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
            </div>

            <div class="tab" style="display:none;">

                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Genitalia</span>

                    <span class="input-group-text p-3 border-0 fixed-width" id="inputGroup-sizing-default"
                        style="background-color: #ffffff74; color: rgba(0, 0, 0, 0.661); "> Menses</span>

                    <input type="text" class="form-control border-0" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="Remarks">

                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Genitalia</span>

                    <span class="input-group-text p-3 border-0 fixed-width" id="inputGroup-sizing-default"
                        style="background-color: #ffffff74; color: rgba(0, 0, 0, 0.661); "> Other Discharge</span>

                    <input type="text" class="form-control border-0" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default" placeholder="Remarks">

                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Limb</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Back/Lumber</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Skin/Condition/ <br /> Perspiration</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0 h-100"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Appetite</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>

            </div>

            <div class="tab" style="display:none;">
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Thirst</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Stool</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Urine</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Sleep/Dream</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Discharge If
                        Any</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Addiction If
                        Any</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>

            </div>

            <div class="tab" style="display:none;">
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0" id="inputGroup-sizing-default">Desire</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Aversion</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Aggravation</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
                <div class="input-group  mt-3">
                    <span class="input-group-text fixed-width p-3 border-0"
                        id="inputGroup-sizing-default">Amelioration</span>
                    <div class="form-floating">
                        <textarea class="form-control border-0"></textarea>
                    </div>
                </div>
            </div>
            <div class="input-group mt-3 ">
                <button class="btn p-3 rounded-3 form-control" id="prev" onclick="nextprev(event,-1)"
                    style="background-color: #1da453; color: white; display: none;">Previous</button>
                <button class="btn p-3 rounded-3 form-control" id="next" onclick="nextprev(event,1)"
                    style="background-color: #1da453; color: white;">Next</button>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        var currentTab = 0;;
        showTab(currentTab);

        function showTab(n) {
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            if (n == 0) {
                document.getElementById("prev").style.display = "none";
                document.getElementById("next").style.marginLeft = "0px";
            } else {
                document.getElementById("next").style.marginLeft = "10px";
                document.getElementById("prev").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("next").innerHTML = "Update";
            } else {
                document.getElementById("next").innerHTML = "Next";
            }
        }

        function nextprev(event, n) {
            event.preventDefault();
            var x = document.getElementsByClassName("tab");
            x[currentTab].style.display = "none";
            currentTab = currentTab + n;
            if (currentTab >= x.length) {
                document.getElementById("detailsForm").submit();
                alert("Form submitted!");
                return false;
            }

            showTab(currentTab);
        }




        const heightInput = document.getElementById("height-input"); // Select height input
        const weightInput = document.getElementById("weight-input"); // Select weight input

        function displayUnit(input, unit) {
            input.addEventListener('input', () => {
                input.value = input.value.trim() + unit;
                console.log(unit) // Add unit after removing trailing spaces
            });
        }

        displayUnit(heightInput, 'cm'); // Set unit for height (change 'cm' to your desired unit)
        displayUnit(weightInput, 'kg'); // Set unit for weight (change 'kg' to your desired unit)    
    </script>

</body>

</html>