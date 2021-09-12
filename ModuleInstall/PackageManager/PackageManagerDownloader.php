<?php


class PackageManagerDownloader
{
    const PACKAGE_MANAGER_DOWNLOAD_SERVER = 'https://depot.dotbcrm.com/depot/';

    const PACKAGE_MANAGER_DOWNLOAD_PAGE = 'download.php';

	/**
	 * Using curl we will download the file from the depot server
	 *
     * @param string $session_id The session_id this file is queued for
     * @param string $file_name The file_name to download
     * @param string $save_dir (optional) If specified it will direct where to save the file once downloaded
     * @param string $download_sever (optional) If specified it will direct the url for the download
	 *
     * @return string The full path of the saved file
	 */
    public static function download($session_id, $file_name, $save_dir = '', $download_server = '')
    {
		if(empty($save_dir)){
			$save_dir = "upload://";
		}
		if(empty($download_server)){
            $download_server = self::PACKAGE_MANAGER_DOWNLOAD_SERVER;
		}
        $download_server .= self::PACKAGE_MANAGER_DOWNLOAD_PAGE;
		$ch = curl_init($download_server . '?filename='. $file_name);
		$fp = dotb_fopen($save_dir . $file_name, 'w');
		curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID='.$session_id. ';');
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
		return $save_dir . $file_name;
	}
}
