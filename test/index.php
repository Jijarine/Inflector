<?php require('../lib/inflector.php'); ?>

<p><?php echo Inflector::pluralize('turtle'); ?></p>

<p><?php echo Inflector::singularize('people'); ?></p>

<p><?php echo Inflector::camelize('this_one_word'); ?></p>

<p><?php echo Inflector::underscore('ThisWordMaybeAnother'); ?></p>

<p><?php echo Inflector::humanize('ThisWord_MaybeAnother'); ?></p>

<p><?php echo Inflector::tableize('user'); ?></p>

<p><?php echo Inflector::classify('underscored_word'); ?></p>

<p><?php echo Inflector::variable('a_variable'); ?></p>

<p><?php echo Inflector::slug('all about how WE stopped global warming!', '-'); ?></p>