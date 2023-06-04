<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $Nama = isset($_POST['Nama']) ? $_POST['Nama'] : '';
    $NIM = isset($_POST['NIM']) ? $_POST['NIM'] : '';
    $Program_Studi = isset($_POST['Program_Studi']) ? $_POST['Program_Studi'] : '';
    // $pekerjaan = isset($_POST['pekerjaan']) ? $_POST['pekerjaan'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO mahasiswa VALUES (?, ?, ?, ?)');
    $stmt->execute([$id, $Nama, $NIM, $Program_Studi]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Mahasiswa</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="Nama">Nama</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="Nama" id="Nama">
        <label for="NIM">NIM </label>
        <label for="Program_Studi">Program Studi</label>
        <input type="text" name="NIM" id="NIM">
        <input type="text" name="Program_Studi" id="Program_Studi">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>