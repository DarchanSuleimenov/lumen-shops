<?php
/**
 *
 * PHP version >= 7.0
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */

namespace App\Console\Commands;


use App\Shop;

use Exception;
use Illuminate\Console\Command;



/**
 * Class ShopsImportCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class ShopsImportCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "shops:import {filename}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Imports shops data from .csv file";


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $filename = $this->argument('filename');
            $this->info("Имя файла: $filename");
            $handle = fopen($filename, 'r');

            $headers = fgetcsv($handle);
            foreach ($headers as $index => $value) {
                $headers[$index] = mb_strtolower($headers[$index]);
                if ($headers[$index] == "addr") {
                    $headers[$index] = "address";
                }
            }

            $rowNum = 0;
            while (($row = fgetcsv($handle)) !== false) {
                $this->info("[" . (++$rowNum) . "]\t" . implode("\t", $row));
                $shop = new Shop();
                // $shop->save(); //для получения id; но поля не могут быть пустыми
                // $data = Array('id' => $shop->get('id'));
                $data = array();
                foreach ($row as $index => $field) {
                    if (isset($headers[$index])) {
                        $key = $headers[$index];
                        $data[$key] = $field;
                    }
                }
                $this->info(implode($data,"\t\t"));
                $shop->set($data);
                $check = $shop->validate();
                if ($check === true) {
                    $this->info('verification: ok');
                    $shop->save();
                    $this->info('new record saved.');
                } else {
                    $this->info('verification failed:');
                    $this->error($check);
                }
                $this->info('');
            }
            fclose($handle);
        } catch (Exception $e) {
            $this->error("An error occurred:");
            $this->error($e);
        }
    }
}
