<!DOCTYPE html>
<html>
    <head>
        <script src="jquery3.6.3.min.js"></script>
        <style>
            #redirect-to-user-endpoint {
                visibility: hidden;
                position: absolute;
                left: -1000;
                top: -1000;
            }
        </style>
    </head>
    <body>
        <?php
        // This is a fictional one click upgrade endpoint.
        // Its purpose is to check if license key is valid, and provide url to download duplicator-pro.zip.
        // You need to place the duplicator-pro.zip file in this folder (it's gitignored).

        /*
        // Here we receive the following data. We can use it the same way as wpforms endpoint does:
        // var_dump($_REQUEST); exit;        
        $_REQUEST["oth"];
        $_REQUEST["key"];
        $_REQUEST["v"];
        $_REQUEST["version"];
        $_REQUEST["redirect"];
        $_REQUEST["endpoint"];
        $_REQUEST["siteurl"];
        $_REQUEST["homeurl"];
        */

        // Based on data above that is received, and customer data from this endpoint's database
        // we need to conclude if license is valid!
        //   If not valid, we display an error message.
        //   If it's valid, we do client-side hidden form POST submit to customer's endpoint with oth and url

        // Simulate what happens when license key is valid (set to true), or invalid (set to false)
        $keyOK = true;

        // Let say this is the full url from where duplicator-pro.zip can be downloaded
        $url   = "http://localhost/duplicator_upgrade_endpoint/duplicator-pro.zip";

        if (!$keyOK) {
            print("ERROR: Your license key is invalid!");
            exit;
        }

        // Here we know that license key is OK, so we do client-side
        // hidden form POST submit to customer's endpoint, and we provide oth and url
        ?>

        <!-- An absolute position placed invisible form element which is out of browser window -->
        <form action="placeholder_will_be_replaced" method="post" id="redirect-to-user-endpoint">
            <input type="hidden" name="action" id="form-ajax-action" value="">
            <input type="hidden" name="oth" id="form-oth" value="">
            <input type="hidden" name="url" id="form-url" value="">
        </form>

        <script type="text/javascript">
            $("#redirect-to-user-endpoint").attr("action", "<?php print $_REQUEST["endpoint"]; ?>");
            $("#form-ajax-action").attr("value", "duplicator_one_click_upgrade");
            $("#form-oth").attr("value", "<?php print $_REQUEST["oth"]; ?>");
            $("#form-url").attr("value", "<?php print $url; ?>");
            $("#redirect-to-user-endpoint").submit();
        </script>
    </body>
</html>