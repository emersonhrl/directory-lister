<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Lister</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        function filesMap($path) {			
            if (is_dir($path)) {
                $list = array_diff(
                    preg_grep("/^([^.])/", scandir($path, 1)),
                    ['.', '..']
                );
                foreach ($list as $folder) {
                    $path_cwd = $path . "/" . $folder;
                    $path_link = str_replace(getcwd() . "/", "", $path . "/" . $folder);

                    if (is_dir($path_cwd)) {
                        echo "<a class='line' href='?path=" . $path_link . "'>";                                
                            echo "<div class='name'>";
                                echo "<i class='bi bi-folder'></i>";
                                echo $folder;
                            echo "</div>";
                            echo "<div class='size'> - </div>";
                            echo "<div class='date'>";
                                echo date("Y-m-d H:i:s", filemtime($path_cwd));
                            echo "</div>";
                        echo "</a>";
                    } else if (is_file($path_cwd)) {
                        echo "<a class='line' target='_blank' href='" . $path_link . "'>";
                            echo "<div class='name'>";
                                $extension = explode(".", $folder);
                                echo "<i class='bi bi-filetype-" . $extension[1] . "'></i>";
                                echo $folder;
                            echo "</div>";
                            echo "<div class='size'>";
                                echo number_format(filesize($path_cwd), 0, ',', '.') . " bytes";
                            echo "</div>";
                            echo "<div class='date'>";
                                echo date("Y-m-d H:i:s", filemtime($path_cwd));
                            echo "</div>";
                        echo "</a>";
                    }
                }
            }
        }

        $path = $_GET["path"] ?? getcwd();
    ?>
    <div class="container">
        <div class="list">
            <div class="line">
                <div class="name">Name</div>
                <div class="size">Size</div>
                <div class="date">Date</div>
            </div>
            <?php
                filesMap($path);
            ?>
        </div>
    </div>
    <script type="text/javascript" src="main.js"></script>
</body>
</html>