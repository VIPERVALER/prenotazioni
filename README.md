1. composer install --optimize-autoloader --no-dev
<br/><br/>
2. copiare il file .env.example e rinominarlo in .env
<br/><br/>
3. configurare il file .env con questi valori
<br/>
APP_KEY=base64:LMoD37obpIGUEhu7xee+Vf0ZQWZBe7rvi3C9YW2Lm9c=
<br/>
APP_DEBUG=false
<br/><br/>
4. php artisan migrate
<br/><br/>
5. eseguire le query
<br/>
INSERT INTO `teams` (`id`, `user_id`, `name`, `personal_team`, `created_at`, `updated_at`) VALUES (1, 1, 'test', 1, '2022-09-22 19:21:00', '2022-09-22 19:21:00');
<br/>
INSERT INTO `team_user` (`id`, `team_id`, `user_id`, `role`, `created_at`, `updated_at`) VALUES (1, 1, 1, 'admin', '2022-09-22 19:21:00', '2022-09-22 19:21:00');
<br/>
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES (1, 'Test', 'test@test.it', '2022-09-22 19:21:00', '$2y$10$HBoWc7AKOAT4Y.akYBSWGuHTZh6BOacnwwHkfgUIdH2.OsukQRotG', NULL, NULL, NULL, 1, NULL, '2022-09-22 19:21:00', '2022-09-22 17:31:45');
<br/><br/>
6. la password di accesso è 'password'
