<?php 
//session_unset();
session_start();
$_SESSION['br'] = $_GET['question'] ?? $_SESSION['br'] ?? 0;
//echo $_POST['question'];
echo $_SESSION['br'];
/** @var $pdo \PDO */
require_once '../database.php';
if($_SESSION['br'] == 0)
{
    $statement = $pdo->prepare('SELECT * FROM pitanje ORDER BY RAND() LIMIT 20');
    $statement->execute();
    $pitanja = $statement->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['pitanja'] = $pitanja;
}
$to = rand(1,4);
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ko Želi Biti Milijunaš?</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="backdrop"></div>
    <div class="modal">
        <?php if($_SESSION['br'] > 13) {?>
        <a href="medalja.php">Čestitke, osvojili ste!</a>
        <?php } else {?>
        <h2>Tačan odgovor!</h2>
        <a href="index.php">Sljedeće Pitanje</a>
        <?php }?>
    </div>
    <div class="modal_incorrect">
        <?php if($_SESSION['br'] >= 10) { ?>
        <h2>Čestitke, osvojili ste 32000 KM!</h2>
        <?php } else if($_SESSION['br'] >= 5) {?>
        <h2>Čestitke, osvojili ste 1000 KM!</h2>
        <?php } else {?>
        <h2>Više sreće drugi put!</h2>
        <?php } ?>
        <a href="index.php">Probajte ispočetka</a>
    </div>

    <h1>Ko Želi Biti Milijunaš?</h1>
    <div id="window">
        <div id="main">
            <p id="question"><?php echo $_SESSION['pitanja'][$_SESSION['br']]['tekst']?></p>
            <div id="answers">
                <form action="" method="post" class="answer">
                    <?php if($to==1) { ?>
                        <input type="hidden" name="odg" value="1">
                        <button name="btn" type="button" onclick="nextQuestion(this.form,<?php echo $_SESSION['br'] ?>)"><?php echo $_SESSION['pitanja'][$_SESSION['br']]['todgovor']?></button>
                    <?php } else {?>
                        <input type="hidden" name="odg" value="0">
                        <button name="btn" type="button" onclick="startOver(this.form)"><?php echo $_SESSION['pitanja'][$_SESSION['br']]['n1odgovor']?></button>
                    <?php }?>
                </form>

                <form action="" method="post" class="answer">
                    <?php if($to==2) { ?>
                        <input type="hidden" name="odg" value="1">
                        <button name="btn" type="button" onclick="nextQuestion(this.form,<?php echo $_SESSION['br'] ?>)"><?php echo $_SESSION['pitanja'][$_SESSION['br']]['todgovor']?></button>
                    <?php } else {?>
                        <input type="hidden" name="odg" value="0">
                        <button name="btn" type="button" onclick="startOver(this.form)"><?php echo $_SESSION['pitanja'][$_SESSION['br']]['n2odgovor']?></button>
                    <?php }?>
                </form>

                <form action="" method="post" class="answer">
                    <?php if($to==3) { ?>
                        <input type="hidden" name="odg" value="1">
                        <button name="btn" type="button" onclick="nextQuestion(this.form,<?php echo $_SESSION['br'] ?>)"><?php echo $_SESSION['pitanja'][$_SESSION['br']]['todgovor']?></button>
                    <?php } else {?>
                        <input type="hidden" name="odg" value="0">
                        <button name="btn" type="button" onclick="startOver(this.form)"><?php echo $_SESSION['pitanja'][$_SESSION['br']]['n3odgovor']?></button>
                    <?php }?>
                </form>

                <form action="" method="post" class="answer">
                    <?php if($to==4) {?>
                        <input type="hidden" name="odg" value="1">
                        <button name="btn" type="button" onclick="nextQuestion(this.form,<?php echo $_SESSION['br'] ?>)"><?php echo $_SESSION['pitanja'][$_SESSION['br']]['todgovor']?></button>
                    <?php } else if($to==3) {?>
                        <input type="hidden" name="odg" value="0">
                        <button name="btn" type="button" onclick="startOver(this.form)"><?php echo $_SESSION['pitanja'][$_SESSION['br']]['n3odgovor']?></button>
                    <?php } else if($to==2) {?>
                        <input type="hidden" name="odg" value="0">
                        <button name="btn" type="button" onclick="startOver(this.form)"><?php echo $_SESSION['pitanja'][$_SESSION['br']]['n2odgovor']?></button>
                    <?php } else if($to==1) {?>
                        <input type="hidden" name="odg" value="0">
                        <button name="btn" type="button" onclick="startOver(this.form)"><?php echo $_SESSION['pitanja'][$_SESSION['br']]['n1odgovor']?></button>
                    <?php }?>
                </form>
            </div>
        </div>
        <div id="prize">
            <p class="g <?php if($_SESSION['br']==14) echo 'c'; ?>">15 1000000KM</p>
            <p class="<?php if($_SESSION['br']==13) echo 'c'; ?>">14 500000KM</p>
            <p class="<?php if($_SESSION['br']==12) echo 'c'; ?>">13 250000KM</p>
            <p class="<?php if($_SESSION['br']==11) echo 'c'; ?>">12 125000KM</p>
            <p class="<?php if($_SESSION['br']==10) echo 'c'; ?>">11 64000KM</p>
            <p class="g <?php if($_SESSION['br']==9) echo 'c'; ?>">10 32000KM</p>
            <p class="<?php if($_SESSION['br']==8) echo 'c'; ?>">9 16000KM</p>
            <p class="<?php if($_SESSION['br']==7) echo 'c'; ?>">8 8000KM</p>
            <p class="<?php if($_SESSION['br']==6) echo 'c'; ?>">7 4000KM</p>
            <p class="<?php if($_SESSION['br']==5) echo 'c'; ?>">6 2000KM</p>
            <p class="g <?php if($_SESSION['br']==4) echo 'c'; ?>">5 1000KM</p>
            <p class="<?php if($_SESSION['br']==3) echo 'c'; ?>">4 500KM</p>
            <p class="<?php if($_SESSION['br']==2) echo 'c'; ?>">3 300KM</p>
            <p class="<?php if($_SESSION['br']==1) echo 'c'; ?>">2 200KM</p>
            <p class="<?php if($_SESSION['br']==0) echo 'c'; ?>">1 100KM</p>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var modal = document.querySelector('.modal');
        var modalIncorrect = document.querySelector('.modal_incorrect');
        var backdrop = document.querySelector('.backdrop');
        /*function checkForm(form){
            if(form.odg.value=="1")
            {
                form.btn.style.backgroundColor = "green";
                backdrop.style.display="block";
                modal.style.display="block";
            }
            else
            {    
                form.btn.style.backgroundColor = "red";
                backdrop.style.display="block";
                modalIncorrect.style.display="block";
            }
        }*/
        function nextQuestion(form, a){
            form.btn.style.backgroundColor = "green";
            backdrop.style.display="block";
            modal.style.display="block";
            a += 1;
            $.ajax({
                url: 'index.php',
                type: "GET",
                data:{question: a},
                success:function() {
                }
            });
        }
        function startOver(form){
            form.btn.style.backgroundColor = "red";
            backdrop.style.display="block";
            modalIncorrect.style.display="block";
            $.ajax({
                url: 'index.php',
                type: "GET",
                data:{question: 0},
                success:function() {
                }
            })
        }
    </script>
</body>
</html>