<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Jmrashed\Zkteco\Lib\ZKTeco;

class ZKTecoService
{
    protected $ip;
    protected $port;

    public function __construct()
    {
        // $this->ip = Session::get('zkteco_ip', '127.0.0.1'); // Default to localhost if not set
        // $this->port = 4370; // Set your default port
    }

    public function connect()
    {
        $zk = new ZKTeco('192.168.1.201', 4370);
        return $zk;
    }

    public function disconnect($socket)
    {
        socket_close($socket);
    }

    public function retrieveAttendanceLogs()
    {
        $socket = $this->connect();
        if (!$socket) {
            return false;
        }

        $zk = new ZKTeco('192.168.1.201', 4370);

        return $users = $zk->getUser();
    
        
        // Step 3: Close the connection
        $this->disconnect($socket);
    
        // Step 4: Parse the data
        // return $this->parseAttendanceData($response);
    }

    private function prepareCommandForLogs()
    {
        // CMD_GET_ATT_LOGS (0x52) command for retrieving attendance logs
    $command_id = 0x52;  // Command ID for getting logs
    $session_id = 0x00;  // Initial session ID
    $reply_id = 0x00;    // Initial reply ID

    // Packet structure (for ZKTeco K40)
    // May require adjustment based on specific protocol or SDK
    $command_packet = pack('C*', $command_id, 0x00, $session_id, $reply_id);

    return $command_packet;
    }

    private function parseAttendanceData($response)
    {
        $parsedData = [];
    
        // Assuming each log entry is 16 bytes long (this is just an assumption based on some models)
        $logEntryLength = 16;
        $responseLength = strlen($response);
    
        for ($i = 0; $i < $responseLength; $i += $logEntryLength) {
            // Extract a single log entry (16 bytes)
            $logEntry = substr($response, $i, $logEntryLength);
    
            // Parse the log entry (this is an example structure and will depend on your device's protocol)
            $userId = unpack('N', substr($logEntry, 0, 4))[1];  // First 4 bytes: User ID
            $timestamp = unpack('N', substr($logEntry, 4, 4))[1];  // Next 4 bytes: Timestamp
            $status = ord($logEntry[8]);  // Next byte: Status (e.g., check-in, check-out)
    
            // Convert timestamp from Unix timestamp to readable format
            $dateTime = date('Y-m-d H:i:s', $timestamp);
    
            // Store parsed data
            $parsedData[] = [
                'user_id' => $userId,
                'timestamp' => $dateTime,
                'status' => $status,
            ];
        }
    
        return $parsedData;
    }

    private function prepareCommandForPing()
{
    // CMD_PING (0x40) - Basic connection test
    return "\x40\x00\x00\x00\x00\x00\x00\x00";  // CMD_PING
}

    
}
