@servers(['aws'=> '-i "lokklkey.pem" ubuntu@13.52.124.68 ', 'localhost' => '127.0.0.1'])
{{-- https://bosnadev.com/2015/01/07/brief-introduction-laravel-envoy/
    alias envoy="~/.config/composer/vendor/bin/envoy" --}}


@include('vendor/autoload.php');


@setup
$origin = 'git@github.com:gusLopezC/LOKKL_BackendLaravelAPI';
$branch = isset($branch) ? $branch : "master";
$app_dir = '/var/www/html/LOKKL_BackendLaravelAPI/'
@endsetup

@task('test', ['on' => 'localhost'])
echo 'Tarea test ejecutada';
@endtask

@task('foo', ['on' => 'aws'])
cd {{ $app_dir}}
ls -la
@endtask

@task('git:clone', ['on' => 'aws'])
cd {{ $app_dir}}
echo "Hemos entrado al directorio /var/www/html";
git clone {{ $origin}}
echo "Se a clonado el repositorio correctamente"
@endtask

@task('git:pull', ['on' => 'aws'])
cd {{ $app_dir}}
echo "Hemos entrado al directorio /var/www/html";
git pull origin {{ $branch}}
echo "Se a bajado el codigo correctamente"
@endtask


@task('migrate', ['on' => 'aws'])
cd {{ $app_dir}}
php artisan migrate
@endtask