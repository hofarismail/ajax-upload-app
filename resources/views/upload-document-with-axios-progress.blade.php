<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />

    <style>
    </style>
</head>

<body>
    <div class="container my-4">
        <div class="boxUpload">
            <div class="mb-3">
                <label for="file_1" class="form-label">Choose a file:</label>
                <input type="file" id="file_1" name="file_1" class="file form-control" data-guide="0" />
            </div>
            <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="0"
                aria-valuemin="0" aria-valuemax="100">
                <div class="progressUpload progress-bar progress-bar-striped progress-bar-animated" style="width: 0%">
                </div>
            </div>
            <div class="message form-text"></div>
        </div>

        <div class="boxUpload">
            <div class="mb-3">
                <label for="file_2" class="form-label">Choose a file:</label>
                <input type="file" id="file_2" name="file_2" class="file form-control" data-guide="1" />
            </div>
            <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="0"
                aria-valuemin="0" aria-valuemax="100">
                <div class="progressUpload progress-bar progress-bar-striped progress-bar-animated" style="width: 0%">
                </div>
            </div>
            <div class="message form-text"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            function uploadFile(boxUpload) {
                let fileInput = boxUpload.find('.file')[0];
                let fileInput1 = document.getElementById('file_1');
                let progressUploadBar = boxUpload.find('.progressUpload')[0];
                let messageEl = boxUpload.find('.message');

                console.log(fileInput);
                console.log(fileInput1);
                console.log(progressUploadBar);

                let formData = new FormData();
                formData.append('file', fileInput.files[0]);

                axios.post('/axios-upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: function(progressEvent) {
                        let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent
                            .total);
                        progressUploadBar.style.width = percentCompleted + '%';
                        progressUploadBar.innerHTML = percentCompleted + '%';

                        if (percentCompleted >= 100) {
                            progressUploadBar.classList.remove('progress-bar-animated');
                        }
                    }
                }).then(function(response) {
                    console.log(response.data);

                    if (response.success) {
                        messageEl.html('<p style="color:green;">' + response.message +
                            '</p>');
                    }
                }).catch(function(error) {
                    console.error(error);

                    messageEl.html('<p style="color:red;">' + error.response.data.message +
                        ': ' + error.response.data.errors.file[0] + '</p>');
                });
            }

            $('.file').on('change', function() {
                let parentBox = $(this).closest('.boxUpload');
                // console.log(parentBox);

                uploadFile(parentBox);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        /*!
         * Color mode toggler for Bootstrap's docs (https://getbootstrap.com/)
         * Copyright 2011-2023 The Bootstrap Authors
         * Licensed under the Creative Commons Attribution 3.0 Unported License.
         */

        (() => {
            'use strict'

            const getStoredTheme = () => localStorage.getItem('theme')
            const setStoredTheme = theme => localStorage.setItem('theme', theme)

            const getPreferredTheme = () => {
                const storedTheme = getStoredTheme()
                if (storedTheme) {
                    return storedTheme
                }

                return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
            }

            const setTheme = theme => {
                if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.setAttribute('data-bs-theme', 'dark')
                } else {
                    document.documentElement.setAttribute('data-bs-theme', theme)
                }
            }

            setTheme(getPreferredTheme())

            const showActiveTheme = (theme, focus = false) => {
                const themeSwitcher = document.querySelector('#bd-theme')

                if (!themeSwitcher) {
                    return
                }

                const themeSwitcherText = document.querySelector('#bd-theme-text')
                const activeThemeIcon = document.querySelector('.theme-icon-active use')
                const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')

                document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                    element.classList.remove('active')
                    element.setAttribute('aria-pressed', 'false')
                })

                btnToActive.classList.add('active')
                btnToActive.setAttribute('aria-pressed', 'true')
                activeThemeIcon.setAttribute('href', svgOfActiveBtn)
                const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
                themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

                if (focus) {
                    themeSwitcher.focus()
                }
            }

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                const storedTheme = getStoredTheme()
                if (storedTheme !== 'light' && storedTheme !== 'dark') {
                    setTheme(getPreferredTheme())
                }
            })

            window.addEventListener('DOMContentLoaded', () => {
                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                    .forEach(toggle => {
                        toggle.addEventListener('click', () => {
                            const theme = toggle.getAttribute('data-bs-theme-value')
                            setStoredTheme(theme)
                            setTheme(theme)
                            showActiveTheme(theme, true)
                        })
                    })
            })
        })()
    </script>
</body>

</html>
