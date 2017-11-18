<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Модуль коментариев</title>
    <script type="text/javascript" src=<?php ROOT ?>'/js/controller.js'></script>
    <script type="text/javascript" src=<?php ROOT ?>'/js/model.js'></script>
    <script type="text/javascript" src=<?php ROOT ?>'/js/view.js'></script>
</head>
<body>
<div class="js-input">
    <div class="comment-group">
        <label>Заголовок коментария</label>
        <input type="text" name="head" placeholder="Зголовок коментария" class="js-head">
    </div>
    <div class="comment-group">
        <label>Текст коментария</label>
        <textarea class="js-text" name="text" placeholder="Введите текст коментария"></textarea>
    </div>
    <button class="js-send">Отправить</button>
    <button class="js-reset">Очистить</button>
</div>
<div class="js-comment-wrapper">
    <!--Тут будут выводится коментарии-->
    <?php foreach($list as $id => $comment): ?>
        <div class="comment_<?php echo $id; ?>">
            <h5 class="comment_header"><?php echo $comment['head']; ?></h5>
            <p class="comment_content"><?php echo $comment['content']; ?></p>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>