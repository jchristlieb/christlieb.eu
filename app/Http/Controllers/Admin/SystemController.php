<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Class SystemController
 * @package App\Http\Controllers\Admin
 */
class SystemController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        $systemInfos = [
            'post_max_size' => ini_get('post_max_size'),
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time'),
            'Timezone' => config('app.timezone'),
            'Web Server' => $_SERVER['SERVER_SOFTWARE'],
            'PHP Version' => phpversion(),
            'Database Connection' => strtoupper(env('DB_CONNECTION', 'mysql')),
            'curl' => (in_array('curl', get_loaded_extensions()) ? 'Supported' : 'Not Supported'),
            'curl Version' => (in_array('curl', get_loaded_extensions()) ? curl_version()['libz_version'] : 'Not Supported'),
            'gd' => (in_array('gd', get_loaded_extensions()) ? 'Supported' : 'Not Supported'),
            'pdo' => (in_array('PDO', get_loaded_extensions()) ? 'Installed' : 'Not Installed'),
            'sqlite' => (in_array('sqlite3', get_loaded_extensions()) ? 'Installed' : 'Not Installed'),
            'openssl' => (in_array('openssl', get_loaded_extensions()) ? 'Installed' : 'Not Installed'),
            'mbstring' => (in_array('mbstring', get_loaded_extensions()) ? 'Installed' : 'Not Installed'),
            'tokenizer' => (in_array('tokenizer', get_loaded_extensions()) ? 'Installed' : 'Not Installed'),
            'zip' => (in_array('zip', get_loaded_extensions()) ? 'Installed' : 'Not Installed'),
        ];
        
        
        return view('admin.system', compact('systemInfos'));
    }
}
