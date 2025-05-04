<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

// * Bikin custom command bang
class UpdateCACertificates extends Command
{
    protected $signature = 'cert:update';
    protected $description = 'Updates the CA certificate bundle for curl/SSL operations';

    public function handle()
    {
        $certPath = storage_path('certs/cacert.pem');
        $certUrl = 'https://curl.se/ca/cacert.pem';

        $this->info('Downloading latest CA certificates from curl.se...');

        // Pastikan direktori ada
        if (!File::exists(dirname($certPath)))
        {
            File::makeDirectory(dirname($certPath), 0755, true);
        }

        try
        {
            // Gunakan HTTP client Laravel untuk mengunduh file
            $response = Http::withOptions([
                'sink' => $certPath,
            ])->get($certUrl);

            if ($response->successful())
            {
                // Setel izin file yang tepat
                chmod($certPath, 0644);

                $this->info('CA certificates updated successfully!');
                $this->info('Path: ' . $certPath);

                // Perbaharui .env jika perlu
                if (env('CURL_CA_BUNDLE') !== $certPath)
                {
                    $this->warn('Make sure your .env file contains:');
                    $this->line('CURL_CA_BUNDLE=' . $certPath);
                }

                return Command::SUCCESS;
            }

            $this->error('Failed to download CA certificates: HTTP error ' . $response->status());
            return Command::FAILURE;
        }
        catch (\Exception $e)
        {
            $this->error('Error updating CA certificates: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
