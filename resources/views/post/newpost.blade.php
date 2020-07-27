<div class="card-body">
    <form method="POST" action="{{ route('add.newpost') }}">
        @csrf

        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title"
                    value="{{ old('title') }}" required autocomplete="title" autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="description"
                class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

            <div class="col-md-6">
                <input id="description" type="description"
                    class="form-control @error('description') is-invalid @enderror" name="description" required
                    autocomplete="current-description">

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="sitelink"
                class="col-md-4 col-form-label text-md-right">{{ __('Sitelink') }}</label>

            <div class="col-md-6">
                <input id="sitelink" type="url" placeholder="https://yoursitetobesaved.com"
                    class="form-control @error('sitelink') is-invalid @enderror" name="sitelink" required
                    autocomplete="current-sitelink">

                @error('sitelink')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Add to my list') }}
                </button>
            </div>
        </div>
    </form>
    <br>
    <form action="/showposts" method="get">
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Show My Links') }}
                </button>
            </div>
        </div>
    </form>

</div>
