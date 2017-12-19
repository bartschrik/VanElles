<div class="content">
    <?php
    include_once('includes/header.php');

    $msg    = '';
    $errors = [];
    $role   = '';

    if(!isset($_POST['saveGebruiker'])) {
        $userVal = $user->getUserById($_GET['bewerkid'])[0];

        $_POST['voornaam']      = $userVal['first_name'];
        $_POST['tussen']        = $userVal['insertion'];
        $_POST['achternaam']    = $userVal['last_name'];
        $_POST['email']         = $userVal['email'];
        $_POST['geboorte']      = date("d-m-Y", strtotime($userVal['birthday']));
        $_POST['tel']           = $userVal['phonenumber'];
        $_POST['adres']         = $userVal['address'];
        $_POST['stad']          = $userVal['city'];
        $_POST['postcode']      = $userVal['zipcode'];
        $_POST['role']          = $userVal['role'];
        $_POST['gebruikersnaam']= $userVal['gebruikersnaam'];
        $_POST['wachtwoord']    = "";
        if($userVal['wachtwoord']) {
            $_POST['oldww']         = "ja";
        } else {
            $_POST['oldww']     ="";
        }
    } else {

        if($_POST['role'] == 2) {
            $val = new Validate([
                ['email', $_POST['email'],'required|email']
            ]);
        } else {
            if($_POST['gebruikersnaam'] && !$_POST['wachtwoord'] && $_POST['oldww']) {
                $val = new Validate([
                    ['email', $_POST['email'],'required|email']
                ]);
            } else {
                if($_POST['oldww']) {
                    $val = new Validate([
                        ['email', $_POST['email'],'required|email'],
                        ['gebruikersnaam', $_POST['gebruikersnaam'],'required'],
                        ['wachtwoord', $_POST['wachtwoord'],'required|password']
                    ]);
                } else {
                    $val = new Validate([
                        ['email', $_POST['email'],'required|email'],
                        ['gebruikersnaam', $_POST['gebruikersnaam'],'required|uni:admin:gebruikersnaam'],
                        ['wachtwoord', $_POST['wachtwoord'],'required|password']
                    ]);
                }
            }
        }

        if ($val->isPassed()) {
            $saveUser = $user->update(
                $_POST['email'],
                $_POST['voornaam'],
                $_POST['tussen'],
                $_POST['achternaam'],
                $_POST['tel'],
                $_POST['stad'],
                $_POST['adres'],
                $_POST['postcode'],
                $_POST['role'],
                date("Y/m/d", strtotime($_POST['geboorte'])),
                $_GET['bewerkid'],
                $_POST['gebruikersnaam'],
                $_POST['wachtwoord']
            );

            if (!$saveUser) {
                $msg = '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is een probleem met onze serve, probeer het later opnieuw.</p></div></div></div>';
            } else {
                $msg = '<div class="feedback success container"><div class="row"><div class="col-xs-12"><p>Uw wijzigingen zijn succesvol doorgevoerd.</p></div></div></div>';
                $_POST['oldww']         = "ja";
            }
        } else {
            $errors = $val->getErrors();
            $errorList = '';
            foreach ($errors as $errorcat) {
                foreach ($errorcat as $error) {
                    $errorList .= "<li>$error</li>";
                }
            }
            $msg = '<div class="feedback error container"><div class="col-xs-12"><ul style="padding: 0;">' . $errorList . '</ul></div></div>';
        }
        $_POST['wachtwoord']    = "";
    }

    if($roles = $user->getRoles()) {
        $role = '<select name="role" id="selectrole" style="width: 100%;">';
        foreach($roles as $value) {

            if($value['role'] == InputValue('role')) {
                $id = $value['role'];
                $naam = $value['role_name'];

                $role .= '<option selected value="'.$id.'">'.$naam.'</option>';
            } else {
                $id = $value['role'];
                $naam = $value['role_name'];

                $role .= '<option value="'.$id.'">'.$naam.'</option>';
            }

        }
        $role .= '</select>';
    } else {
        $role = '<div class="feedback error container"><div class="row"><div class="col-xs-12"><p>Er is een probleem met het ophalen van de gegevens</p></div></div></div>';
    }

    ?>
    <div class="pagetitel marbot">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">Gebruiker <span></span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 inhoud">
                <div class="titel">
                    <i class="fa fa-cog"></i><span>Gebruiker toevoegen</span>
                </div>
                <div class="row">
                    <?php

                    echo $msg;

                    echo '
                    <form action="#" method="post" class="classicform">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <input type="text" name="voornaam" placeholder="Voornaam" value="' . InputValue('voornaam') . '" class="' . InputErrorClass('voornaam', $errors) . '" />
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-5">
                                    <input type="text" name="tussen" placeholder="Tussenvoegsel" value="' . InputValue('tussen') . '" class="' . InputErrorClass('tussen', $errors) . '" />
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-7">
                                    <input type="text" name="achternaam" placeholder="Achternaam" value="' . InputValue('achternaam') . '" class="' . InputErrorClass('achternaam', $errors) . '" />
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="email" placeholder="E-mailadres" value="' . InputValue('email') . '" class="' . InputErrorClass('email', $errors) . '" />
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="date" id="date" name="geboorte" placeholder="Geboorte datum:" value="' . InputValue('geboorte') . '" class="' . InputErrorClass('geboorte', $errors) . '" />
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="tel" placeholder="Telefoonnummer" value="' . InputValue('tel') . '" class="' . InputErrorClass('tel', $errors) . '" />
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="adres" placeholder="Adres" value="' . InputValue('adres') . '" class="' . InputErrorClass('adres', $errors) . '" />
                                </div>
                                <div class="col-md-6 col-sm-5 col-xs-5">
                                    <input type="date" name="postcode" placeholder="Postcode" value="' . InputValue('postcode') . '" class="' . InputErrorClass('postcode', $errors) . '" />
                                </div>
                                <div class="col-md-6 col-sm-7 col-xs-7">
                                    <input type="text" name="stad" placeholder="Stad" value="' . InputValue('stad') . '" class="' . InputErrorClass('stad', $errors) . '" />
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <h4 style="margin: 0 0 10px; height: 43px;">Account informatie</h4>
                            ' .$role. '
                            <div id="accountInfo" style="display: none;">';
                            echo '<input type="text" name="gebruikersnaam" id="gbn" placeholder="Gebruikersnaam" value="' . InputValue('gebruikersnaam') . '" class="' . InputErrorClass('gebruikersnaam', $errors) . '" />';
                            echo '<input type="password" name="wachtwoord" id="gbnww" placeholder="Wachtwoord" value="' . InputValue('wachtwoord') . '" class="' . InputErrorClass('wachtwoord', $errors) . '" />';
                            echo '<input type="password" hidden readonly name="oldww" id="oldww" value="' . InputValue('oldww') . '" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="submit" name="saveGebruiker" class="save">Opslaan</button>
                                <a href="gebruikers_overzicht.php" title="Anuleren" class="annuleer">Anuleren</a>
                            </div>
                        </div>
                    </form>';

                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="../js/jquery.datetimepicker.full.js" type="text/javascript"></script>
<script>
    $('#date').datetimepicker({
        timepicker:false,
        format:'d-m-Y',
        formatDate:'Y/m/d',
        minDate: false,
        maxDate:'-1970/01/02',
        defaultDate: new Date('1990/01/01')
    });
</script>
</body>
</html>