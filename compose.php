<?php
include('header.php'); //loading bootstrap, jquery, mustache and so on
?>
<div class='container'>
    <form action='home.php' method='post'> 
        <div class="form-group">
                <label for="pTitle">Title</label>
                <input name='pTitle' class="form-control"> </input>
                <label for="pBody">POST</label>
                <textarea name='pBody' class="form-control"> </textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-info" onclick="location.href='index.php'">home</button>
   
    </form>
</div>

<?php
include('footer.php');
?>


