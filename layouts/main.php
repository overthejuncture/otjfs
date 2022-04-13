<?php
/** @var \Core\Routing\View $this */
?>
    <head>
        <title><?php $this->yield('title'); ?></title>
    </head>
<?php
$this->yield('mainBody');
