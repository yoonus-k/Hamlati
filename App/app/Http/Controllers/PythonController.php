<?php
namespace App\Http\Controllers;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Routing\Controller as BaseController;

class PythonController extends BaseController
{
    public function index()
    {
        $scriptLocation = base_path('app/Http/Controllers/Python/PythonScript.py');
        $pythonExecutable = 'C:\\Users\\yoonus\\AppData\\Local\\Programs\\Python\\Python312\\python.exe';
        
        // Example data to send
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com'
        ];
        
        // Encode data as JSON
        $jsonData = json_encode($data);
        
        // Escape the JSON string for command line
        $escapedJsonData = escapeshellarg($jsonData);
        
        $args = [$pythonExecutable, $scriptLocation, $escapedJsonData];
        $process = new Process($args);
        
        $process->run();

        // Check for errors
        if (!$process->isSuccessful()) {
            $errorOutput = $process->getErrorOutput();
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();
        $errorOutput = $process->getErrorOutput();

        return response("Output: " . $output . "\nError Output: " . $errorOutput);
    }
}
