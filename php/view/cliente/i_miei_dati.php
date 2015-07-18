<div>
    <h2><p><p><p>I tuoi dati:</h2>
<ul>
    <li><strong>Nome:</strong> <?= $user->getNome() ?></li>
    <li><strong>Cognome:</strong> <?= $user->getCognome() ?></li>
</ul>
</div>

<div class="input-form">
    <h3>Indirizzo</h3>

    <form method="post" action="cliente/i_miei_dati">
        <input type="hidden" name="cmd" value="indirizzo"/>
        <label for="indirizzo">Indirizzo</label>
        <input type="text" name="indirizzo" id="via" value="<?= $user->getIndirizzo() ?>"/>
        <br>
        <label for="citta">Citta</label>
        <input type="text" name="indirizzo" id="via" value="<?= $user->getCitta() ?>"/>
        <br>
        <label for="mail">Indirizzo mail</label>
        <input type="text" name="mail" id="via" value="<?= $user->getMail() ?>"/>
        <br>
        <br/>
        
        <br/>        
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