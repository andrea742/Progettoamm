<div>
    <br>
    <br>
    <h2>I tuoi dati:</h2>
    <br>

    <strong>Nome:</strong> <?= $user->getNome() ?>
    <br><br>
    <strong>Cognome:</strong> <?= $user->getCognome() ?>
    <br>

</div>

<div class="input-form">
    <h3>Indirizzo</h3>

    <form method="post" action="cliente/i_miei_dati">
        <input type="hidden" name="cmd" value="indirizzo"/>
        <label for="indirizzo">Telefono</label>
        <input type="text" name="indirizzo" id="via" value="<?= $user->getTelefono() ?>"/>
        <br>
        
        
        
                
        <input type="submit" value="Salva"/>
    </form>
</div>

<div class="input-form">
    <h3>Password</h3>
    <form method="post" action="cliente/i_miei_dati">
        <input type="hidden" name="cmd" value="password"/>
        <label for="pass1">Nuova Password</label>
        <input type="password" name="pass1" id="pass1"/>
        <br/>
        <label for="pass2">Conferma</label>
        <input type="password" name="pass2" id="pass2"/>
        <br/>
        <input type="submit" value="Cambia"/>
    </form>
</div>