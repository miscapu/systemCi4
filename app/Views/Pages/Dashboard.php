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
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>

        </tr>
        </thead>
        <tbody>
        <?php if( isset( $users ))
        foreach ( $users as $user ):
        ?>
        <tr>
            <th scope="row"><?= $user->id; ?></th>
            <td><?= $user->firstname; ?></td>
            <td><?= $user->lastname; ?></td>
            <td><?= $user->email; ?></td>
            <td><?= $user->created_at; ?></td>
            <td><?= $user->updated_at; ?></td>
        </tr>
        <?php
            endforeach;
            ?>
        </tbody>
    </table>

<?php
$this->endSection();