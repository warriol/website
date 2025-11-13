<?php
session_start();
include('config/config1.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
    <?php
    include('app/header-meta.tpl'); // no links
    include('app/header-links.tpl'); // echo
    ?>
</head>
<body>
<div class="body">
    <?php
    include('app/body-header.tpl'); // hecho
    ?>
    <div role="main" class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php
                    include('blog/cuerpo.php');
                    ?>
                </div>

                <div class="col-md-3">
                    <aside class="sidebar">
                        <?php
                        include('blog/side.php');
                        ?>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('app/body-footer.tpl'); // hecho
    ?>
</div>
<?php
include('app/body-scripts.tpl'); // echo
include('app/body-scripts-index.tpl'); // echo
?>
</body>
</html>