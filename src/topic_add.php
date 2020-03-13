<?php
if (empty(session_id())) {session_start();}
include_once('_functions.php');
$db = openDb();

// echo '<pre>' . var_export($boards, true) . '</pre>';die;

include('_header.php');
include('_nav.php');

$idBoard = (isset($_GET["idBoard"]) ? $_GET["idBoard"] : null);

?>
<div class="container">
    <div class="row">
        <div class="col-12">
        <form action="topic_add_script.php" method="post">
            <div class="form-row">
            
                <div class="form-group col-md-6">
                    <label for="text">Sujet</label>
                    <input type="text" name="title" class="form-control" id="title">
                </div>
            </div>
            <div class="form-group">
                <label for="content">Message</label>
                <textarea name="content" class="form-control" id="content" rows="3"></textarea>
            </div>


            <input type="hidden" name="idBoard" value="<?php echo $idBoard; ?>"> 
            
            <div class="text-center">
            <button type="submit"  class="btn btn-primary mb-2">Ajouter</button>
            </div>
            
        </form>
        </div>
    </div>
</div>

<?php
include("_footer.php");
?>
