<div>
    <div class="flex flex-col items-center justify-center h-[calc(100vh-6vh)]">
        <div class="bg-[#0074C7] text-white w-[400px] p-6 rounded-lg">
            <?php if (!empty($error)) : ?>
                <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif ?>
            <form action="/login" method="post" class="flex flex-col gap-10">
                <div class="flex flex-col gap-6">
                    <div class="flex flex-col gap-4">
                        <label for="email">E-mail :</label>
                        <input 
                            class="bg-[#F1F8FC] p-2 rounded-lg focus:outline-none text-[#384050]"
                            type="email" 
                            name="email" 
                            id="email" 
                            value="<?= htmlspecialchars($email) ?>" 
                            placeholder="Votre e-mail"
                            required
                        >
                    </div>

                    <div class="flex flex-col gap-4">
                        <label for="password">Mot de passe :</label>
                        <input 
                            class="bg-[#F1F8FC] p-2 rounded-lg focus:outline-none text-[#384050]"
                            type="password" 
                            name="password" 
                            id="password" 
                            placeholder="Votre mot de passe"
                            required
                        >
                    </div>
                </div>
                <button type="submit" class="bg-[#82b864] p-2 rounded-lg">Se connecter</button>
            </form>
        </div>
    </div>
</div>