<?php
  include("layout.php");
  
?>
<?php
    /*
    * get parameters
    */
    if (isset($_GET['sys'])) $nSys=$_GET['sys'];
    else $nSys="";
    if (isset($_GET['group'])) $nGroup=$_GET['group'];
    else $nGroup="";
    if (isset($_GET['switch'])) $nSwitch=$_GET['switch'];
    else $nSwitch="";
    if (isset($_GET['action'])) $nAction=$_GET['action'];
    else $nAction="";
    if (isset($_GET['delay'])) $nDelay=$_GET['delay'];
    else $nDelay=0;
    /*
    * actually send to the daemon
    * then reload the webpage without parameters
    * except for delay
    */
    $output = $nSys.$nGroup.$nSwitch.$nAction.$nDelay;
    if (strlen($output) >= 5) {
      $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
      socket_bind($socket, $source) or die("Could not bind to socket\n");
      socket_connect($socket, $target, $port) or die("Could not connect to socket\n");
      socket_write($socket, $output, strlen ($output)) or die("Could not write output\n");
      socket_close($socket);
      header("Location: index.php?delay=$nDelay");
    }
    /*
    * table containing all configured sockets
    */
    foreach($config as $current) {
      if ($current != "") {
        $iSys = "1";
        $ig = "11011";
        $is = "16";


        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
        socket_bind($socket, $source) or die("Could not bind to socket\n");
        socket_connect($socket, $target, $port) or die("Could not connect to socket\n");

        $output = $iSys.$ig.$is."2";
        socket_write($socket, $output, strlen ($output)) or die("Could not write output\n");
        $state = socket_read($socket, 2048);
        if ($state == 0) {
          $color=" BGCOLOR=\"#009000\"";
          $ia = 1;
          $direction="an";
        }
        if ($state == 1) {
          $color=" BGCOLOR=\"#00C000\"";
          $ia = 0;
          $direction="aus";
        }
?>
    <button id="show-dialog" type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Schalte die LEDs 
      <?=$direction?>
    </button>
    <dialog class="mdl-dialog">
      <h4 class="mdl-dialog__title">Willst du die LEDS
        <?=$direction?>schalten</h4>
      <div class="mdl-dialog__content">
      </div>
      <div class="mdl-dialog__actions">
        <?php
                echo "<A CLASS=\"".$direction."\" HREF=\"?group=".$ig;
                echo "&sys=".$iSys;
                echo "&switch=".$is;
                echo "&action=".$ia;
                echo "&delay=".$nDelay."\" >";
                ?>
          <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
            LEDS
            <?=$direction?>
          </button>
            <?php
                echo "</A>";
                socket_close($socket);

              }
            }
            ?>
            <button type="button" class="mdl-button close">Nein</button>
      </div>
    </dialog>
    <script>
      var dialog = document.querySelector('dialog');
      var showDialogButton = document.querySelector('#show-dialog');
      if (!dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
      }
      showDialogButton.addEventListener('click', function () {
        dialog.showModal();
      });
      dialog.querySelector('.close').addEventListener('click', function () {
        dialog.close();
      });
    </script>
</div>
<link rel="stylesheet" href="styles.css">
                    <div id="RGBsteuerung">
                    
                        <style>
                        .mdl-button{
                            margin:5px;
                        }
                        </style>
                        <div style="width:50%">
                            <form action="index.php" method="get" id="schieber" >
                                BLAU
                                <input type="range" class="mdl-slider mdl-js-slider" name="ROT" value="0" min="0" max="255" step="5"> GR&Uuml;N
                                <input type="range" class="mdl-slider mdl-js-slider" name="GRUEN" value="0" min="0" max="255" step="5"> ROT
                                <input type="range" class="mdl-slider mdl-js-slider" name="BLAU" value="0" min="0" max="255" step="5">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">Senden</button>
                            </form>
                            <br>
                        </div>
                        <div style="width:50%">
                            <form action="index.php" method="get">
                                <input type="hidden" value="0" name="BLAU">
                                <input type="hidden" value="0" name="GRUEN">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="255" name="ROT" >BLAU</button>
                            </form>
                            <br>
                            <form action="index.php" method="get">
                                <input type="hidden" value="0" name="BLAU">
                                <input type="hidden" value="0" name="ROT">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="255" name="GRUEN" >Gr&uuml;n</button>
                            </form>
                            <br>
                            <form action="index.php" method="get">
                                <input type="hidden" value="0" name="ROT">
                                <input type="hidden" value="0" name="GRUEN">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="255" name="BLAU" >ROT</button>
                            </form>
                            <!-- <form action="index.php" method="get">
                                LILA
                                <input type="hidden" value="255" name="ROT">
                                <input type="hidden" value="0" name="GRUEN">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" value="255" name="PINK" >LILA</button>
                            </form> -->
                        </div>
                        <br>
                        <div id="zeile">
                            <form action="index.php" method="get">
                                <input type="range" class="mdl-slider mdl-js-slider" name="WEISS" value="0" min="0" max="255" step="5">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">Weiß</button>
                            </form>
                        </div>
                        <!-- <div id="zeile">
                            <form action="index.php" method="GET">
                                <p>Regenbogen</p>
                                <button type="submit" name="rainbow" value="true">Start</button>
                                <button type="submit" name="rainbow" value="false">Stop</button>
                            </form>
                        </div> -->

                        <?php
                            if(isset($_GET['rainbow']))
                            {
                            $rainbow = $_POST['GET'];
                            if($rainbow == "true"){
                                exec("python3 rainbow.py");
                            }
                            if($rainbow == "false"){
                                exec("python3 stoprainbow.py");
                            }
                            }
                            if(isset($_GET['ROT']))
                            {
                            $rot = $_GET['ROT'];
                            }
                            if(isset($_GET['GRUEN']))
                            {
                            $gruen = $_GET['GRUEN'];
                            }
                            if(isset($_GET['BLAU']))
                            {
                            $blau = $_GET['BLAU'];
                            }
                            shell_exec("pigs p 20 $rot");
                            shell_exec("pigs p 21 $blau");
                            shell_exec("pigs p 16 $gruen");
                            if(isset($_GET['WEISS']))
                            {
                            $weiss = $_GET['WEISS'];
                            shell_exec("pigs p 20 $weiss");
                            shell_exec("pigs p 21 $weiss");
                            shell_exec("pigs p 16 $weiss");
                            }
                        ?>
                    </div>
                    <br>
                    <div id="Lüftersteuerung">
                        <style>
                        .demo-card-square.mdl-card {
                        width: 320px;
                        height: 190px;
                        }
                        .demo-card-square > .mdl-card__title {
                        color: #fff;    
                        background:
                            url('172-200.png') right 15% no-repeat #1A237E;
                        }
                        form{
                            display:inline;
                        }
                        .mdl-layout__content{
                            padding:20px;
                        }
                        
                        </style>

                        <div class="demo-card-square mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-card--expand">
                            <h2 class="mdl-card__title-text">Lüfter</h2>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <form action="index.php" method="get" id="0">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="0" name="FAN" type="submit">0%</button>
                            </form>
                            <form  action="index.php" method="get" id="50">
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="50" name="FAN" type="submit">50%</button>
                            </form>
                            <form action="index.php" method="get" id="100">
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="100" name="FAN" type="submit">100%</button>
                            </form>
                        </div>
</div>
                        <?php
                            if (isset($_GET['FAN'])){
                                $FAN = $_GET['FAN'];
                                //print_r($FAN);
                                echo('<br>');
                                $shellcmd = '/usr/bin/python3 /var/www/html/fan.py ' .$FAN;
                                //print_r($shellcmd);
                                shell_exec($shellcmd);
                            }
                        ?>
                    </div>

<?php
  include("layoutend.php");
?>