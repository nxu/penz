<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;

class ShowEntryUrl extends Command
{
    protected $signature = 'show-entry-url {userId}';

    protected $description = 'Displays the signed entry URL for a given user ID.';

    public function handle(): int
    {
        $this->output->writeln(URL::signedRoute('entry.form', ['user' => $this->argument('userId')]));

        return self::SUCCESS;
    }
}
