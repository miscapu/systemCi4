<?=
$this->extend( 'Layouts/main' );

$this->section( 'content' );
?>

    <form method="post">
        <div class="mb-3">
            <label for="emailFrm" class="form-label">Email address</label>
            <input type="email" name="emailFrm" class="form-control" id="emailFrm" value="<?= set_value( "emailFrm" );?>">
        </div>
        <div class="mb-3">
            <label for="pwdFrm" class="form-label">Password</label>
            <input type="password" name="pwdFrm" class="form-control" id="pwdFrm">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

<?php
$this->endSection();