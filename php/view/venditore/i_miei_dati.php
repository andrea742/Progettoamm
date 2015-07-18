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
    

    <form method="post" action="cliente/i_miei_dati">
        <input type="hidden" name="cmd" value="indirizzo"/>
        <label for="indirizzo">Telefono</label>
        <input type="text" name="indirizzo" id="via" value="<?= $user->getTelefono() ?>"/>
        <br>
        
        
        
                
        
    </form>
</div>

