namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\FetchEasyList::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('fetch:easylist')->daily();
        $schedule->call(function () {
            $controller = new \App\Http\Controllers\AdDomainController(new \App\Services\EasyListParser);
            $controller->store();
        })->daily();
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
