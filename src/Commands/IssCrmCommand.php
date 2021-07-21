<?php

namespace Bildvitta\IssCrm\Commands;

use Illuminate\Console\Command;

class IssCrmCommand extends Command
{
    public $signature = 'iss-crm';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
