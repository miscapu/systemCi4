<?=
$this->extend( 'Layouts/main' );

$this->section( 'content' );

?>

    <!-- Title -->
    <h1 class="modal-title text-center my-lg-2"><?= isset( $title ) ? esc( $title ) : "";?></h1>
    <!-- Title End -->

    <div class="container">
        <?php
        if ( session()->get( 'firstname' ) && session()->get( 'lastname' ) ):
            $firstname  =   session()->get( 'firstname' );
            $lastname   =   session()->get( 'lastname' );

            endif;
        ?>
        <h5 class="bg-info-subtle">Hello, <?= $firstname . " " . $lastname;  ?></h5>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
        </tr>
        </tbody>
    </table>

<?php
$this->endSection();