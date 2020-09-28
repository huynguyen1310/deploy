<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'deploy/utils.php';

// Project name
set('application', 'deploy');

// Project repository
set('repository', 'git@github.com:huynguyen1310/deploy.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts 192.168.10.10
inventory('hosts.yml');

// Tasks
require_all('deploy/tasks/*.php');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'deploy:update_env');
after('deploy:update_env', 'artisan:migrate');

