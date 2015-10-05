<ul>
    <li><?php echo CHtml::link('Создать новую запись',array('site/postForm')); ?></li>
    <li><?php echo CHtml::link('Управление записями',array('post/admin')); ?></li>
    <li><?php echo CHtml::link('Одобрение комментариев',array('comment/index')); ?></li>
    <li><?php echo CHtml::link('Выход',array('site/logout')); ?></li>
</ul>