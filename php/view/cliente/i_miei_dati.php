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
        <label for="indirizzo">Indirizzo</label>
        <input type="text" name="indirizzo" id="via" value="<?= $user->getIndirizzo() ?>"/>
        <br>
        <label for="citta">Citta</label>
        <input type="text" name="indirizzo" id="via" value="<?= $user->getCitta() ?>"/>
        <br>
        <label for="mail">Indirizzo mail</label>
        <input type="text" name="mail" id="via" value="<?= $user->getMail() ?>"/>
        <br>
        
        
                
        
    </form>
</div>

