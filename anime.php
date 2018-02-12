<?php
include("layout.php");
?>
                    <div id="Link Downloader">
                        <div id="zeile">
                            <form action="index.php" method="GET" id="grabber">
                                Link ohne Folge und /:
                                <input type="text" name="link"> Anfangsepisode:
                                <input style="width:40px" type="text" name="anf"> Endepisode:
                                <input style="width:40px" type="text" name="end">
                                <input type="submit">
                            </form>
                            <!--<button style="width:50px;height:30px; "onclick="window.open('grabber.py', '_blank')" />-->
                        </div>
                    </div>
<?php
include("layoutend.php");
?>