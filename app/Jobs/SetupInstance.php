<?php

namespace App\Jobs;

use App\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SetupInstance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $organization;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Organization $organization)
    {
        $this->organization = $organization;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $source = '';
        $dest = '';
        $docker = [];
        $cluster_identifier = $this->organization->identifier;
        $cluster_name = $this->organization->name;
        $email = $this->organization->email;
        $basePath = public_path();
        $port = trim(shell_exec("$basePath/port.sh"));
        $portWithSSL =  trim(shell_exec("$basePath/port.sh"));
        $dest = $basePath .'/'.$cluster_identifier;        
        mkdir ($dest, 0755);
        $docker['version'] = '3';
        $docker['services'] = [
                        'tenant-service' => [
                            'environment' => 
                                [   
                                    'CLUSTER_NAME' => $cluster_name,
                                    'CLUSTER_IDENTIFIER' => $cluster_identifier
                                ],
                            'build' => '.',
                            'container_name' => 'tenant_'.$cluster_identifier,
                            'volumes' => [ '.:/var/www/html/'],
                            'ports' => [ "$port:80", "$portWithSSL:443"],
                            'tty' => true
                        ]
                    ];
        $output = shell_exec("git clone https://github.com/ankitmecis/librarytest.git $dest");
        yaml_emit_file ($dest.'/docker-compose.yml', $docker);        
        shell_exec("cd $dest && docker-compose up -d --build");
        shell_exec("echo 'download' | sudo -S systemctl restart docker && docker restart $(docker ps -a -q)");
        $orgUpdate = Organization::where('_id', $this->organization->id)->first();
        $orgUpdate->status = 'Success';
        $orgUpdate->port = $port;
        $orgUpdate->sslPort = $portWithSSL;
        $orgUpdate->domain = 'localhost';
        $orgUpdate->instance_name = "tenent_$cluster_identifier";
        $orgUpdate->save();
    }
}
