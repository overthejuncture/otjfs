<?php
/** @var \Core\View $this */
echo 'before mainBody';
$this->yield('mainBody');
echo 'after mainBody';
$this->yield('mainCheck');
