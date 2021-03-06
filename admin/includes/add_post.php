<?php

if (isset($_POST['create_post'])) {

    $post_title = escape($_POST['post_title']);
    $post_user = escape($_POST['post_user']);
    $post_category_id =escape($_POST['post_category']);
    $post_status = escape($_POST['post_status']);

    $post_image = escape($_FILES['post_image']['name']);
    $post_image_temp = escape($_FILES['post_image']['tmp_name']);

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = escape(date('d-m-y'));

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_title,post_user,post_category_id,post_status,post_image,post_tags,post_content,post_date) ";
    $query .= "VALUES('{$post_title}','{$post_user}','{$post_category_id}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}',now() ) ";

    $create_post_query = mysqli_query($connection, $query);

    confirmQuery($create_post_query);

    $the_post_id = mysqli_insert_id($connection);

    echo "<p class='bg-success'> Post Created. <a href='../post.php?p_id={$the_post_id}'> View Post </a> or <a href='posts.php'>Add More Posts</a> </p>";

}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_category">Category</label>
        <select name="post_category" id="">

            <?php

$query = "SELECT * FROM categories";

$select_categories = mysqli_query($connection, $query);

confirmQuery($select_categories);

while ($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = escape($row['cat_id']);
    $cat_title =escape($row['cat_title']);

    echo "<option value='$cat_id'>{$cat_title}</option>";

}

?>


        </select>
    </div>
    <div class="form-group">
        <label for="users">Users</label>
        <select name="post_user" id="">

            <?php

$query = "SELECT * FROM users";

$select_users = mysqli_query($connection, $query);

confirmQuery($select_users);

while ($row = mysqli_fetch_assoc($select_users)) {
    $user_id = escape($row['user_id']);
    $username = escape($row['username']);

    echo "<option value='$username'>{$username}</option>";

}

?>


        </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div> -->


    <div class="form-group">

        <select name="post_status" id="">
            <option value='draft'>Post Status</option>
            <option value='draft'>Draft</option>
            <option value='published'>Published</option>

        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>


    <div class="form-group">
        <label for="post_content">Post content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
    </div>

</form>