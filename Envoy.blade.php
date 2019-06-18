@servers(['web' => 'root@thedm.rocks'])

@task('list', ['on' => 'web'])
    ls -l
@endtask

@setup
    $repository = 'git@github.com:JacksonTakegi/dnd.git';
    $releases_dir = '/dnd-app';
    $app_dir = '/dnd';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
@endsetup

@story('deploy')
    remove_old_repository
    clone_repository
    run_composer
    update_symlinks
    set_clear_cache
    @endstory

    @task('clone_repository')
    echo 'Cloning repository'
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
    cd {{ $new_release_dir }}
    git reset --hard {{ $commit }}
    @endtask

    @task('remove_old_repository')
    echo 'Removing Old Repository'
    cd {{ $releases_dir }}
    rm -rf *
    @endtask

    @task('run_composer')
    echo "Starting deployment ({{ $release }})"
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-scripts -q -o
    @endtask

    @task('update_symlinks')
    echo "Linking storage directory"
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    echo 'Linking .env file'
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

    echo 'Linking current release'
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
@endtask
 
@task('set_clear_cache')
    echo "Setting up cache"
    cd {{ $new_release_dir }}
    chown -R www-data:www-data .
    sudo chmod -R 775 bootstrap/cache/
    php artisan config:cache
    php artisan cache:clear
    php artisan view:cache
    php artisan migrate --seed
    service nginx restart
@endtask


