<html>
<script src="https://kit.fontawesome.com/c3f1d5478b.js" crossorigin="anonymous"></script>
<?php
include "header.php";
?>

<body>

    <!-- Main content -->
    <section style="padding: 20px; margin-left: 30px;">
        <center>
            <h3>Feedback</h3>

            <div class="container">
                <form>
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" name="firstname" placeholder="Your name..">

                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" name="lastname" placeholder="Your last name..">

                    <label for="subject">Subject</label>
                    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

                    <input type="submit" value="Submit">
                </form>
            </div>
        </center>
    </section>

<?php require_once "footer.php"; ?>

</body>

</html>