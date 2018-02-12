<?php
  include("layout.php");
?>
<div id="Steckdosensteuerung">


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
      header("Location: pc_onoff.php?delay=$nDelay");
    }
    /*
    * table containing all configured sockets
    */
    foreach($config as $current) {
      if ($current != "") {
        $iSys = "1";
        $ig = "11011";
        $is = "04";


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
    <button id="show-dialog" type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"">Schalte die PC STECKDOSE
      <?=$direction?>
    </button>
    <dialog class="mdl-dialog">
      <h4 class="mdl-dialog__title">Willst du die PC Steckdose
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
            PC
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
<?php
  include("layoutend.php");
?>