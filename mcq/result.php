<!DOCTYPE html>
<html>

<body>
    <?php
    $i = 1;
    $row1 = "nthhh";
    $row2 = "5";
    $row3 = "6";
    $row4 = "7";
    $row5 = "8";
    $row6 = "9";
    $row7 = "10";
    $row8 = "11";

    echo "<html>";
    echo "<head><title>SBA</title></head>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
    
    echo "<ul style='padding:0; display: block;'class='quiz'>";
echo  "<h4 style='background-color: #f2f2f2; margin:0px;  padding: 0; font-weight: bold;'>" . $i . ") ".$row1."</h4>";
    echo "<ul class='choices' style='background-color: #f2f2f2;'>";
    echo "<input type='radio' id='ans_a' name=" . $row2 . "  value=" . $row3 . " />";
    echo "<h7> A) </h7>";
    echo "<span>" . $row3. "</span>";
    echo "<br>";
    echo "<input type='radio' id='ans_b' name=" . $row2 . " value=" . $row4 . " />";
    echo "<h7> B) </h7>";
    echo "<span>" . $row4 . "</span>";
    echo "<br>";
    echo "<input type='radio' id='ans_c' name=" . $row2 . " value=" . $row5 . " />";
    echo "<h7> C) </h7>";
    echo "<span>" . $row5 . "</span>";
    echo "<br>";
    echo "<input type='radio' id='ans_d' name=" . $row2 . " value=" . $row6 . " />";
    echo "<h7> D) </h7>";
    echo "<span>" . $row6 . "</span>";
    echo "<br>";
    echo "<input type='radio' id='ans_e' name=" . $row2 . " value=" . $row7 . " />";
    echo "<h7> E) </h7>";
    echo "<span>" . $row7 . "</span>";
    echo "<br>";
    echo "right Ans:" . $row8 . "";

    echo "<button onclick='myFunction()'>Try it</button>";
    echo "<p id='demo'></p>";
    
    // echo "<input type='radio' name='colors' value='red' id='r1'>Red color";
    // echo "<input type='radio' name='colors' value='black' id='r2'>black color";
    // echo "<input type='radio' name='colors' value='blue' id='r3'>blue color";

    // echo "<p>Click the 'Try it' button to display the value of the value attribute of the radio button.</p>";
    // echo "<button onclick='myFunction()'>Try it</button>";

    echo "<p id='demo'></p>"
    ?>
    <script>
        function myFunction() {
            if (document.getElementById('ans_e').checked) {
                rate_value = document.getElementById('ans_e').value;
                console.log(rate_value);
                document.getElementById("demo").innerHTML = rate_value;
            } else if (document.getElementById('ans_d').checked) {
                rate_value = document.getElementById('ans_d').value;
                document.getElementById("demo").innerHTML = rate_value;
            } else if (document.getElementById('ans_c').checked) {
                rate_value = document.getElementById('ans_c').value;
                document.getElementById("demo").innerHTML = "I have changed!";
            }
            return;
        }
    </script>

</body>

</html>