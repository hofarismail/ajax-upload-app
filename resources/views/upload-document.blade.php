<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Document</title>

    <style>
        body {
            background-color: gray;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Form Upload Document -->
    <form id="uploadDocumentForm" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".pdf" title="Upload youre document here">
        <button type="submit">Upload</button>
    </form>

    <!-- Display Success or Error Message -->
    <div id="message"></div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Ajax Script -->
    <script>
        $(document).ready(function() {
            $('#uploadDocumentForm').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: '/upload-document',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            $('#message').html('<p style="color:green;">' + response.message +
                                '</p>');
                        } else {
                            $('#message').html('<p style="color:red;">' + response.message +
                                '</p>');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
</body>

</html>
