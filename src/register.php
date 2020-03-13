<?php
include('_header.php');
include('_nav.php');
?>

<div class="container">
    <div class="row">
        <div class="col-12">
        <form action="register_script.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nickname">Pseudo</label>
                    <input type="text" name="nickname" class="form-control" id="nickname">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>
        </div>
    </div>
</div>

<?php
include('_footer.php');
?>