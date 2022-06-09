<?php $title = "Accueil"; ?>

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
</main>

<?php $content = ob_get_clean(); ?>


<?php require('layout.php') ?>
