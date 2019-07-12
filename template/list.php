<!-- template/list.php -->
<!DOCTYPE html>
<html>
    <head>
        <title>Gallery</title>
        <style>
        img{width:300px;height:300px; margin-top:30px;}
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    
    </head>
    <body>
        <h1 class="col-sm-offset-1">Gallery</h1>
        <form method="GET" class="col-sm-offset-1">
            <select name="category" class="selectpicker">
                <?php foreach($categories as $c){
                    $selected = "";
                    if($c['id'] == $_GET['category']){
                        $selected = "selected";
                    }
                    echo '<option '.$selected.' value="' . $c['id'] . '">' . $c['name'] . '</option>';
                    
                }?>
            </select>
            <input class="btn btn-success btn-sm" value="Change" type="submit">
        </form>
        <?php foreach ($photos as $photo){
            echo '<img src="data:image/png;base64,' . base64_encode($photo['name']) . '" />';
        }?>

        <?php foreach ($movies as $movie){
            echo '<video controls=""><source src="../uploads/'.$movie['name'].'" type="video/mp4"></video>';
        }?>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

    </body>
</html>