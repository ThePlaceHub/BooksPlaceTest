<?php
/* @var $this yii\web\View */
?>
<h1>Books</h1>

<table class="table table-condensed">
    <tr>
        <th>Author</th>
        <th>Title</th>
    </tr>
    <?php foreach ($books as $book): ?>
        <tr>
            <td><?php echo $book->author->first_name . ' ' . $book->author->last_name; ?></td>
            <td><?= $book->title ?></td>
        </tr>
    <?php endforeach; ?>
</table>
