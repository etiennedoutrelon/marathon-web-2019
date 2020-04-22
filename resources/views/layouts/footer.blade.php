@auth
    <!-- Footer -->
    <footer class="page-footer font-small unique-color-dark fixed-bottom">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2019-2020 Copyright -
            <a>Reviews</a>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
@endauth
@guest
    <!-- Footer -->
    <footer class="page-footer font-small unique-color-dark pt-4">
        <!-- Footer Elements -->
        <div class="container">
            <!-- Call to action -->
            <ul class="list-unstyled list-inline text-center py-2">
                <li class="list-inline-item">
                    <h5 class="mb-1">Inscrivez-vous !</h5>
                </li>
                <li class="list-inline-item">
                    <a href="{{route('register')}}" class="btn btn-outline-white btn-rounded">Inscription</a>
                </li>
            </ul>
            <!-- Call to action -->

        </div>
        <!-- Footer Elements -->

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2019-2020 Copyright -
            <a>Reviews</a>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
@endguest
