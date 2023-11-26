<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <style>
        body {
            background-color: gray;
            color: white;
        }

        .progress-bar {
            width: 100%;
            background-color: #ddd;
            height: 30px;
            position: relative;
        }

        .progress-bar .progress {
            height: 100%;
            background-color: #4caf50;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
</head>

<body>
    <div>
        <label for="file">Choose a file:</label>
        <input type="file" id="file" name="file" onchange="uploadFile()">
    </div>

    <div class="progress-bar">
        <div class="progress" id="progress" style="width: 0;"></div>
    </div>

    <!-- Display Success or Error Message -->
    <div id="message"></div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        function uploadFile() {
            let fileInput = document.getElementById('file');
            let progressBar = document.getElementById('progress');

            let formData = new FormData();
            formData.append('file', fileInput.files[0]);

            axios.post('/axios-upload', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress: function(progressEvent) {
                    let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progressBar.style.width = percentCompleted + '%';
                }
            }).then(function(response) {
                console.log(response.data);

                if (response.success) {
                    $('#message').html('<p style="color:green;">' + response.message +
                        '</p>');
                } else {}
            }).catch(function(error) {
                console.error(error);

                $('#message').html('<p style="color:red;">' + error.response.data.message +
                    ': ' + error.response.data.errors.file[0] + '</p>');
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>
