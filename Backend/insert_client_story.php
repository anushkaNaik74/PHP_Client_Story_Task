<?php $con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project"); ?>

<?php

ob_start();

    // Variables to store form data
    $cs_client = $cs_name = $cs_desc = $cs_status = '';


    if(isset($_POST['submit'])){

        $cs_client              = $_POST['pr_cs_client'];
        $cs_name                = $_POST['pr_cs_name'];
        $cs_desc                = $_POST['pr_cs_desc'];
        $cs_status              = $_POST['pr_cs_status'];


        // Insert data into the database
        $insert_client_story = "INSERT INTO pr_client_story (
                                pr_cs_client, 
                                pr_cs_name, 
                                pr_cs_desc, 
                                pr_cs_status
                            ) VALUES (
                                '$cs_client', 
                                '$cs_name', 
                                '$cs_desc', 
                                '$cs_status'
                            )";

        // Execute the SQL query

        if (mysqli_query($con, $insert_client_story)) {
          // Redirect to another page after successful insertion
          header('Location: insert_client_story.php');
          exit; // Make sure to exit after redirection
      } else {
          echo "Error: " . $insert_client_story . "<br>" . mysqli_error($con);
      }
        } 
        

   ob_end_flush(); 
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"/>
    <title>Client Story</title>
    <link rel="stylesheet" href="../Styles/insert_client_story.css">
  </head>
  <body>
  <form id="registration_form" method="post" enctype="multipart/form-data">
    <div class="wrapper">
      <div class="form-row">
        <label for="pr_cs_client">Client</label>
        <input type="number" name="pr_cs_client" id="pr_cs_client" placeholder="Enter Client" required>
      </div>

      <div class="form-row">
        <label for="pr_cs_name">Name</label>
        <input type="text" name="pr_cs_name" id="pr_cs_name" placeholder="Enter Name" required>
      </div>

      <div class="form-row">
        <label for="pr_cs_desc">Description</label>
        <textarea type="text" name="pr_cs_desc" id="pr_cs_desc" placeholder="Enter Description" required></textarea>

      </div>

      <div class="form-row">
        <label for="pr_cs_status">Status</label>
        <input type="number" name="pr_cs_status" id="pr_cs_status" placeholder="Enter Status">
      </div>

      <div class="buttonSubmit">
        <input type="submit" name="submit" value="Submit">
      </div>
    </div>
    <h3>Client Story Details</h3>
  <table>
    <tr>
      <th>#</th>
      <th>Client</th>
      <th>Name</th>
      <th>Description</th>
      <th>Status</th>
      <th>Operations</th>
    </tr>

    <?php
      $i = 1;
      $select_all_client_story_query = "SELECT * FROM pr_client_story";
      $select_all_client_story_query_sql = mysqli_query($con, $select_all_client_story_query);
      $count_select_all_client_story_query = mysqli_num_rows($select_all_client_story_query_sql);

      if($count_select_all_client_story_query  > 0){
        while ($row = $select_all_client_story_query_sql -> fetch_assoc()) {
          $id = $row['pr_cs_id'];
    ?>

        <tr>
        <td><?php echo $i++ ?></td>
        <td><?php echo $row['pr_cs_client']?></td>
        <td><?php echo $row['pr_cs_name']?></td>
        <td><?php echo $row['pr_cs_desc']?></td>
        <td><?php echo $row['pr_cs_status']?></td>

        <td class="operations">
            <a href="update_client_story.php?id=<?php echo $id; ?>" class="edit-button">Edit</a>
            <a href="delete_client_story.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure?')" class="delete-button">Delete</a>
        </td>
        </tr>

    <?php 
        }
      }
    ?>
  </table>
  </body>
</html>

  