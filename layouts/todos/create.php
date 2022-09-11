<?php /** @var \Core\Routing\View $this */ ?>

<?php $this->extend('main');
$this->section('mainBody');
?>
<form action="/api/todos/create" method="POST">
    <label for="text">
        <input id="text" name="text" type="text">
    </label>
</form>
<?php $this->endSection();