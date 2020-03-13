<?php
if (empty(session_id())) {session_start();}

include('_header.php');
include('_nav.php');
include_once('_functions.php');

checkAccessUser();

$db = openDb();
$req = $db->prepare('SELECT * FROM users WHERE email = :email');
$req->execute(array(
    'email' =>$_SESSION["email"]
));
// echo '<pre>' . var_export($req->fetch(), true) . '</pre>';die;
$userData = $req->fetch();


?>
<div class="container">
    <div class="row">
        <div class="col-12">
        <img src="https://www.gravatar.com/avatar/<?php echo $userData["avatar"]?>" alt="">
        <form action="profile_script.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nickname">Pseudo</label>
                    <input type="text" name="nickname" class="form-control" id="nickname" value="<?php echo $userData["nickname"];?>">
                </div>
            
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
            </div>
            <div class="form-group">
                <label for="signature">Signature</label>
                <textarea name="signature" class="form-control" id="signature" rows="3"> <?php echo $userData["signature"]; ?> </textarea>
            </div>


            <!-- <input type="hidden" value="
            <?php 
            // echo $userData["id"]
             ?>
            "> -->


            <div class="text-center">
            <button type="submit"  class="btn btn-primary mb-2">Modifier</button>
            </div>
            
        </form>
        </div>
    </div>
</div>
<?php
include('_footer.php');
?>