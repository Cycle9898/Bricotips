<?php

/**
 * Displays a collapsible block with a title and, inside it, a definition.
 *
 * @package WordPress
 * @subpackage BricoTips
 */
?>

<div class="word">
    <div class="title">
        <?= $args["title"] ?>
        <div class="action">
            <div class="down">&#9660;</div>
            <div class="up">&#9650;</div>
        </div>
    </div>
    <div class="definition">
        <?= $args["definition"] ?>
    </div>
</div>