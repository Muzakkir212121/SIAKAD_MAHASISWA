<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $Nama = isset($_POST['Nama']) ? $_POST['Nama'] : '';
        $NIM = isset($_POST['NIM']) ? $_POST['NIM'] : '';
        $Program_Studi = isset($_POST['Program_Studi']) ? $_POST['Program_Studi'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE mahasiswa SET id = ?, Nama = ?, NIM = ?, Program_Studi = ? WHERE id = ?');
        $stmt->execute([$id, $Nama, $NIM, $Program_Studi, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM mahasiswa WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
    <h2>Update Dosen #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id" readonly>
        <br>
        <label for="Nama">Nama</label>
        <input type="text" name="Nama" value="<?=$contact['Nama']?>" id="Nama">
        <br>
        <label for="NIM">NIM</label>
        <input type="text" name="NIM" value="<?=$contact['NIM']?>" id="NIM">
        <br>
        <label for="Program_Studi"> Program Studi</label>
        <input type="Program_Studi" name="Program_Studi" id="Program_Studi">
        <div class="submit-button">
          <input type="submit" value="Update">
        </div>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>