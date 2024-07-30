<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <?php include "layout/header.html" ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[type="checkbox"]').change(function() {
                var taskId = $(this).siblings('input[name="id"]').val();
                var isChecked = $(this).is(':checked') ? 1 : 0;
                
                $.ajax({
                    url: 'update_status.php',
                    type: 'POST',
                    data: {
                        id: taskId,
                        status: isChecked
                    },
                    success: function(response) {
                        if (isChecked) {
                            $('input[value="' + taskId + '"]').closest('li').addClass('completed');
                        } else {
                            $('input[value="' + taskId + '"]').closest('li').removeClass('completed');
                        }
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Todo List</h1>
        <img src="img/yunli.jpg" alt="rusa">
        <form action="add_task.php" method="post">
            <input type="text" name="task" placeholder="Enter new task" required>
            <input type="submit" value="Add">
        </form>
        <ul>
            <?php
            include 'db.php';
            $query = "SELECT * FROM tasks";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                $checked = $row['status'] ? 'checked' : '';
                $completedClass = $row['status'] ? 'completed' : '';
                echo "<li class='$completedClass'>
                        <form style='display: flex; align-items: center;'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <input type='checkbox' name='status' $checked>
                        </form>
                        <span>{$row['task']}</span>
                        <div class='actions'>
                            <a href='delete_task.php?id={$row['id']}' class='delete-link'>Delete</a>
                            <a href='index.php?edit={$row['id']}'class='edit-link'>Edit</a>
                      </li>";
            }
            ?>
        </ul>
        <?php
        if (isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $query = "SELECT * FROM tasks WHERE id=$id";
            $result = mysqli_query($conn, $query);
            $task = mysqli_fetch_assoc($result);
        ?>
        <form action="edit_task.php" method="post" class="edit-form">
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
            <input type="text" name="task" value="<?php echo $task['task']; ?>" required>
            <input type="submit" value="Update">
        </form>
        <?php } ?>
    </div>
    <?php include "layout/footer.html" ?>
</body>
</html>
