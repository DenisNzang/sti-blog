<?php require('head.html'); ?>
    <body>
        <?php require('header.html'); ?>
        <br><br><br><br>
            <div class="container">
                <table class="table table-condensed">
                    <?php
                        $db = new SQLite3('db/blog.db');
                        $posts = $db->query("SELECT post.id AS post_id, post.user_id AS user_id,
                                                post.date AS post_date, post.title AS post_title,
                                                post.content AS post_content,
                                                post.category_id AS post_category_id, post.image AS post_image,
                                                user.id AS user_id, user.name AS user_name,
                                                user.image AS user_image
                                            FROM post, user
                                            WHERE user.id = post.user_id
                                            ORDER BY post.id");
                        while ($post = $posts->fetchArray()) {
                            echo '<tr><td><h1><strong>'.$post['post_title'].'</strong></h1></td></tr>
                                    <tr><td><cite>por '.$post['user_name'].' ('. $post['post_date'].')</cite></td></tr>
                                    <tr><td><div align="center"><img src="data:image/jpeg;base64,'.base64_encode($post['post_image'])
                                    .'" class="responsive"></div></td></tr><tr><td>'.$post['post_content'].'</td></tr>
                                    <tr><td><br><br><strong>Comentarios:</strong></td></tr>';
                            $comments = $db->query("SELECT user.id, user.name, user.image, comment.date, comment.content
                                                    FROM user, comment
                                                    WHERE comment.post_id = $post[post_id]
                                                    AND user.id = comment.user_id
                                                    ORDER BY comment.id");
                            while ($comment = $comments->fetchArray()) {
                                echo '<table class="table table-condensed"><tr><td><cite>
                                        <img src="data:image/jpeg;base64,'.base64_encode($comment['image'])
                                        . '" width=40> '.$comment['content'] . '</table>';
                            }
                        }
                    ?>
                </table>
            </div>
        <?php require('footer.html'); ?>
    </body>
</html>
