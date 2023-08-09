<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment by VietQR</title>
</head>
<body>
<script>
    let axios = require('axios');
    let data = JSON.stringify({
        "bin": "970432",
        "accountNumber": "222777313"
    });

    let config = {
        method: 'post',
        url: 'https://api.vietqr.io/v2/lookup',
        headers: {
            'x-client-id': '<CLIENT_ID_HERE>',
            'x-api-key': '<API_KEY_HERE>',
            'Content-Type': 'application/json',
        },
        data : data
    };

    axios(config)
        .then(function (response) {
            console.log(JSON.stringify(response.data));
        })
        .catch(function (error) {
            console.log(error);
        });
</script>
</body>
</html>
