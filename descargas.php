    <?php require('head.html'); ?>
        <body>
            <br><br><br><br>
            <div class="row" id="gallery">
                <?php
                    require('header.html');
                    $dir = "download/";
                    $count = 0;
                    $list = dir($dir);
                    while(($file = $list->read()) !== false) {
                        if($file === "." || $file === "..") continue;
                        if(substr($file, -3) === "jpg") {
                            echo "<div class='col-12 col-sm-6 col-lg-3'>
                                    <img class='w-100' src='download/$file'>
                                </div>";
                        }
                        $count++;
                    }
                    echo "</div>";
                ?>
            </body>
        <?php require('footer.html'); ?>
</html>
