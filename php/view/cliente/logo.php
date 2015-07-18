<div id ="logout">
    <p>BENVENUTO <?= $user->getNome().' '.$user->getCognome() ?> Non sei tu? </p>
    <p class="logout">
        <a href="cliente?cmd=logout">Logout</a>
    </p>
</div>