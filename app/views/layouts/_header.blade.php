<nav class="navbar navbar-expand">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbar">
            <!-- Left links -->
            <ul class="navbar-nav ms-auto mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    @if ($isLogged)
                        <a class="nav-link" href="/logout">Logout</a>
                    @else
                        <a class="nav-link" href="/login">Login</a>
                    @endif
                </li>
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>