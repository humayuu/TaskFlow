<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Forbidden</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
        }

        .error-icon svg {
            opacity: 0.85;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="text-center">
            <div class="error-icon mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="#dc3545" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14Zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16Z" />
                    <path d="M11.354 4.646a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708l6-6a.5.5 0 0 1 .708 0Z" />
                    <path d="M4.646 4.646a.5.5 0 0 0 0 .708l6 6a.5.5 0 0 0 .708-.708l-6-6a.5.5 0 0 0-.708 0Z" />
                </svg>
            </div>

            <h1 class="display-1 fw-bold text-danger">403</h1>
            <h2 class="mb-3">Access Forbidden</h2>
            <p class="text-muted mb-4 col-md-8 mx-auto">
                Sorry, you don't have permission to access this page. This area is
                restricted based on your account role. If you think this is a mistake,
                please contact your administrator.
            </p>

            <div class="d-flex justify-content-center gap-3">
                <a href="javascript:history.back()" class="btn btn-outline-secondary px-4">
                    Go Back
                </a>
                <a href="javascript:history.back()" class="btn btn-primary px-4">
                    Return to Dashboard
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
