<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/nxu/penz.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('penz.nxu.hu')
    ->set('remote_user', 'penz')
    ->set('deploy_path', '/var/www/penz')
    ->set('http_user', 'penz');

// Hooks
after('deploy:failed', 'deploy:unlock');

after('deploy:vendors', function () {
    run('cd {{release_or_current_path}} && /home/penz/.bun/bin/bun install');
    run('cd {{release_or_current_path}} && /home/penz/.bun/bin/bun run build');
});

after('deploy:symlink', 'artisan:queue:restart');
