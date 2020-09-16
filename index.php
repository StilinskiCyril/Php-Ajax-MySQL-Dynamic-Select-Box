<?php
//database connection file
require_once 'connect.php';

//check if form was submitted
if (isset($_POST['submit'])){

    //retrieve the values from the post request
    $room_name = $_POST['room_name'];
    $room_number = $_POST['room_number'];

    //check if the values are empty
    if (empty($room_name) OR empty($room_number)){
        echo '<p class="text-danger text-center font-weight-bold">All fields are required</p>';
    } else {
        echo '<p class="text-success text-center font-weight-bold">You selected room number '
                .$room_number. ' from room ' .$room_name.
            '</p>';
    }
}
?>
<html lang="en">
    <title >Php Ajax Dynamic Select Box</title >
    <head>
        <!--Bootstrap4 css-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
              integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
              crossorigin="anonymous">
        <!--JQuery-->
        <script src="https://code.jquery.com/jquery-3.5.1.js"
                integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
                crossorigin="anonymous"></script>
        <!--Send the AJAX request-->
        <script type="text/javascript">
            function fetch_select(val)
            {
                $.ajax({
                    type: 'POST',
                    url: 'Response.php',
                    data: {
                        get_option:val
                    },
                    success: function (response) {
                        document.getElementById("room_number").innerHTML=response;
                    }
                });
            }

        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="card mt-5">
                <div class="card-header">
                    <p class="text-center">Dynamic Select Option Menu Using Ajax and PHP</p>
                </div>
                <div class="card-body">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="form-group">
                            <label for="room_name">ROOM NAME:</label >
                            <select name="room_name" onchange="fetch_select(this.value);" class="form-control" required>
                                <option value="">Select Room</option>
                                <?php
                                $query = $conn->query("SELECT * FROM rooms");
                                while ($row = $query->fetch()){
                                    echo 'echo "<option value="'.$row['room_name'].'">'.$row['room_name'].'</option>";';
                                }
                                ?>
                            </select >
                        </div>
                        <div class="form-group">
                            <label for="room_number">ROOM NUMBER:</label >
                            <select name="room_number" id="room_number" class="form-control">

                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block">DO SOMETHING</button>
                    </form >
                </div>
            </div>
        </div>
    </body>
</html>

