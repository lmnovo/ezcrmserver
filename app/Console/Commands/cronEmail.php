<?php

namespace App\Console\Commands;

use App\Mail\TaskReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendEmail:TaskSchedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía emails con las tareas automatizadas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Gestiona el envío automático de emails a los usuarios que cumplen años de edad
        $tasks_auto = DB::table('eazy_tasks')->get();
        $to = [];
        $object = null;

        foreach ($tasks_auto as $task) {
            $task_actual = $task->updated_at;
            $actual_date = Carbon::now(config('app.timezone'));

            if (!empty($task_actual)) {
                $task_actual = Carbon::createFromFormat("Y-m-d", $task_actual);

                //Confirmar si la tarea actual tiene recordatorio para hoy
                if ($task_actual->isBirthday()) {
                    //Obtengo los datos del Lead o Client asociado al Task actual
                    $lead_or_client = $task->type;

                    if ($lead_or_client == "leads" || $lead_or_client == "clients") {
                        //Obtengo los datos del Lead o Client
                        $lead = DB::table('leads')->where('id',$task->assign_to_id)->first();
                        $object = $lead->email;
                    }

                    $to[] = $object;

                    //Envio los emails con los recordatorios de las tasks
                    Mail::to($to)->send(new TaskReminder($task));
                }

            }
        }

    }
}
