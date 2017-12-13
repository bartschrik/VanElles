<div class="content">
    <?php
    include_once('includes/header.php');

    $msg = "";

    if(isset($_GET['verid'])) {
        $veruser = $user->deleteUser($_GET['verid']);
        $msg = $veruser;
    }

    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $rowspPage = 10;

    $users = $user->getAllUsersMin($page, $rowspPage);

    $aantalP = ceil($users['aantal'] / $rowspPage);

    if(!$users && is_bool($users)) {
        $msg = '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is iets mis gegaan met onze database, probeer het later opnieuw.</p></div></div></div>';
    }

    ?>
    <div class="pagetitel marbot">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">Geberuikers <span>overzicht</span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 inhoud">
                <div class="titel">
                    <i class="fa fa-cog"></i><span>Gebruikers's beheren</span>
                </div>
                <div class="row">
                    <div class="col-xs-6"></div>
                    <div class="col-xs-6 text-right"><a href="gebruiker_toevoegen.php" id="pvt"><i class="fa fa-plus"></i> voeg een gebruiker toe</a></div>
                </div>
                <?php
                echo $msg;
                if($users != false) {
                    echo '
                        <table class="maintable" style="margin-bottom: 20px;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Naam</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th style="width: 100px;">Optie\'s</th>
                                </tr>
                            </thead>
                            <tbody>';
                    foreach($users['values'] as $value) {

                        echo '
                            <tr>
                                <td>#'.$value['user_id'].'</td>
                                <td><div>'.$value['first_name']." ". $value['insertion'] . " " . $value['last_name'].'</div></td>
                                <td>'.$value['email'].'</td>
                                <td>'.$value['role_name'].'</td>
                                <td><a href="gebruiker_bewerk.php?bewerkid='.$value['user_id'].'" title="Bewerken" data-id="'.$value['user_id'].'"><i class="fa fa-pencil"></i></a><a class="confirm" href="gebruikers_overzicht.php?verid='.$value['user_id'].'" title="Verwijderen" data-id="'.$value['user_id'].'"><i class="fa fa-trash"></i></a></td>
                            </tr>';

                    }
                    echo '
                            </tbody>
                        </table>';
                }

                ?>
                <nav aria-label="Page navigation example" style="text-align: center;">
                    <ul class="pagination justify-content-center">
                        <?php
                        if($page == 1) {
                            echo '
                                <li class="page-item disabled">
                                    <a class="page-link">Vorige</a>
                                </li>
                            ';
                        } else {
                            echo '
                                <li class="page-item">
                                    <a class="page-link" href="gebruikers_overzicht.php?page='. ($page - 1) .'">Vorige</a>
                                </li>
                            ';
                        }
                        for ($i = 1; $i <= $aantalP; $i++) {
                            if($page == $i) {
                                echo '
                                    <li class="page-item active">
                                        <a class="page-link" href="gebruikers_overzicht.php?page='.$i.'">'.$i.'</a>
                                    </li>
                                ';
                            } else {
                                echo '
                                    <li class="page-item">
                                        <a class="page-link" href="gebruikers_overzicht.php?page='.$i.'">'.$i.'</a>
                                    </li>
                                ';
                            }
                        }
                        if($page == $aantalP) {
                            echo '
                                <li class="page-item disabled">
                                    <a class="page-link">Volgende</a>
                                </li>
                            ';
                        } else {
                            echo '
                                <li class="page-item">
                                    <a class="page-link" href="gebruikers_overzicht.php?page='. ($page + 1) .'">Volgende</a>
                                </li>
                            ';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">

            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(".confirm").click(function(e){
        var r = confirm("Weet je zeker dat je deze gebruiker wilt verwijderen?");
        console.log('pong2');
        if (r == true) {
            console.log('ping');
        } else {
            return false;
            console.log('pong');
        }
    });
</script>
</html>