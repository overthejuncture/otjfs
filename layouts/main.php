<?php
/** @var \Core\View $this */
$this->extend('outer');
$this->section('body');
$this->yield('mainBody');
$this->yield('mainCheck');

$this->endSection();
