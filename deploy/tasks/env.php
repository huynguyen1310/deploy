<?php

namespace Deployer;

require 'recipe/laravel.php';

task('deploy:update_env', function () {
    upload('.env.{{stage}}', '{{deploy_path}}/shared/.env');
    writeln('Update .env.{{stage}} success!');
});
after('deploy:update_env', 'artisan:config:cache');
