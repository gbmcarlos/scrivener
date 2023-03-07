<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <script src="{{asset('js/core.js')}}"></script>
    <script src="{{asset('js/book.js')}}"></script>
</head>
<body onload="Core.init();">

<div class="container-fluid d-flex h-100">
    <div class="row">

        <div class="col-6">
            <button id="open-file-button-0">Open</button>
            <button id="save-file-button-0">Save</button>
            <label>Paragraph Count: </label>
            <label id="block-count-label-0"></label>
            <div id="editor-container-0" class="editor-container"></div>
        </div>

        <div class="col-6">
            <button id="open-file-button-1">Open</button>
            <button id="save-file-button-1">Save</button>
            <label>Paragraph Count: </label>
            <label id="block-count-label-1"></label>
            <div id="editor-container-1" class="editor-container"></div>
        </div>

        <div class="modal fade" id="chapters-modal" tabindex="-1" aria-labelledby="chapters-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <select class="form-select" id="chapters-list">
                            <option value="" disabled selected>Choose a Chapter</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>