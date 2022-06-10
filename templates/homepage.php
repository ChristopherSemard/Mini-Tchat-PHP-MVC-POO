<?php $title = "MiniTchat"; ?>



<?php ob_start(); ?>

    <h2 class="text-center h-10">TCHAT</h2>
    <div id="messages-list" class="scroll h-80">
            <?php
                if(count($messages) == 0){
                    echo "<p class='text-center'>Aucun message</p>";
                }
                else{
                    $messages = array_reverse($messages);
                    foreach ($messages as $key => $message) {
                        echo '<div class="message bg-dark d-flex p-2 my-2" style="border-bottom : 2px solid ' .$message->color.'">
                                    <p class="my-auto"><span style=" color:' .$message->color. '">' .$message->pseudo. '</span> - ' .$message->date. '<br> ' .$message->text. '</p>
                                </div>';
                    }
                }
            ?>
    </div>


    <?php if (isset($_SESSION['LOGGED_USER'])): ?>
        <form class="container mt-auto h-10 d-flex align-items-end" method="POST" action="../index.php?action=submitmessage">
            <div class="row  w-100">
                <div class="form-group col-10">
                    <input type="text" class="form-control" id="inputMessage" name="message" placeholder="Message">
                </div>
                <button type="submit" class="btn btn-primary col-2"><i class="bi bi-send-fill"></i></button>
            </div>
        </form> 
    <?php endif ?>
    
    <?php if (!isset($_SESSION['LOGGED_USER'])): ?>
        <form class="container mt-auto h-10 d-flex align-items-end" method="POST" action="../index.php?action=submitmessage">
                <div class="row  w-100">
                    <div class="form-group col-10">
                        <input type="text" class="form-control" id="inputMessage" name="message" placeholder="Connectez vous pour pouvoir écrire" disabled>
                    </div>
                    <button type="submit" class="btn btn-primary col-2" disabled><i class="bi bi-send-fill"></i></button>
                </div>
            </form>
    <?php endif ?>



<?php $content = ob_get_clean(); ?>


<?php require('layout.php') ?>
