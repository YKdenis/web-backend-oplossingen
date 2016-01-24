<!--
    Note: The $errors variable is available in every Laravel view.
    It will simply be an empty instance of ViewErrorBag if no validation errors are present.
-->

@if (count($errors) > 0)
        <!-- Form Error List -->
        @foreach ($errors->all() as $error)
            <p style="color: red;">{{ $error }}</p>
        @endforeach
@endif