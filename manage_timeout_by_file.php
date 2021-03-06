<?php
/**
     * @param $file_name
     * @param $timeout
     * @return bool
     * 
     */

public function manage_timeout_by_file($file_name, $timeout){
        @$lastTime = file_get_contents('/var/www/html/project/recursos/uploads/' . $file_name);

        if((time() - @$lastTime) > $timeout){
            file_put_contents('/var/www/html/project/recursos/uploads/' . $file_name, '');
        }

        @$lastTime = file_get_contents('/var/www/html/project/recursos/uploads/' . $file_name);

        if (empty($lastTime)){
            $lastTime = time();
            file_put_contents('/var/www/html/project/recursos/uploads/' . $file_name, $lastTime);
            return true;
        }

        file_put_contents('/var/www/html/project/recursos/uploads/' . $file_name, $lastTime);

        header('HTTP/1.1 500 Internal Server Error');
        exit(0);

        die('Wait...' . ((int)time() - (int)@$lastTime) . ' on ' . $timeout . ' seconds');

    }

?>
