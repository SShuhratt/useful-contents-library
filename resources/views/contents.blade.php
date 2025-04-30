<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Content Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Content Hub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/authors">Authors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/genres">Genres</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        @foreach($contents as $content)
            <div class="col-4 mb-3 p-3 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$content->title}}</h5>
                        <p class="card-text">{{$content->description}}</p>
                        <a href="/contents/{{$content->id}}" class="btn btn-primary">Open</a>

                        {{-- Add the Delete button --}}
                        <form action="{{ route('contents.destroy', $content->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this?')">
                                Delete
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

