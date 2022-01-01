<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="/styles/index.css">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?= $this->include('layout/nav') ?>
    <div class="w-full h-screen p-8">
        <?= $this->renderSection("content") ?>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#image')
            const imagePreview = document.querySelector(".img-preview")

            const fileCover = new FileReader()
            fileCover.readAsDataURL(image.files[0])

            fileCover.onload = function(e) {
                imagePreview.src = e.target.result
            }
        }
    </script>
</body>

</html>