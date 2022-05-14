<?php

use Google\Client;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return "Bonjour";
});

Route::get('/drive',function(){
    $client = new Client();
    $client->setClientId('143778355944-jvkthq9bgqotms71iolfeue96a16iaro.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://localhost/google-drive/callback');
    $client->addScope([
        "https://www.googleapis.com/auth/drive",
        "https://www.googleapis.com/auth/drive.file"
    ]);
    $url=$client->createAuthUrl();
    return redirect($url);

});

Route::get('/google-drive/callback', function () {
    $client = new Client();
    $client->setClientId('143778355944-jvkthq9bgqotms71iolfeue96a16iaro.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://localhost/google-drive/callback');
    $code = request('code');
    $access_token = $client->fetchAccessTokenWithAuthCode($code);
    return $access_token;
});

Route::get('upload', function () {
    $client = new Client();
    $access_token = 'ya29.A0ARrdaM9DH6S5fCynMGs--nxdgyh5hkHfQJ0bdfkRVt4mwxXbbjNjuCcsWxDyA0bfH5Cwsg0GTFxZH-KwzDp65xHmyD49QNYQDHYb5KYeaZSua_Eg5xhAjVHQzSwkENYwiGCtuGZVihQYktGHh8gvVOKzDMJZ';

    $client->setAccessToken($access_token);
    $service = new Google\Service\Drive($client);
    $file = new Google\Service\Drive\DriveFile();

    DEFINE("TESTFILE", 'testfile-small.txt');
    if (!file_exists(TESTFILE)) {
        $fh = fopen(TESTFILE, 'w');
        fseek($fh, 1024 * 1024);
        fwrite($fh, "!", 1);
        fclose($fh);
    }

    $file->setName("Hello World!");
    $service->files->create(
        $file,
        array(
            'data' => file_get_contents(TESTFILE),
            'mimeType' => 'application/octet-stream',
            'uploadType' => 'multipart'
        )
    );
});