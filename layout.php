<!doctype html>

<link rel="stylesheet" href="./material.min.css">
<script src="./material.min.js"></script>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<?php
  /*  
  Raspberry Remote
  http://xkonni.github.com/raspberry-remote/
    Erster Teil 
    PIN BELEGUNG 
    GROUND GRAU AUF GROUND
    433 MHZ Sender:
    ADATA : GPIO 17 PIN 11
    VCC : 5V PIN 2/4
    Relais:
    Braun: 5V PIN
    Orange Widerstand : GPIO 27
    Orange Transistior : GROUND
    BLAU / ORANGE : PC
    Lüfter: 
    Rot : Ground
    Lila mit Panzerban : GPIO 18
  */

  include("config.php");
  include_once ('simplehtmldom/simple_html_dom.php');
?>

  <html>

  <head>
    <title>Battlestation</title>
    <link rel="stylesheet" href="./mdl/material.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="./mdl/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
              mdl-layout--fixed-header">
      <header class="mdl-layout__header" id="tonav">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Battlestation Control</span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                    mdl-textfield--floating-label mdl-textfield--align-right">
          </div>
        </div>
      </header>
      <div class="mdl-layout__drawer mdl-color--blue-grey-800">

        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="index.php">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings</i> RGB/FAN CONTROL</a>
          <a class="mdl-navigation__link" href="anime.php">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">file_download</i> Anime Download</a>
          <a class="mdl-navigation__link " href="pc_onoff.php ">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">power</i>PC AN/AUS</a>

        </nav>
      </div>
      <main class="mdl-layout__content">
        <div class="page-content">
