
<nav role="navigation">
    <div id= "menuToggle">

        <!--
            this is used to make it clickable
        -->
        <input type="checkbox" id="CHBX1" onclick="checkd()" class="button"/>
        <input type="checkbox" id="CHBX2" onclick="uncheckd()" class="button"/>
        <!--
            this little guy makes the first button turn it on and the second turn it off
        -->

        <script>
            function checkd(){
                document.getElementById("CHBX1").checked = true;
                document.getElementById("CHBX2").checked = true;
            }
            function uncheckd(){
                document.getElementById("CHBX1").checked = false;
                document.getElementById("CHBX2").checked = false;
            }

        </script>


        <!--
            this if just the icon
        -->
        <span></span>
        <span></span>
        <span></span>

        <!--
            THis is the accual content of the menu
        -->

        <ul id="menu">


            <a href="index.php"> <li> Hot </li></a> <br>
            <a href="Books.php"> <li>Archive</li> </a>
            <a href="Users.php"> <li>Users</li> </a>


    <div id="SocialMedia">

</nav>
