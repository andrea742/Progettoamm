<div id ="logout">
    <p>Tipo : Cliente - <?= $user->getNome().' '.$user->getCognome() ?></p>
    <p class="logout">
        <a href="cliente?cmd=logout">Logout</a>
    </p>
</div>