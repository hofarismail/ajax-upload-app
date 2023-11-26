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

            let xhr = new XMLHttpRequest();

            xhr.upload.onprogress = function(event) {
                if (event.lengthComputable) {
                    let percentCompleted = (event.loaded / event.total) * 100;
                    progressBar.style.width = percentCompleted + '%';
                }
            };

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);

                        if (response.success) {
                            $('#message').html('<p style="color:green;">' + response.message +
                                '</p>');
                        } else {
                            $('#message').html('<p style="color:red;">' + response.message +
                                '</p>');
                        }
                    } else {
                        console.error('Upload failed.');
                    }
                }
            };

            xhr.open('POST', '/xhr-upload', true);
            xhr.send(formData);
        }
    </script>
</body>

</html>
