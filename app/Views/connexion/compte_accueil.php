<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <center>
                <h2>Espace d'administration</h2>
            </center>
            <br />
            <center>
                <h2>
                    <?php
                    $session = session();
                    echo "Session";
                    if ($session->get('role') == 'A') {
                        echo " Admin ouverte !";
                    } else {
                        echo " Jury ouverte !";
                    }
                    echo "</h2><h2>Bienvenue ";
                    echo $session->get('user');
                    ?> !
                </h2>
            </center>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->