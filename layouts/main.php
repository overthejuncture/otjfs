<?php
/** @var \Core\Routing\View $this */
?>
    <head>
        <title><?php $this->yield('title'); ?></title>
        <?php $this->stack('head_css') ?>
    </head>
<?php
$this->yield('mainBody');
