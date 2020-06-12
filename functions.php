<?php
    function save_ticket()
    {
        print_r($_POST);

        $ch = curl_init();
        $oauthtoken_dept = "";  //Get the oauth token using the api "https://accounts.zoho.com/oauth/v2/token" passing the client id client secret etc.
        $authorization = 'Authorization: Zoho-oauthtoken '.trim($oauthtoken_dept);
        $orgid = 'orgId:2389290';
        $header = [
                        'Content-Type: application/json',
                        $authorization,
                        $orgid
        ];

        $data = array(
            'subject' => $_POST['subject'],
            'departmentId' => $_POST['department'],
            'contactId' => $_POST['contact_id'],
            'uploads' => $_POST['uploads'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'description' => $_POST['description'],
            'priority' => $_POST['priority'],

        );
        $postdata = json_encode($data);
        curl_setopt($ch, CURLOPT_URL,"https://desk.zoho.com/api/v1/tickets");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);
        print_r($server_output);
        echo 'HIEEE';
        // Further processing ...
        if ($server_output == "OK") {
            echo "SUCESS";
        }else{
            echo "ERROR";
        }


    } 
?>