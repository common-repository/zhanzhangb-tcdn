<?php
require_once __DIR__ . '/vendor/autoload.php';

use TencentCloud\Common\Credential;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Profile\HttpProfile;
use TencentCloud\Common\Exception\TencentCloudSDKException;
use TencentCloud\Cdn\V20180606\CdnClient;
use TencentCloud\Cdn\V20180606\Models\PurgeUrlsCacheRequest;
use TencentCloud\Cdn\V20180606\Models\PushUrlsCacheRequest;

function zhanzhangb_tcdn_writeToLog($message) {
    $currentDateTime = date('Y/m/d H:i');
    $logEntry = "[$currentDateTime] $message\n";
    $logFile = __DIR__ . '/debug.log';
    $logContent = file_get_contents($logFile);
    $logContent = $logEntry . $logContent;
    $logContentLines = explode("\n", $logContent);
    $logContentLimited = implode("\n", array_slice($logContentLines, 0, 20));
    file_put_contents($logFile, $logContentLimited);
}

function zhanzhangb_tcdn_refresh($zhanzhangburls) {
    $settings = get_option('zhanzhangb_tcdn_settings');
    $cred = new Credential($settings['secret_id'], $settings['secret_key']);
    $httpProfile = new HttpProfile();
    $httpProfile->setEndpoint("cdn.tencentcloudapi.com");

    $clientProfile = new ClientProfile();
    $clientProfile->setHttpProfile($httpProfile);
    $client = new CdnClient($cred, "", $clientProfile);

    $req = new PurgeUrlsCacheRequest();
    $params = array("Urls" => $zhanzhangburls['refresh']);
    $req->fromJsonString(json_encode($params));

    $resp = $client->PurgeUrlsCache($req);

    $zhanzhangb_tcdn_data = json_decode($resp->toJsonString(), true);
    if (isset($zhanzhangb_tcdn_data['Response']['Error'])) {
        zhanzhangb_tcdn_writeToLog('CDN刷新失败');
    } else {
        $zhanzhangb_tcdn_message = "CDN刷新成功 " . count($zhanzhangburls['refresh']) . " 条URL";
        zhanzhangb_tcdn_writeToLog($zhanzhangb_tcdn_message);
    }

    if (!empty($zhanzhangburls['cache'])) {
        $req = new PushUrlsCacheRequest();
        $params = array("Urls" => $zhanzhangburls['cache']);
        $req->fromJsonString(json_encode($params));
        $resp = $client->PushUrlsCache($req);
    }
}
?>