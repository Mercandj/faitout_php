<?php
    // Put your device token here (without spaces):
    $deviceToken = 'fa87fd52404d5f6cb8c3049f487059f6e62232c8c8a132b385abcfa848f86ac4';
    
    // Put your private key's passphrase here:
    $passphrase = '84497012app';
    
    // Put your alert message here:
    $message = 'A push notification has been sent!';
    
    ////////////////////////////////////////////////////////////////////////////////
    
    $ctx = stream_context_create();
    stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
    
    // Open a connection to the APNS server
    $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
    
    if (!$fp)
    exit("Failed to connect: $err $errstr" . PHP_EOL);
    
    echo 'Connected to APNS' . PHP_EOL;
    
    // Create the payload body
    $body['aps'] = array(
                         'alert' => array(
                                          'body' => $message,
                                          'action-loc-key' => 'Bango App',
                                          ),
                         'badge' => 2,
                         'sound' => 'oven.caf',
                         );
    
    // Encode the payload as JSON
    $payload = json_encode($body);
    
    // Build the binary notification
    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
    
    // Send it to the server
    $result = fwrite($fp, $msg, strlen($msg));
    
    if (!$result)
    echo 'Message not delivered' . PHP_EOL;
    else
    echo 'Message successfully delivered' . PHP_EOL;
    
    // Close the connection to the server
    fclose($fp);
    
?>