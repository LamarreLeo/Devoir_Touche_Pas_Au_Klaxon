<div class="bg-[#f1f8fc]">
    <div class="flex flex-col items-center justify-center h-[calc(100vh-128px)]">
        <div class="bg-[#384050] text-white w-[400px] p-12 rounded-lg">
            <?php if (!empty($error)) : ?>
                <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif ?>
            <form action="login" method="post" class="flex flex-col gap-6">
                <div class="flex flex-col gap-6">
                    <h3 class="text-2xl font-bold">Connexion</h3>
                    <div class="flex flex-col gap-6">
                        <input 
                            class="bg-white p-2 rounded-lg focus:outline-none text-[#384050] h-12"
                            type="email" 
                            name="email" 
                            id="email" 
                            value="<?= htmlspecialchars($email) ?>" 
                            placeholder="Votre e-mail"
                            required
                        >
                        <input 
                            class="bg-white p-2 rounded-lg focus:outline-none text-[#384050] h-12"
                            type="password" 
                            name="password" 
                            id="password" 
                            placeholder="Votre mot de passe"
                            required
                        >
                    </div>
                </div>
                <button type="submit" class="bg-[#82b864] p-2 rounded-lg h-12">Se connecter</button>
            </form>
        </div>
    </div>
</div>